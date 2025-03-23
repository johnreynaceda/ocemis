<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Billing;
use Carbon\Carbon;
use Livewire\Component;

class AppointmentView extends Component
{
    public $appointment_id;
    public $appointment;

    public $songs, $singers;
    public $principals;

    public $light_our_path;
    public $cloth_us_one;
    public $bind_us_together;
    public $grooms_man;
    public $brides_maid;
    public $flower_girls;
    public $grooms_parent;
    public $brides_parent;

    public $officiating_minister, $ring_bearer, $bible_bearer, $coin_bearer, $little_groom, $little_bride, $best_man, $maid_of_honor;  

    public $client_name, $host_pastor, $reception, $contact_number, $scheduled_practice, $coordinator, $groom_name, $bride_name;

    public $location, $baby_name, $birthdate,$birthplace, $mother_name, $father_name, $godparent = [];
    public $music_in_charge, $program_in_charge, $date, $master_of_ceremony, $speaker, $participants = [];

    public function mount(){
        $this->appointment_id = request('id');
        $this->appointment = Appointment::where('id', $this->appointment_id)->first();

       switch ($this->appointment->event_id) {
        case 1:
            $this->client_name = $this->appointment->weddingInfo->client_name;
            $this->host_pastor = $this->appointment->weddingInfo->host_pastor;
            $this->reception = $this->appointment->weddingInfo->reception;
            $this->contact_number = $this->appointment->weddingInfo->contact_number;
            $this->scheduled_practice = Carbon::parse($this->appointment->weddingInfo->scheduled_practice)->format('d/m/Y');
            $this->groom_name = $this->appointment->weddingInfo->groom_name;
            $this->bride_name = $this->appointment->weddingInfo->bride_name;
            $this->coordinator = json_decode($this->appointment->weddingInfo->coordinator,true);
            $this->songs = json_decode($this->appointment->weddingInfo->song,true);
            $this->singers = json_decode($this->appointment->weddingInfo->singer,true);
            $this->principals = json_decode($this->appointment->weddingInfo->principal_sponsor,true);
    
            $this->officiating_minister = $this->appointment->weddingInfo->weddingSponsor->officiating_minister;
            $this->ring_bearer = $this->appointment->weddingInfo->weddingSponsor->ring_bearer;
            $this->bible_bearer = $this->appointment->weddingInfo->weddingSponsor->bible_bearer;
            $this->coin_bearer = $this->appointment->weddingInfo->weddingSponsor->coin_bearer;
            $this->little_groom = $this->appointment->weddingInfo->weddingSponsor->little_groom;
            $this->little_bride = $this->appointment->weddingInfo->weddingSponsor->little_bride;
            $this->best_man = $this->appointment->weddingInfo->weddingSponsor->best_man;
            $this->maid_of_honor = $this->appointment->weddingInfo->weddingSponsor->maid_of_honor;
    
            $this->light_our_path = json_decode($this->appointment->weddingInfo->weddingSponsor->to_light_out_path, true);
            $this->cloth_us_one = json_decode($this->appointment->weddingInfo->weddingSponsor->to_cloth_us_one, true);
            $this->bind_us_together = json_decode($this->appointment->weddingInfo->weddingSponsor->to_bind_us_together, true);
            $this->flower_girls = json_decode($this->appointment->weddingInfo->weddingSponsor->flower_girls, true);
            $this->grooms_man = json_decode($this->appointment->weddingInfo->weddingSponsor->grooms_man, true);
            $this->brides_maid = json_decode($this->appointment->weddingInfo->weddingSponsor->brides_maid, true);
            $this->grooms_parent = json_decode($this->appointment->weddingInfo->weddingSponsor->grooms_parent, true);
            $this->brides_parent = json_decode($this->appointment->weddingInfo->weddingSponsor->brides_parent, true) ?? [];
            break;
            case 2:
                $this->client_name = $this->appointment->baptismalInfo->client_name;
                $this->host_pastor = $this->appointment->baptismalInfo->pastor;
                $this->location = $this->appointment->baptismalInfo->location;
                $this->contact_number = $this->appointment->baptismalInfo->contact_number;
                $this->baby_name = $this->appointment->baptismalInfo->baby_name;
                $this->birthdate = $this->appointment->baptismalInfo->birthdate;
                $this->birthplace = $this->appointment->baptismalInfo->birthplace;
                $this->mother_name = $this->appointment->baptismalInfo->mother_name;
                $this->father_name = $this->appointment->baptismalInfo->father_name;
                $this->songs = json_decode($this->appointment->baptismalInfo->song,true);
            $this->singers = json_decode($this->appointment->baptismalInfo->singer,true);
            $this->coordinator = json_decode($this->appointment->baptismalInfo->coordinator,true);
            $this->godparent = json_decode($this->appointment->baptismalInfo->godparent,true);
            break;

            case 3:
                $this->client_name = $this->appointment->fellowShipInfo->client_name;
                $this->location = $this->appointment->fellowShipInfo->location;
                $this->contact_number = $this->appointment->fellowShipInfo->contact_number;
                $this->music_in_charge = $this->appointment->fellowShipInfo->music_in_charge;
                $this->program_in_charge = $this->appointment->fellowShipInfo->program_in_charge;
                $this->date = $this->appointment->fellowShipInfo->date;
                $this->coordinator = json_decode($this->appointment->fellowShipInfo->coordinators, true);
                $this->master_of_ceremony = $this->appointment->fellowShipInfo->master_of_ceremony;
                $this->speaker = $this->appointment->fellowShipInfo->speaker;
                $this->songs = json_decode($this->appointment->fellowShipInfo->songs, true);
                $this->participants = json_decode($this->appointment->fellowShipInfo->participants, true);


            break;
        
        default:
            # code...
            break;
       }
        
    }

    

    public function addCoordinator()
    {
        $this->coordinator[] = ['name' => ''];
    }

    public function removeCoordinator($index)
    {
        unset($this->coordinator[$index]);
        $this->coordinator = array_values($this->coordinator); // Reindex the array
    }

    public function approve(){
        if ($this->appointment->mode_of_payment == 'GCash') {
            Billing::create([
                'appointment_id' => $this->appointment_id,
                'total_amount' => $this->appointment->amount,
                'status' => 'paid',
            ]);
        }else{
            Billing::create([
                'appointment_id' => $this->appointment_id,
                'total_amount' => $this->appointment->amount,
            ]);
        }
        $this->appointment->update(['status' => 'approved']);

        return redirect()->route('admin.appointments');
    }

    public function render()
    {
        return view('livewire.admin.appointment-view');
    }
}
