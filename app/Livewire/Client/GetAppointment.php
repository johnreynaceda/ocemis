<?php

namespace App\Livewire\Client;

use Event;
use Livewire\Component;

class GetAppointment extends Component
{
    public $event_name;
    public $event_id;

    public function mount(){
        $this->event_id  = request('id');
        $this->event_name = \App\Models\Event::where('id', $this->event_id)->first()->name;
    }
    public function render()
    {
        return view('livewire.client.get-appointment');
    }
}
