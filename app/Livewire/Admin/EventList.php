<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use App\Models\Shop\Product;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EventList extends Component  implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public function table(Table $table): Table
    {
        return $table
            ->query(Event::query())->headerActions([
                CreateAction::make('new')->label('New Event')->icon('heroicon-o-plus')->form([
                    TextInput::make('name')->required(),
                    TextInput::make('amount')->prefix('₱')->required()->numeric(),
                ])->modalWidth('xl')
            ])
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('amount')->label('AMOUNT')->searchable()->formatStateUsing(fn($record) => '₱'.number_format($record->amount,2)),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success')->form([
                    TextInput::make('name')->required(),
                    TextInput::make('amount')->prefix('₱')->required()->numeric(),
                ])->modalWidth('xl')
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.event-list');
    }
}
