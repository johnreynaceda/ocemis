<?php

namespace App\Livewire\Client;

use App\Models\Appointment;
use App\Models\Coordinator;
use App\Models\Event;
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
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Support\Enums\Alignment;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Wizard;
use Livewire\Component;

class WeddingAppointment extends Component implements HasForms
{
    use InteractsWithForms;
    public $singer =[['name' => '']];
    public $song =[['name' => '']];
    public $principal_sponsor =[['name' => '']];
    public $light_our_path =[['name' => '']];
    public $cloth_us_one =[['name' => '']];
    public $bind_us_together =[['name' => '']];
    public $grooms_man =[['name' => '']];
    public $brides_maid =[['name' => '']];
    public $flower_girls =[['name' => '']];
    public $grooms_parent =[['name' => '']];
    public $brides_parent =[['name' => '']];

    public $officiating_minister, $ring_bearer, $bible_bearer, $coin_bearer, $little_groom, $little_bride, $best_man, $maid_of_honor;  

    public $client_name, $host_pastor, $reception, $contact_number, $scheduled_practice, $coordinator, $groom_name, $bride_name;

    public $fullname, $event, $event_id, $amount, $mode_of_payment, $payment = [];

    public $date_of_event;

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
                           TextInput::make('host_pastor')->required(),
                           TextInput::make('reception')->required(),
                           TextInput::make('contact_number')->required(),
                           DatePicker::make('scheduled_practice')->required(),
                           Select::make('coordinator')->multiple()->required()->options(Coordinator::all()->mapWithKeys(
                            function($record){
                                return [$record->id => $record->firstname. ' ' . $record->lastname];
                            }
                        )),
                         DatePicker::make('date_of_event')->required(),
                           
                           ]),
                          
                           Grid::make(4)->schema([
                            TextInput::make('groom_name')->required(),
                           TextInput::make('bride_name')->required(),
                          
                           
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
                    Wizard\Step::make('PRINCIPAL SPONSORS')
                        ->schema([
                            Grid::make(4)->schema([
                                Fieldset::make('SPONSORS')->schema([
                                    Repeater::make('principal_sponsor')->columnSpan(2)->label('')
                                    ->schema([
                                        TextInput::make('name')->required()
                                    ])->addActionLabel('Add New Principal')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                    ])->columnSpan(2),
                                    ]),
                        ]),
                    Wizard\Step::make('SECONDARY SPONSORS')
                        ->schema([
                            Grid::make(4)->schema([
                                TextInput::make('officiating_minister')->required(),
                              
                               TextInput::make('ring_bearer')->required(),
                               TextInput::make('bible_bearer')->required(),
                               TextInput::make('coin_bearer')->required(),
                               TextInput::make('little_groom')->required(),
                               TextInput::make('little_bride')->required(),
                            ]),
                            Grid::make(3)->schema([
                                Fieldset::make('TO LIGHT OUR PATH')->schema([
                                    Repeater::make('light_our_path')->columnSpan(2)->label('')
                                    ->schema([
                                        TextInput::make('name')->required()
                                    ])->addActionLabel('Add New Name')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                    ])->columnSpan(1),
                                Fieldset::make('TO CLOTH US ONE')->schema([
                                    Repeater::make('cloth_us_one')->columnSpan(2)->label('')
                                    ->schema([
                                        TextInput::make('name')->required()
                                    ])->addActionLabel('Add New Name')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                    ])->columnSpan(1),
                                Fieldset::make('TO BIND US TOGETHER')->schema([
                                    Repeater::make('bind_us_together')->columnSpan(2)->label('')
                                    ->schema([
                                        TextInput::make('name')->required()
                                    ])->addActionLabel('Add New Name')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                    ])->columnSpan(1),
                            ]),
                                    Grid::make(3)->schema([
                                       
                                        TextInput::make('best_man')->required(),
                                        TextInput::make('maid_of_honor')->required(),
                                     ]),
                                     Grid::make(3)->schema([
                                        Fieldset::make('GROOMS MAN')->schema([
                                            Repeater::make('grooms_man')->columnSpan(2)->label('')
                                            ->schema([
                                                TextInput::make('name')->required()
                                            ])->addActionLabel('Add New Name')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                            ])->columnSpan(1),
                                        Fieldset::make('BRIDES MAID')->schema([
                                            Repeater::make('brides_maid')->columnSpan(2)->label('')
                                            ->schema([
                                                TextInput::make('name')->required()
                                            ])->addActionLabel('Add New Name')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                            ])->columnSpan(1),
                                        Fieldset::make('FLOWER GIRLS')->schema([
                                            Repeater::make('flower_girls')->columnSpan(2)->label('')
                                            ->schema([
                                                TextInput::make('name')->required()
                                            ])->addActionLabel('Add New Name')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                            ])->columnSpan(1),
                                    ]),
                                     Grid::make(3)->schema([
                                        Fieldset::make('GROOMS PARENT')->schema([
                                            Repeater::make('grooms_parent')->columnSpan(2)->label('')
                                            ->schema([
                                                TextInput::make('name')->required()
                                            ])->addActionLabel('Add New Name')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                            ])->columnSpan(1),
                                        Fieldset::make('BRIDES PARENT')->schema([
                                            Repeater::make('brides_parent')->columnSpan(2)->label('')
                                            ->schema([
                                                TextInput::make('name')->required()
                                            ])->addActionLabel('Add New Name')->addActionAlignment(Alignment::Start)->defaultItems(1)
                                            ])->columnSpan(1),
                                        
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

              $wedding =  WeddingInfo::create([
                    'appointment_id' => $appointment->id,
                    'client_name' => $this->client_name,
                    'host_pastor' => $this->host_pastor,
                    'reception' => $this->reception,
                    'contact_number' => $this->contact_number,
                    'scheduled_practice' => Carbon::parse($this->scheduled_practice),
                    'groom_name' => $this->groom_name,
                    'bride_name' => $this->bride_name,
                    'coordinator' => json_encode($this->coordinator),
                    'singer' => json_encode($this->singer),
                    'song' => json_encode($this->song),
                    'principal_sponsor' => json_encode($this->principal_sponsor),
                ]);

                WeddingSponsor::create([
                    'wedding_info_id' => $wedding->id,
                    'officiating_minister' => $this->officiating_minister,
                    'ring_bearer' => $this->ring_bearer,
                    'bible_bearer' => $this->bible_bearer,
                    'coin_bearer' => $this->coin_bearer,
                    'little_groom' => $this->little_groom,
                    'little_bride' => $this->little_bride,
                    'best_man' => $this->best_man,
                   'maid_of_honor' => $this->maid_of_honor,
                   'to_light_out_path' => json_encode($this->light_our_path),
                   'to_cloth_us_one' => json_encode($this->cloth_us_one),
                   'to_bind_us_together' => json_encode($this->bind_us_together),
                   'grooms_man' => json_encode($this->grooms_man),
                   'brides_maid' => json_encode($this->brides_maid),
                   'flower_girls' => json_encode($this->flower_girls),
                   'grooms_parent' => json_encode($this->grooms_parent),
                   'brides_parent' => json_encode($this->brides_parent),
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
            $wedding =  WeddingInfo::create([
                'appointment_id' => $appointment->id,
                'client_name' => $this->client_name,
                'host_pastor' => $this->host_pastor,
                'reception' => $this->reception,
                'contact_number' => $this->contact_number,
                'scheduled_practice' => Carbon::parse($this->scheduled_practice),
                'groom_name' => $this->groom_name,
                'bride_name' => $this->bride_name,
                'coordinator' => json_encode($this->coordinator),
                'singer' => json_encode($this->singer),
                'song' => json_encode($this->song),
                'principal_sponsor' => json_encode($this->principal_sponsor),
            ]);

            WeddingSponsor::create([
                'wedding_info_id' => $wedding->id,
                'officiating_minister' => $this->officiating_minister,
                'ring_bearer' => $this->ring_bearer,
                'bible_bearer' => $this->bible_bearer,
                'coin_bearer' => $this->coin_bearer,
                'little_groom' => $this->little_groom,
                'little_bride' => $this->little_bride,
                'best_man' => $this->best_man,
               'maid_of_honor' => $this->maid_of_honor,
               'to_light_out_path' => json_encode($this->light_our_path),
               'to_cloth_us_one' => json_encode($this->cloth_us_one),
               'to_bind_us_together' => json_encode($this->bind_us_together),
               'grooms_man' => json_encode($this->grooms_man),
               'brides_maid' => json_encode($this->brides_maid),
               'flower_girls' => json_encode($this->flower_girls),
               'grooms_parent' => json_encode($this->grooms_parent),
               'brides_parent' => json_encode($this->brides_parent) ,
            ]);
        }

        return redirect()->route('client.dashboard');


    }

    public function render()
    {
        return view('livewire.client.wedding-appointment');
    }
}
