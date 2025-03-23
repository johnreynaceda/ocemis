<?php

namespace App\Livewire\Client;

use App\Models\Appointment;
use App\Models\Coordinator;
use App\Models\Event;
use App\Models\FellowShipInfo;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Support\Enums\Alignment;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FellowShipAppointment extends Component implements HasForms
{
    use InteractsWithForms;
    
    public $client_name, $location, $contact_number, $music_in_charge, $program_in_charge, $date, $coordinators, $master_of_ceremony, $speaker;
    public $song = [['name' => '']];
    public $participants = [['name' => '']];

    public $fullname, $event, $event_id, $amount, $mode_of_payment, $payment = [];
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('INFORMATIONS')->completedIcon('heroicon-m-check')
                        ->schema([
                           Grid::make(4)->schema([
                            TextInput::make('client_name')->required(),
                           TextInput::make('location')->required(),
                           TextInput::make('contact_number')->required(),
                           TextInput::make('music_in_charge')->required(),
                           TextInput::make('program_in_charge')->required(),
                           DatePicker::make('date')->required(),
                           Select::make('coordinators')->multiple()->options(Coordinator::all()->mapWithKeys(
                            function($record){
                                return [$record->id => $record->firstname. ' ' . $record->lastname];
                            }
                           ))
                           
                           ]),
                           Grid::make(4)->schema([
                            TextInput::make('master_of_ceremony')->required(),
                           TextInput::make('speaker')->required(),
                          
                           
                           ]),
                           Grid::make(4)->schema([
                            Fieldset::make('PRAISE & WORSHIP SONG')->schema([
                                Repeater::make('song')->columnSpan(2)->label('')
                                ->schema([
                                    TextInput::make('name')->required()
                                ])->addActionLabel('Add New Songs')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                ])->columnSpan(2),
                               
                               ])
                           
                            
                          
                        ]),
                    Wizard\Step::make('PARTICIPANTS')
                        ->schema([
                            Grid::make(4)->schema([
                                Fieldset::make('PARTICIPANT REGISTRATION')->schema([
                                    Repeater::make('participants')->columnSpan(2)->label('')
                                    ->schema([
                                        TextInput::make('name')->required(),
                                        TextInput::make('amount')->required()->numeric()
                                    ])->addActionLabel('Add New Participant')->addActionAlignment(Alignment::Start)->defaultItems(1)->columns(2)
                                    ])->columnSpan(2),
                                    ]),
                        ]),
                   
                    Wizard\Step::make('BILLING')
                        ->schema([
                            Grid::make(4)->schema([
                                TextInput::make('fullname')->disabled(),
                                TextInput::make('phone_number')->required(),
                                TextInput::make('address')->required(),
                                TextInput::make('event')->required()->disabled(),
                                TextInput::make('amount')->required()->disabled(),
                            ]),
                            Grid::make(4)->schema([
                               Select::make('mode_of_payment')->options([
                                'Walk-In' => 'Walk-In',
                                'GCash' => 'GCash',
                               ])->reactive(),
                            ]),
                            Grid::make(4)->schema([
                               FileUpload::make('payment')->columnSpan(2)
                            ])->visible(fn ($get) => $get('mode_of_payment') === 'GCash'),
                          
                        ]),
                   
                ])->submitAction(view('client.submit-form'))
            ]);
    }

    public function submitRecord(){
        sleep(1);

        if ($this->payment) {
            foreach ($this->payment as $key => $value) {
                $appointment = Appointment::create([
                    'user_id' => auth()->user()->id,
                    'event_id' => $this->event_id,
                    'amount' => $this->amount,
                    'mode_of_payment' => $this->mode_of_payment,
                    'proof' => $value->store('Proof', 'public'),
                    'date_of_event' => Carbon::parse($this->date),
                ]);

                FellowShipInfo::create([
                    'appointment_id' => $appointment->id,
                    'client_name' => $this->fullname,
                    'location' => $this->location,
                    'contact_number' => $this->contact_number,
                    'music_in_charge' => $this->music_in_charge,
                    'program_in_charge' => $this->program_in_charge,
                    'date' => Carbon::parse($this->date),
                    'coordinators' => json_encode($this->coordinators),
                    'master_of_ceremony' => $this->master_of_ceremony,
                    'speaker' => $this->speaker,
                    'songs' => json_encode($this->song),
                    'participants' => json_encode($this->participants),
                ]);         
            }
        }else{
            $appointment = Appointment::create([
                'user_id' => auth()->user()->id,
                'event_id' => $this->event_id,
                'amount' => $this->amount,
                'mode_of_payment' => $this->mode_of_payment,
                'date_of_event' => Carbon::parse($this->date),
            ]);
            FellowShipInfo::create([
                'appointment_id' => $appointment->id,
                'client_name' => $this->fullname,
                'location' => $this->location,
                'contact_number' => $this->contact_number,
                'music_in_charge' => $this->music_in_charge,
                'program_in_charge' => $this->program_in_charge,
                'date' => Carbon::parse($this->date),
                'coordinators' => json_encode($this->coordinators),
                'master_of_ceremony' => $this->master_of_ceremony,
                'speaker' => $this->speaker,
                'songs' => json_encode($this->song),
                'participants' => json_encode($this->participants),
            ]);   
        }

        return redirect()->route('client.dashboard');
    }

   

    public function mount(){
        $this->fullname = auth()->user()->name;
        $this->event_id = request('id');
        $this->event = Event::where('id', $this->event_id)->first()->name;
    }

    public function render()
    {
        $this->amount = array_sum(array_column($this->participants, 'amount'));
        return view('livewire.client.fellow-ship-appointment');
    }
}
