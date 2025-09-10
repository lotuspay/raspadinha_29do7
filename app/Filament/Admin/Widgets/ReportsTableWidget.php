<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Report;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ReportsTableWidget extends BaseWidget
{

    protected static ?string $heading = 'Relatórios';

    protected static ?int $navigationSort = -1;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = '3s';

    /**
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(Report::query())
            ->poll()
            ->defaultSort('created_at', 'desc')
            ->columns([
                 Tables\Columns\TextColumn::make('user.id')
                    ->label('ID')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário')
                    ->badge()
                    ->color('success')
                    ->searchable(),
                Tables\Columns\TextColumn::make('page_action')
                    ->label('Ações')
                    ->badge()
                    ->color('warning')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                   
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('page_url')
                    ->label('URL')
                    ->html()
                    ->formatStateUsing(fn (string $state): string => '<a href="'.url('storage/'.$state).'" target="_blank">Link</a>'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label('Data Inicial'),
                        DatePicker::make('created_until')->label('Data Final'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Criação Inicial ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }

                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Criação Final ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
                SelectFilter::make('action_type')
                    ->label('Tipo de Ação')
                    ->options([
                        'Registro' => 'Registro',
                        'Depósito' => 'Depósito',
                        'Saque' => 'Saque',
                        'Pix' => 'Pix',
                        'Atualizou Saldo' => 'Atualizou Saldo',
                        'Enviou um pagamento' => 'Pagamento',
                        'SUITPAY ALTERADA!' => 'Alteração SuitPay',
                        'Depósito Confirmado!' => 'Depósito Confirmado',
                        'Pix gerado' => 'Pix Gerado',
                        'QR Code gerado' => 'QR Code Gerado',
                    ])
                    ->attribute('page_action'),
            ])
            ;
    }


    /**
     * @return bool
     */
    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
