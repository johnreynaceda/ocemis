<?php

namespace App\Livewire\Admin;

use App\Models\Coordinator;
use App\Models\Event;
use App\Models\Shop\Product;
use App\Models\User;
use Filament\Forms\Components\Grid;
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


class CoordinatorList extends Component implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Coordinator::query())->headerActions([
                CreateAction::make('new')->label('New Coordinator')->icon('heroicon-o-plus')->action(
                    function($record, $data){
                        $user = User::create([
                            'name' => $data['firstname']. ' '. $data['lastname'],
                            'email' => strtolower($data['firstname'].''.$data['lastname'].'@gmail.com'),
                            'password' => bcrypt('password'),
                            'role_id' => 2, // Coordinator role id
                        ]);

                        Coordinator::create([
                            'user_id' => $user->id,
                            'firstname' => $data['firstname'],
                            'lastname' => $data['lastname'],
                            'middlename' => $data['middlename'],
                            'phone_number' => $data['phone_number'],
                        ]);

                    }
                )->form([
                    Grid::make(2)->schema([
                        TextInput::make('firstname')->required(),
                        TextInput::make('middlename'),
                        TextInput::make('lastname')->required(),
                        TextInput::make('phone_number')->required(),
                    ])
                     
                ])->modalWidth('xl'),

            ])
            ->columns([
                TextColumn::make('firstname')->label('FIRSTNAME')->searchable(),
                TextColumn::make('middlename')->label('MIDDLENAME')->searchable(),
                TextColumn::make('lastname')->label('LASTNAME')->searchable(),
                TextColumn::make('phone_number')->label('PHONE NUMBER')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success')->form([
                    TextInput::make('name')->required()
                ])->modalWidth('xl')
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.coordinator-list');
    }
}
