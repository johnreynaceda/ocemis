<div class="bg-white p-10 rounded-2xl" x-data="calendarComponent(@js($events))" x-init="initializeCalendar()">
    <div id="calendar"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
    function calendarComponent(events) {
        return {
            events: events,
            calendar: null,

            initializeCalendar() {
                let calendarEl = document.getElementById('calendar');

                this.calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: this.events, // Load initial events
                    eventDisplay: 'block',
                    eventContent: function(arg) {
                        // Customize event content if needed
                        return {
                            // html: `<div >${arg.event.title}</div>`
                            html: `<div style="background-color: ${arg.event.backgroundColor};" class="flex space-x-1 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                                <span>${arg.event.title}</span>
                                </div>`
                        };
                    },
                });

                this.calendar.render();

                // Listen for Livewire updates
                Livewire.on('updateCalendarEvents', (updatedEvents) => {
                    this.calendar.removeAllEvents();
                    this.calendar.addEventSource(updatedEvents);
                });
            },
        };
    }
</script>
