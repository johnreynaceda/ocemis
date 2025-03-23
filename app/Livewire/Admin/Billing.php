<?php

namespace App\Livewire\Admin;

use App\Models\Shop\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Billing extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\Billing::query()->orderByDesc('created_at'))
            ->columns([
                TextColumn::make('appointment.created_at')->date()->label('APPOINTMENT DATE'),
                TextColumn::make('appointment.weddingInfo.client_name')->label('CLIENT NAME'),
                TextColumn::make('total_amount')->label('AMOUNT')->formatStateUsing(
                    fn($record) => '₱'.number_format($record->total_amount,2)
                ),
                TextColumn::make('appointment.mode_of_payment')->label('PAYMENT METHOD'),
                TextColumn::make('status')->label('STATUS')->formatStateUsing(
                    fn($record) => ucfirst($record->status)
                )->badge() ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'paid' => 'success',
                }),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('pay')->icon('heroicon-o-banknotes')->button()->visible(
                    fn($record) => $record->status == 'pending',
                )->action(
                    fn($record) => $record->update([ 'status' => 'paid'])
                )
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.billing');
    }
}
