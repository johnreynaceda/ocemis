<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->whereNot('role_id',1))
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('email')->label('EMAIL')->searchable(),
                TextColumn::make('role_id')->label('ROLE')->badge()->formatStateUsing(
                    function($record) {
                        switch ($record->role_id) {
                            case 1:
                                return 'Adminstrator;';
                            case 2:
                                return 'Coordinator';
                            case 3:
                                return 'Client';
                            
                            default:
                                # code...
                                break;
                        }
                    }
                )->icon('heroicon-o-user'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.user-list');
    }
}
