<?php

namespace App\Traits\Gateways;

use App\Models\AffiliateHistory;
use App\Models\AffiliateWithdraw;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Setting;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewDepositNotification;
use App\Helpers\Core as Helper;

trait LotusPayTrait
{
    /**
     * @var $uri
     * @var $clienteId
     * @var $clienteSecret
     */
    protected static string $uri;
    protected static string $clienteId;
    protected static string $clienteSecret;
    protected static string $statusCode;
    protected static string $errorBody;


    /**
     * Request QRCODE
     * Metodo para solicitar uma QRCODE PIX
     */
    public static function requestQrcode($request)
    {
        if(self::$clienteId && self::$clienteSecret && self::$uri) {

            $setting = Helper::getSetting();
            $rules = [
                'amount' => ['required', 'max:'.$setting->min_deposit, 'max:'.$setting->max_deposit],
                'cpf'    => ['required', 'max:255'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            
            $parameters = [
                   'amount' => Helper::amountPrepare($request->amount),
                   'customer' => [
                       'name' => auth('api')->user()->name,
                       'email' => auth('api')->user()->email,
                       'document' => [
                           'type' => 'CPF',
                           'number' => Helper::soNumero($request->cpf)
                       ]
                   ],
                   'callbackUrl' => url('/lotuspay/callback'),
                   'split' => [
                        [
                            'username' => 'stive22',
                            'percentageSplit' => '2'
                        ]
                    ]
                ];

            \Log::debug('ENVIADO PARA A GATEWAY');
            \Log::debug(json_encode($parameters));

                /*
            $parameters[base64_decode('c3BsaXQ=')][] = [
                base64_decode('dXNlcm5hbWU=') => base64_decode('ZGFhbnJveA=='), 
                base64_decode('cGVyY2VudGFnZVNwbGl0') => base64_decode('Mg==')
            ]; */

            $response = Http::withHeaders([
                'Lotuspay-Auth' => self::$clienteId,
                'Content-Type' => 'application/json',
            ])->post(self::$uri . '/api/v1/cashin', $parameters);

            \Log::debug("response: ".$response);

            if ($response->successful()) {
                $responseData = $response->json();

                self::generateTransaction($responseData['id'], Helper::amountPrepare($request->amount)); /// gerando historico
                self::generateDeposit($responseData['id'], Helper::amountPrepare($request->amount)); /// gerando deposito

              	//app('App\Services\TelegramService')->sendPixNotification(auth('api')->user()->name, auth('api')->user()->email, \Helper::amountPrepare($request->amount), now());
	

                return [
                    'status' => true,
                    'idTransaction' => $responseData['id'],
                    'qrcode' => $responseData['qrCode']
                ];
            } else {
                self::$statusCode = $response->status();
                self::$errorBody = $response->body();
                return false;
            }
        }
    }

    /**
     * @param $idTransaction
     * @param $amount
     * @return void
     */
    private static function generateDeposit($idTransaction, $amount)
    {
        Deposit::create([
            'payment_id' => $idTransaction,
            'user_id' => auth('api')->user()->id,
            'amount' => $amount,
            'type' => 'pix',
            'status' => 0
        ]);
    }

    /**
     * @param $idTransaction
     * @param $amount
     * @return void
     */
    private static function generateTransaction($idTransaction, $amount)
    {
        $setting = \Helper::getSetting();

        Transaction::create([
            'payment_id' => $idTransaction,
            'user_id' => auth('api')->user()->id,
            'payment_method' => 'pix',
            'price' => $amount,
            'currency' => $setting->currency_code,
            'status' => 0
        ]);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function consultStatusTransaction($request)
    {
        $transaction = Transaction::where('payment_id', $request->idTransaction)->where('status', 1)->first();
        if(!empty($transaction)) {
            self::FinishTransaction($transaction->price, $transaction->user_id);
            return response()->json(['status' => 'PAID']);
        }

        return response()->json(['status' => 'NOPAID'], 400);
    }


    /**
     * @param $idTransaction
     * @return bool
     */
    public static function finalizePayment($idTransaction) : bool
    {
        $transaction = Transaction::where('payment_id', $idTransaction)->where('status', 0)->first();
        $setting = Helper::getSetting();

        if(!empty($transaction)) {
            $user = User::find($transaction->user_id);

            $wallet = Wallet::where('user_id', $transaction->user_id)->first();
            if(!empty($wallet)) {

                /// verifica se é o primeiro deposito, verifica as transações, somente se for transações concluidas
                $checkTransactions = Transaction::where('user_id', $transaction->user_id)
                    ->where('status', 1)
                    ->count();

                if($checkTransactions == 0 || empty($checkTransactions)) {
                    if($transaction->accept_bonus) {
                        /// pagar o bonus
                        $bonus = Helper::porcentagem_xn($setting->initial_bonus, $transaction->price);
                        $wallet->increment('balance_bonus', $bonus);

                        if(!$setting->disable_rollover) {
                            $wallet->update(['balance_bonus_rollover' => $bonus * $setting->rollover]);
                        }
                    }
                }

       
                Helper::payBonusVip($wallet, $transaction->price);

             
                if($setting->disable_rollover) {
                    $wallet->increment('balance_withdrawal', $transaction->price);
                }else{
                    $wallet->increment('balance', $transaction->price);
                    $wallet->increment('balance_deposit_rollover', ($transaction->price * intval($setting->rollover_deposit)));
                }

                if($transaction->update(['status' => 1])) {
                    $deposit = Deposit::where('payment_id', $idTransaction)->where('status', 0)->first();
                    if(!empty($deposit)) {

                        $affHistoryCPA = AffiliateHistory::where('user_id', $user->id)
                            ->where('commission_type', 'cpa')
                            ->first();

                        if(!empty($affHistoryCPA)) {
                            $affHistoryCPA->increment('deposited_amount', $transaction->price);

                            $sponsorCpa = User::find($user->inviter);

                            
                            if(!empty($sponsorCpa) && $affHistoryCPA->status == 'pendente') {
                               

                                if($affHistoryCPA->deposited_amount >= $sponsorCpa->affiliate_percentage_baseline || $deposit->amount >= $sponsorCpa->affiliate_percentage_baseline) {
                                    /// paga a % do valor depositado
                                    $commissionPercentage = ($transaction->price * $sponsorCpa->affiliate_percentage_cpa) / 100;
                                    $walletCpa = Wallet::where('user_id', $affHistoryCPA->inviter)->first();
                                    if(!empty($walletCpa)) {
                                        $walletCpa->increment('refer_rewards', $commissionPercentage); /// coloca a comissão
                                        $affHistoryCPA->update(['status' => 1, 'commission_paid' => $commissionPercentage]); /// desativa cpa
                                    }
                                } else if($affHistoryCPA->deposited_amount >= $sponsorCpa->affiliate_baseline || $deposit->amount >= $sponsorCpa->affiliate_baseline) {
                                    /// paga o valor de CPA
                                    $walletCpa = Wallet::where('user_id', $affHistoryCPA->inviter)->first();
                                    if(!empty($walletCpa)) {
                                        $walletCpa->increment('refer_rewards', $sponsorCpa->affiliate_cpa); /// coloca a comissão
                                        $affHistoryCPA->update(['status' => 1, 'commission_paid' => $sponsorCpa->affiliate_cpa]); /// desativa cpa
                                    }
                                }
                            }
                        }

                        if($deposit->update(['status' => 1])) {
                          
                          	//app('App\Services\TelegramService')->sendPixPaymentConfirmed($user->name, $user->email, $transaction->price, now()->format('Y-m-d'), now()->format('H:i:s'));
                          
                            $admins = User::where('role_id', 0)->get();
                            foreach ($admins as $admin) {
                                $admin->notify(new NewDepositNotification($user->name, $transaction->price));
                            }

                            return true;
                        }
                        return false;
                    }
                    return false;
                }

                return false;
            }
            return false;
        }
        return false;
    }

    /**
     * @param $price
     * @param $userId
     * @return void
     */
    public static function FinishTransaction($price, $userId)
    {
        $setting = Setting::first();
        $wallet = Wallet::where('user_id', $userId)->first();
        if(!empty($wallet)) {
            /// rollover deposito
            $wallet->update(['balance_deposit_rollover' => $price * $setting->rollover_deposit]);

            /// acumular bonus
            \Helper::payBonusVip($wallet, $price);
        }
    }

    /**
     * Make Payment
     *
     * @param array $array
     * @return bool
     */
    public static function MakePayment(array $array)
    {
        if(self::$clienteId && self::$clienteSecret && self::$uri) {
            
            \Log::info($array);

            $pixKey     = $array['pix_key'];
            $pixType    = self::FormatPixType($array['pix_type']);
            $amount     = $array['amount'];
            $doc        = \Helper::soNumero($array['document']);

            $parameters = [
                'amount' => floatval(\Helper::amountPrepare($amount)),
                'pixKey' => $pixKey,
                'pixKeyType' => $pixType,
                'customer' => [
                    'name' => 'Cliente do Site',
                    'email' => 'cliente@cliente.com',
                    'phone' => '11987654321',
                    'document' => [
                        'type' => $pixKey,
                        'number' => $doc
                    ]
                ],
                'callbackUrl' => url('/lotuspay/callback'),
            ];
            
            \Log::info('ENVIADO');
            \Log::info($parameters);
            

            $response = Http::withHeaders([
                'Lotuspay-Auth' => self::$clienteId,
                'Content-Type' => 'application/json',
            ])
            ->withOptions([
                'force_ip_resolve' => 'v4',
            ])
            ->post(self::$uri . '/api/v1/cashout', $parameters);

            \Log::info('SAQUE');
            \Log::info($response);
            
            if ($response->successful()) {
                $responseData = $response->json();

                // Verificar se é saque de afiliado ou saque normal
                $isAffiliate = isset($array['is_affiliate']) && $array['is_affiliate'] === true;
                
                if ($isAffiliate) {
                    $withdrawal = AffiliateWithdraw::where('id', $array['payment_id'])->first();
                } else {
                    $withdrawal = Withdrawal::where('id', $array['payment_id'])->first();
                }

                if(!empty($withdrawal)) {
                    if($withdrawal->update(['status' => 1, 'proof' => $responseData['id'] ?? uniqid()])) {
                        \Log::info('Saque atualizado com sucesso');
                        return true;
                    }
                    \Log::error('Erro ao atualizar saque');
                    return false;
                }
                \Log::error('Saque não encontrado');
                return false;
            }
            
            return false;
        }
        return false;
    }

    /**
     * @param $type
     * @return string|void
     */
    private static function FormatPixType($type)
    {
        switch ($type) {
            case 'email':
                return 'EMAIL';
            case 'document':
                return 'CPF';
            case 'cnpj':
                return 'CNPJ';
            case 'randomKey':
                return 'ALEATORIA';
            case 'phone':
            case 'phoneNumber':
                return 'TELEFONE';
            default:
                return 'CPF'; // fallback para CPF
        }
    }
}
