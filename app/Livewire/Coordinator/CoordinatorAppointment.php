<?php

namespace App\Livewire\Coordinator;

use App\Models\Appointment;
use App\Models\Event;
use App\Models\Shop\Product;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CoordinatorAppointment extends Component  implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Appointment::query()->where('status', 'approved')->orWhereHas('weddingInfo', function ($query) {
                $query->whereJsonContains('coordinator', (string) auth()->user()->coordinator->id);
            })->orWhereHas('baptismalInfo', function ($query) {
                $query->whereJsonContains('coordinator', (string) auth()->user()->coordinator->id);
            })->orWhereHas('fellowShipInfo', function ($query) {
                $query->whereJsonContains('coordinators', (string) auth()->user()->coordinator->id);
            })->orderByDesc('created_at'))
            ->columns([
                TextColumn::make('user.name')->label('NAME')->searchable(),
                TextColumn::make('event.name')->label('EVENT')->searchable(),
                TextColumn::make('mode_of_payment')->label('MODE OF PAYMENT')->searchable(),
                TextColumn::make('amount')->label('AMOUNT')->searchable()->formatStateUsing(fn($record) => '₱'.number_format($record->amount,2)),
                TextColumn::make('status')->label('STATUS')->formatStateUsing(
                    fn($record) => ucfirst($record->status)
                )->badge()->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'approved' => 'success',
                    'completed' => 'success',
                    'declined' => 'danger',
                })
            ])
            ->filters([
                SelectFilter::make('event_id')->label('Event')->options(
                    Event::all()->pluck('name', 'id')
                )
            ])
            ->actions([
                Action::make('view')->color('warning')->icon('heroicon-o-book-open')->button()->action(
                    function($record){
                        return redirect()->route('admin.appointment-view', $record->id);
                    }
                ),
                // EditAction::make('edit')->color('success')->form([
                //     TextInput::make('name')->required(),
                //     TextInput::make('amount')->prefix('₱')->required()->numeric(),
                // ])->modalWidth('xl')
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.coordinator.coordinator-appointment');
    }
}
