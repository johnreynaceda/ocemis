<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class ClientDashboard extends Component
{
    public function render()
    {
        return view('livewire.client-dashboard',[
            'events' => Event::all(),
        ]);
    }
}
