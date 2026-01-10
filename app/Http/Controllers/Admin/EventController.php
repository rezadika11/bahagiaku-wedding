<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invitation_id' => 'required|exists:invitations,id',
            'event_type' => 'required|in:akad,resepsi,unduh_mantu,other',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time_start' => 'required',
            'event_time_end' => 'nullable',
            'venue_name' => 'required|string|max:255',
            'venue_address' => 'required|string',
            'venue_map_url' => 'nullable|string',
            'timezone' => 'required|in:WIB,WITA,WIT',
        ]);

        Event::create($validated);

        return redirect()->back()
            ->with('success', 'Event created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time_start' => 'required',
            'event_time_end' => 'nullable',
            'venue_name' => 'required|string|max:255',
            'venue_address' => 'required|string',
            'venue_map_url' => 'nullable|string',
            'timezone' => 'required|in:WIB,WITA,WIT',
        ]);

        $event->update($validated);

        return redirect()->back()
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->back()
            ->with('success', 'Event deleted successfully.');
    }
}
