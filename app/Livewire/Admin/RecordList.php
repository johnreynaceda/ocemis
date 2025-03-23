<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Event;
use App\Models\Shop\Product;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class RecordList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    
    public function table(Table $table): Table
    {
        return $table
            ->query(Appointment::query()->whereIn('status',  ['approved','completed'])->wherehas('billing', function($record){
                return $record->where('status',  'paid');
            }))
            ->columns([
                TextColumn::make('user.name')->label('NAME')->searchable(),
                TextColumn::make('event.name')->label('EVENT')->searchable(),
                TextColumn::make('mode_of_payment')->label('MODE OF PAYMENT')->searchable(),
                TextColumn::make('amount')->label('AMOUNT')->searchable()->formatStateUsing(fn($record) => '₱'.number_format($record->amount,2)),
                TextColumn::make('status')->label('STATUS')->formatStateUsing(
                    fn($record) => ucfirst($record->status)
                )->badge()->color(fn (string $state): string => match ($state) {
                    'approved' => 'gray',
                    'completed' => 'success',
                    'rejected' => 'danger',
                })
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('view')->color('warning')->icon('heroicon-o-book-open')->button()->action(
                    function($record){
                        return redirect()->route('admin.appointment-view', $record->id);
                    }
                ),
                ActionGroup::make([
                    Action::make('completed')->icon('heroicon-o-check')->color('success')->action(
                        fn($record) => $record->update([ 'status' => 'completed'])
                    )
                ])
                
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.record-list');
    }
}
