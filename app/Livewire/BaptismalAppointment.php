<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\BaptismalInfo;
use App\Models\Coordinator;
use App\Models\Event;
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

class BaptismalAppointment extends Component implements HasForms
{
    use InteractsWithForms;

    public $client_name, $pastor, $location, $contact_number, $baby_name, $birthplace, $birthdate, $coordinators, $mother_name, $father_name;
    public $date_of_event;
    public $singer =[['name' => '']];
    public $song =[['name' => '']];
    public $godparents =[['name' => '']];

    public $fullname, $event, $event_id, $amount, $mode_of_payment, $payment = [];

    public function mount(){
        $this->fullname = auth()->user()->name;
        $this->event_id = request('id');
        $this->event = Event::where('id', $this->event_id)->first()->name;
        $this->amount = Event::where('id', $this->event_id)->first()->amount;
    }
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('INFORMATIONS')->completedIcon('heroicon-m-check')
                        ->schema([
                           Grid::make(4)->schema([
                            TextInput::make('client_name')->required(),
                           TextInput::make('pastor')->required(),
                           TextInput::make('location')->required(),
                           TextInput::make('contact_number')->required(),
                           TextInput::make('baby_name')->required(),
                           DatePicker::make('birthdate')->required(),
                           TextInput::make('birthplace')->required(),
                           Select::make('coordinators')->multiple()->options(Coordinator::all()->mapWithKeys(
                            function($record){
                                return [$record->id => $record->firstname. ' ' . $record->lastname];
                            }
                           ))
                           
                           ]),
                           Grid::make(4)->schema([
                            TextInput::make('mother_name')->required(),
                           TextInput::make('father_name')->required(),
                           DatePicker::make('date_of_event')->required(),
                          
                           
                           ]),
                           Grid::make(4)->schema([
                            Fieldset::make('SINGERS')->schema([
                                Repeater::make('singer')->columnSpan(2)->label('')
                                ->schema([
                                    TextInput::make('name')->required()
                                ])->addActionLabel('Add New Singer')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                ])->columnSpan(2),
                                Fieldset::make('SONGS')->schema([
                                    Repeater::make('song')->columnSpan(2)->label('')
                                    ->schema([
                                        TextInput::make('name')->required()
                                    ])->addActionLabel('Add New Song')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                    ])->columnSpan(2),
                               ])
                           
                            
                          
                        ]),
                    Wizard\Step::make('GODPARENTS')
                        ->schema([
                            Grid::make(4)->schema([
                                Fieldset::make('Godparents')->schema([
                                    Repeater::make('godparents')->columnSpan(2)->label('')
                                    ->schema([
                                        TextInput::make('name')->required()
                                    ])->addActionLabel('Add New Godparent')->addActionAlignment(Alignment::Start)->defaultItems(1)
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
                    'date_of_event' => Carbon::parse($this->date_of_event),
                ]);

                BaptismalInfo::create([
                    'appointment_id' => $appointment->id,
                    'client_name' => $this->client_name,
                    'pastor' => $this->pastor,
                    'location' => $this->location,
                    'contact_number' => $this->contact_number,
                    'baby_name' => $this->baby_name,
                    'birthplace' => $this->birthplace,
                    'birthdate' => $this->birthdate,
                    'coordinators' => json_encode($this->coordinators),
                   'mother_name' => $this->mother_name,
                    'father_name' => $this->father_name,
                   'singer' => json_encode($this->singer),
                   'song' => json_encode($this->song),
                    'godparents' => json_encode($this->godparents),
                ]);
            }
        }else{
            $appointment = Appointment::create([
                'user_id' => auth()->user()->id,
                'event_id' => $this->event_id,
                'amount' => $this->amount,
                'mode_of_payment' => $this->mode_of_payment,
                'date_of_event' => Carbon::parse($this->date_of_event),
            ]);
            BaptismalInfo::create([
                'appointment_id' => $appointment->id,
                'client_name' => $this->client_name,
                'pastor' => $this->pastor,
                'location' => $this->location,
                'contact_number' => $this->contact_number,
                'baby_name' => $this->baby_name,
                'birthplace' => $this->birthplace,
                'birthdate' => $this->birthdate,
                'coordinator' => json_encode($this->coordinators),
                'mother_name' => $this->mother_name,
                'father_name' => $this->father_name,
               'singer' => json_encode($this->singer),
               'song' => json_encode($this->song),
                'godparent' => json_encode($this->godparents),
            ]);
        }

        return redirect()->route('client.dashboard');
    }
    public function render()
    {
        return view('livewire.baptismal-appointment');
    }
}
