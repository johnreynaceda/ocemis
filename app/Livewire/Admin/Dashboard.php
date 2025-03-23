<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;

class Dashboard extends Component
{
    public $events = [];

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = Appointment::where('status', 'approved')
            ->get()
            ->map(function ($appointment) {
                return [
                   'id'    => $appointment->id, // Unique ID for the event
                    'title' => $appointment->event->name,
                    'start' => $appointment->date_of_event, // Date only
                    'end'   => $appointment->date_of_event,
                    'color' => $this->getEventColor($appointment->event_id), // Assign color based on ID
                ];
            });
    }
    private function getEventColor($id)
    {
        // Define your color logic here
        $colors = ['#FF0000', '#FF0000', '#60a5fa', '#fbbf24', '#a78bfa'];
        return $colors[$id % count($colors)]; // Cycle through colors based on ID
    }


    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
