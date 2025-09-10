<?php

namespace App\Filament\Admin\Pages;

use App\Models\Gateway;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use App\Models\Report;
use Illuminate\Support\HtmlString;

class GatewayPage extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.gateway-page';

    public ?array $data = [];
    public Gateway $setting;

    /**
     * @dev @victormsalatiel
     * @return bool
     */
    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $gateway = Gateway::first();
        if(!empty($gateway)) {
            $this->setting = $gateway;
            $this->form->fill($this->setting->toArray());
        }else{
            $this->form->fill();
        }
    }

    /**
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
              Section::make('QIC BUSINESS CRIOU ESSA PLATAFORMA PARA VOCÊ')
                ->description(new HtmlString('
                    <div style="font-weight: 600; display: flex; align-items: center;">
                        RECOMENDO USAR A ONDAPAY! 
                         <a class="dark:text-white" 
                           style="
                                font-size: 14px;
                                font-weight: 600;
                                width: 127px;
                                display: flex;
                                background-color: #d28a00;
                                padding: 10px;
                                border-radius: 11px;
                                justify-content: center;
                                margin-left: 10px;
                           " 
                           href="https://www.youtube.com/@queminvestecresce" 
                           target="_blank">
                            YOUTUBE
                        </a>
                         <a class="dark:text-white" 
                           style="
                                font-size: 14px;
                                font-weight: 600;
                                width: 127px;
                                display: flex;
                                background-color: #d28a00;
                                padding: 10px;
                                border-radius: 11px;
                                justify-content: center;
                                margin-left: 10px;
                           " 
                           href="https://www.instagram.com/stiveronald__" 
                           target="_blank">
                              INSTAGRAM
                        </a>
                        <a class="dark:text-white" 
                           style="
                                font-size: 14px;
                                font-weight: 600;
                                width: 127px;
                                display: flex;
                                background-color: #d28a00;
                                padding: 10px;
                                border-radius: 11px;
                                justify-content: center;
                                margin-left: 10px;
                           " 
                           href="https://t.me/qicbusiness" 
                           target="_blank">
                              TELEGRAM
                        </a>
                    </div>
                ')),
              
            
                        Section::make('OndaPay')
                            ->description(new HtmlString('
                                    <div style="display: flex; align-items: center;">
                                        Precisa de uma conta na OndaPay? Responda o formulário de contato e solicite sua conta.:
                                        <a class="dark:text-white"
                                        style="
                                                font-size: 14px;
                                                font-weight: 600;
                                                width: 127px;
                                                display: flex;
                                                background-color: #f800ff;
                                                padding: 10px;
                                                border-radius: 11px;
                                                justify-content: center;
                                                margin-left: 10px;
                                        "
                                        href="https://painel.ondapay.app/#/login"
                                        target="_blank">
                                            Dashboard
                                        </a>
                                    </div>
                        '),)
                            ->schema([
                                TextInput::make('ondapay_uri')
                                    ->label('CLIENTE URL')
                                    ->placeholder('Digite a url da api')
                                    ->maxLength(191)
                                    ->columnSpanFull(),
                                TextInput::make('ondapay_client')
                                    ->label('CLIENTE ID')
                                    ->placeholder('Digite o client ID')
                                    ->maxLength(191)
                                    ->columnSpanFull(),
                                TextInput::make('ondapay_secret')
                                    ->label('CLIENTE SECRETO')
                                    ->placeholder('Digite o client secret')
                                    ->maxLength(191)
                                    ->columnSpanFull(),
                            ]),
                Section::make('LotusPay')
                    ->description('Ajustes de credenciais para a LotusPay')
                    ->schema([
                        TextInput::make('lotuspay_uri')
                            ->label('Client URI')
                            ->placeholder('Digite a url da api')
                            ->maxLength(191),
                        TextInput::make('lotuspay_cliente_id')
                            ->label('Token API')
                            ->placeholder('Digite o Token da API')
                            ->maxLength(191),
                        TextInput::make('lotuspay_cliente_secret')
                            ->label('Token API callback (optional)')
                            ->placeholder('Digite o Token API callback')
                            ->maxLength(191),
                    ])->columns(3),
               
            ])
            ->statePath('data');
    }


    /**
     * @return void
     */
    public function submit(): void
    {
        try {
            if(env('APP_DEMO')) {
                Notification::make()
                    ->title('Atenção')
                    ->body('Você não pode realizar está alteração na versão demo')
                    ->danger()
                    ->send();
                return;
            }

            $setting = Gateway::first();
            if(!empty($setting)) {
                if($setting->update($this->data)) {
                    if(!empty($this->data['stripe_public_key'])) {
                        $envs = DotenvEditor::load(base_path('.env'));

                        $envs->setKeys([
                            'STRIPE_KEY' => $this->data['stripe_public_key'],
                            'STRIPE_SECRET' => $this->data['stripe_secret_key'],
                            'STRIPE_WEBHOOK_SECRET' => $this->data['stripe_webhook_key'],
                        ]);

                        $envs->save();
                    }

                    Notification::make()
                        ->title('Chaves Alteradas')
                        ->body('Suas chaves foram alteradas com sucesso!')
                        ->success()
                        ->send();
                }
            }else{
                if(Gateway::create($this->data)) {
                    Notification::make()
                        ->title('Chaves Criadas')
                        ->body('Suas chaves foram criadas com sucesso!')
                        ->success()
                        ->send();
                }
            }


            \Helper::CreateReport('SUITPAY ALTERADA!', 'O Administrador '.  auth()->user()->name. ' de ID: '. auth()->user()->id .' Alterou as chaves da SuitPay para: ' . $setting->suitpay_cliente_id);
        } catch (Halt $exception) {
            Notification::make()
                ->title('Erro ao alterar dados!')
                ->body('Erro ao alterar dados!')
                ->danger()
                ->send();
        }
    }
}
