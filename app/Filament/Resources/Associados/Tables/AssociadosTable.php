<?php

namespace App\Filament\Resources\Associados\Tables;

use App\Filament\Resources\Associados\AssociadoResource;
use App\Models\Associado;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AssociadosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('is_civil')
                    ->label('Perfil')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Civil' : 'Militar')
                    ->color(fn (bool $state): string => $state ? 'info' : 'warning')
                    ->sortable(),
                TextColumn::make('tipo_cadastro')
                    ->label('Tipo de Cadastro')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'novo_cadastro' ? 'Nova Adesão' : 'Atualização Cadastral')
                    ->color(fn (string $state): string => $state === 'novo_cadastro' ? 'success' : 'gray')
                    ->sortable(),
                TextColumn::make('telefone_whatsapp')
                    ->label('Telefone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                ToggleColumn::make('codigo')
                    ->label('Código (633 / 634)')
                    ->getStateUsing(fn (Associado $record): bool => $record->codigo === '634')
                    ->updateStateUsing(function (Associado $record, bool $state): void {
                        if (! $record->is_civil) {
                            $record->update(['codigo' => $state ? '634' : '633']);
                        }
                    })
                    ->disabled(fn (Associado $record): bool => (bool) $record->is_civil),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('exportCsvCustom')
                    ->label('Exportar CSV')
                    ->icon('heroicon-o-document-arrow-down')
                    ->form([
                        CheckboxList::make('columns')
                            ->label('Colunas para Exportar')
                            ->options([
                                'tipo_cadastro' => 'Tipo de Cadastro',
                                'nome' => 'Nome',
                                'cpf' => 'CPF',
                                'email' => 'E-mail',
                                'telefone_whatsapp' => 'Telefone/WhatsApp',
                                'matricula' => 'Matrícula',
                                'posto_graduacao' => 'Posto/Graduação',
                                'corporacao' => 'Corporação',
                                'codigo' => 'Código (633/634)',
                                'data_nascimento' => 'Data de Nascimento',
                                'estado_civil' => 'Estado Civil',
                                'naturalidade' => 'Naturalidade',
                                'cep' => 'CEP',
                                'logradouro' => 'Logradouro',
                                'numero' => 'Número',
                                'complemento' => 'Complemento',
                                'bairro' => 'Bairro',
                                'cidade' => 'Cidade',
                                'estado' => 'Estado',
                                'created_at' => 'Data de Cadastro',
                            ])
                            ->default(['nome', 'cpf', 'email', 'telefone_whatsapp', 'matricula', 'codigo'])
                            ->columns(2)
                            ->required(),
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('data_inicio')
                                    ->label('Data de Início (Cadastro)'),
                                DatePicker::make('data_fim')
                                    ->label('Data de Fim (Cadastro)'),
                            ]),
                    ])
                    ->action(function (array $data) {
                        $columns = $data['columns'];
                        $startDate = $data['data_inicio'] ?? null;
                        $endDate = $data['data_fim'] ?? null;

                        $query = Associado::query();

                        if ($startDate) {
                            $query->whereDate('created_at', '>=', $startDate);
                        }
                        if ($endDate) {
                            $query->whereDate('created_at', '<=', $endDate);
                        }

                        $records = $query->get();

                        $headers = [
                            'Content-Type' => 'text/csv; charset=UTF-8',
                            'Content-Disposition' => 'attachment; filename="associados-'.now()->format('Y-m-d').'.csv"',
                        ];

                        $callback = function () use ($records, $columns) {
                            $file = fopen('php://output', 'w');

                            // UTF-8 BOM
                            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

                            $headerRow = [];
                            foreach ($columns as $col) {
                                $headerRow[] = mb_strtoupper(str_replace('_', ' ', $col), 'UTF-8');
                            }
                            fputcsv($file, $headerRow, ';');

                            foreach ($records as $record) {
                                $row = [];
                                foreach ($columns as $col) {
                                    $val = $record->{$col};
                                    if ($val instanceof Carbon || $val instanceof \Illuminate\Support\Carbon) {
                                        $val = $val->format('d/m/Y H:i:s');
                                    } elseif (is_bool($val)) {
                                        $val = $val ? 'Sim' : 'Não';
                                    }
                                    $row[] = $val;
                                }
                                fputcsv($file, $row, ';');
                            }
                            fclose($file);
                        };

                        return response()->stream($callback, 200, $headers);
                    }),
            ])
            ->recordUrl(null)
            ->recordAction('view')
            ->recordActions([
                ViewAction::make()
                    ->extraAttributes(['class' => 'hidden'])
                    ->modalFooterActions([
                        EditAction::make(),
                        Action::make('pdf_completo')
                            ->label('Baixar PDF Completo (Ficha e Contrato)')
                            ->icon('heroicon-o-document-arrow-down')
                            ->color('success')
                            ->url(fn (Associado $record) => route('associados.pdf', $record))
                            ->openUrlInNewTab(),
                    ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
