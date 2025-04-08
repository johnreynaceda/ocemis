<?php

namespace App\Livewire\Client;

use App\Models\Appointment;
use App\Models\Coordinator;
use App\Models\WeddingInfo;
use App\Models\WeddingSponsor;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Wizard;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAppointment extends Component implements HasForms
{
    use InteractsWithForms, WithFileUploads;

    public $appointment_id;
    public $appointment;
    public $weddingInfo;
    public bool $isLoading = false;
    public array $data = [];

    public function mount()
    {
        $this->appointment_id = request('id');
        $this->appointment = Appointment::where('id', $this->appointment_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $this->weddingInfo = WeddingInfo::where('appointment_id', $this->appointment_id)
            ->firstOrFail();

        $principalSponsors = WeddingSponsor::where('wedding_info_id', $this->weddingInfo->id)
            ->where('type', 'principal')
            ->pluck('name')
            ->map(fn($name) => ['name' => $name])
            ->toArray();

        $this->data = [
            'client_name' => auth()->user()->name,
            'phone_number' => auth()->user()->phone_number,
            'address' => auth()->user()->address,
            'event' => $this->weddingInfo->event->name ?? '',
            'amount' => $this->weddingInfo->amount,
            'groom_name' => $this->weddingInfo->groom_name,
            'bride_name' => $this->weddingInfo->bride_name,
            'date_of_event' => $this->weddingInfo->date_of_event,
            'scheduled_practice' => $this->weddingInfo->scheduled_practice,
            'host_pastor' => $this->weddingInfo->host_pastor,
            'reception' => $this->weddingInfo->reception,
            'contact_number' => $this->weddingInfo->contact_number,
            'officiating_minister' => $this->weddingInfo->officiating_minister,
            'ring_bearer' => $this->weddingInfo->ring_bearer,
            'bible_bearer' => $this->weddingInfo->bible_bearer,
            'coin_bearer' => $this->weddingInfo->coin_bearer,
            'little_groom' => $this->weddingInfo->little_groom,
            'little_bride' => $this->weddingInfo->little_bride,
            'best_man' => $this->weddingInfo->best_man,
            'maid_of_honor' => $this->weddingInfo->maid_of_honor,
            'principal_sponsor' => $principalSponsors,
            'light_our_path' => json_decode($this->weddingInfo->light_our_path ?? '[]', true),
            'cloth_us_one' => json_decode($this->weddingInfo->cloth_us_one ?? '[]', true),
            'bind_us_together' => json_decode($this->weddingInfo->bind_us_together ?? '[]', true),
            'grooms_man' => json_decode($this->weddingInfo->grooms_man ?? '[]', true),
            'brides_maid' => json_decode($this->weddingInfo->brides_maid ?? '[]', true),
            'flower_girls' => json_decode($this->weddingInfo->flower_girls ?? '[]', true),
            'grooms_parent' => json_decode($this->weddingInfo->grooms_parent ?? '[]', true),
            'brides_parent' => json_decode($this->weddingInfo->brides_parent ?? '[]', true),
            'singer' => json_decode($this->weddingInfo->singer ?? '[]', true),
            'song' => json_decode($this->weddingInfo->song ?? '[]', true),
            // 'coordinator' => $this->weddingInfo->coordinators->pluck('id')->toArray(),
            'mode_of_payment' => $this->weddingInfo->mode_of_payment,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('INFORMATIONS')->completedIcon('heroicon-m-check')
                        ->schema([
                            Grid::make(4)->schema([
                                TextInput::make('client_name')
                                    ->required()
                                    ->statePath('client_name'),

                                TextInput::make('host_pastor')
                                    ->required()
                                    ->statePath('host_pastor'),

                                TextInput::make('reception')
                                    ->required()
                                    ->statePath('reception'),

                                TextInput::make('contact_number')
                                    ->required()
                                    ->statePath('contact_number'),

                                DatePicker::make('scheduled_practice')
                                    ->required()
                                    ->statePath('scheduled_practice'),

                                Select::make('coordinator')
                                    ->multiple()
                                    ->required()
                                    ->options(Coordinator::all()->pluck('full_name', 'id'))
                                    ->statePath('coordinator'),

                                DatePicker::make('date_of_event')
                                    ->required()
                                    ->statePath('date_of_event'),
                            ]),

                            Grid::make(4)->schema([
                                TextInput::make('groom_name')
                                    ->required()
                                    ->statePath('groom_name'),

                                TextInput::make('bride_name')
                                    ->required()
                                    ->statePath('bride_name'),
                            ]),

                            Grid::make(4)->schema([
                                Fieldset::make('SINGERS')->schema([
                                    Repeater::make('singer')
                                        ->schema([
                                            TextInput::make('name')->required()
                                        ])
                                        ->addActionLabel('Add New Singer')
                                        ->addActionAlignment(Alignment::Start)
                                        ->statePath('singer')
                                ])->columnSpan(2),

                                Fieldset::make('SONGS')->schema([
                                    Repeater::make('song')
                                        ->schema([
                                            TextInput::make('name')->required()
                                        ])
                                        ->addActionLabel('Add New Song')
                                        ->addActionAlignment(Alignment::Start)
                                        ->statePath('song')
                                ])->columnSpan(2),
                            ])
                        ]),

                    Wizard\Step::make('PRINCIPAL SPONSORS')
                        ->schema([
                            Grid::make(4)->schema([
                                Fieldset::make('SPONSORS')->schema([
                                    Repeater::make('principal_sponsor')
                                        ->schema([
                                            TextInput::make('name')->required()
                                        ])
                                        ->addActionLabel('Add New Principal')
                                        ->addActionAlignment(Alignment::Start)
                                        ->statePath('principal_sponsor')
                                ])->columnSpan(2),
                            ]),
                        ]),

                    Wizard\Step::make('SECONDARY SPONSORS')
                        ->schema([
                            // All other fields with statePath in the same way
                        ]),

                    Wizard\Step::make('BILLING')
                        ->schema([
                            Grid::make(4)->schema([
                                TextInput::make('client_name')
                                    ->disabled()
                                    ->statePath('client_name'),

                                TextInput::make('phone_number')
                                    ->required()
                                    ->statePath('phone_number'),

                                TextInput::make('address')
                                    ->required()
                                    ->statePath('address'),

                                TextInput::make('event')
                                    ->required()
                                    ->disabled()
                                    ->statePath('event'),

                                TextInput::make('amount')
                                    ->required()
                                    ->disabled()
                                    ->statePath('amount'),
                            ]),

                            Grid::make(4)->schema([
                                Select::make('mode_of_payment')
                                    ->options([
                                        'Walk-In' => 'Walk-In',
                                        'GCash' => 'GCash',
                                    ])
                                    ->required()
                                    ->reactive()
                                    ->statePath('mode_of_payment'),
                            ]),

                            Grid::make(4)->schema([
                                FileUpload::make('payment')
                                    ->directory('payments')
                                    ->image()
                                    ->columnSpan(2)
                                    ->statePath('payment')
                            ])->visible(fn($get) => $get('mode_of_payment') === 'GCash'),
                        ]),
                ])
                    ->submitAction(view('client.submit-form'))
            ])
            ->statePath('data');
    }

    public function save()
    {
        $this->isLoading = true;
        $data = $this->form->getState();

        // Update WeddingInfo
        $this->weddingInfo->update([
            'groom_name' => $data['groom_name'],
            'bride_name' => $data['bride_name'],
            'date_of_event' => $data['date_of_event'],
            'scheduled_practice' => $data['scheduled_practice'],
            'host_pastor' => $data['host_pastor'],
            'reception' => $data['reception'],
            'contact_number' => $data['contact_number'],
            'officiating_minister' => $data['officiating_minister'],
            'ring_bearer' => $data['ring_bearer'],
            'bible_bearer' => $data['bible_bearer'],
            'coin_bearer' => $data['coin_bearer'],
            'little_groom' => $data['little_groom'],
            'little_bride' => $data['little_bride'],
            'best_man' => $data['best_man'],
            'maid_of_honor' => $data['maid_of_honor'],
            'light_our_path' => json_encode($data['light_our_path']),
            'cloth_us_one' => json_encode($data['cloth_us_one']),
            'bind_us_together' => json_encode($data['bind_us_together']),
            'grooms_man' => json_encode($data['grooms_man']),
            'brides_maid' => json_encode($data['brides_maid']),
            'flower_girls' => json_encode($data['flower_girls']),
            'grooms_parent' => json_encode($data['grooms_parent']),
            'brides_parent' => json_encode($data['brides_parent']),
            'singer' => json_encode($data['singer']),
            'song' => json_encode($data['song']),
            'mode_of_payment' => $data['mode_of_payment'],
        ]);

        // Sync coordinators
        $this->weddingInfo->coordinators()->sync($data['coordinator']);

        // Handle principal sponsors
        WeddingSponsor::where('wedding_info_id', $this->weddingInfo->id)
            ->where('type', 'principal')
            ->delete();

        foreach ($data['principal_sponsor'] as $sponsor) {
            WeddingSponsor::create([
                'wedding_info_id' => $this->weddingInfo->id,
                'name' => $sponsor['name'],
                'type' => 'principal'
            ]);
        }

        // Handle payment if GCash
        if ($data['mode_of_payment'] === 'GCash' && isset($data['payment'])) {
            $this->weddingInfo->update([
                'payment_proof' => $data['payment'],
                'payment_status' => 'pending'
            ]);
        }

        $this->isLoading = false;
        session()->flash('success', 'Appointment updated successfully!');
        return redirect()->route('client.appointments');
    }

    public function render()
    {
        return view('livewire.client.edit-appointment');
    }
}