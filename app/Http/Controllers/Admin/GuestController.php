<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\GuestBroadcast;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GuestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invitation_id' => 'required|exists:invitations,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'guest_group' => 'nullable|string',
            'quota' => 'integer|min:1',
        ]);

        if (isset($validated['guest_group'])) {
            $validated['guest_group'] = Str::snake(Str::lower($validated['guest_group']));
        }

        $validated['guest_code'] = Str::random(8); // Simple random code

        Guest::create($validated);

        return redirect()->back()
            ->with('success', 'Guest added successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'guest_group' => 'nullable|string',
            'quota' => 'integer|min:1',
        ]);

        if (isset($validated['guest_group'])) {
            $validated['guest_group'] = Str::snake(Str::lower($validated['guest_group']));
        }

        $guest->update($validated);

        return redirect()->back()
            ->with('success', 'Guest updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->back()
            ->with('success', 'Guest deleted successfully.');
    }

    /**
     * Generate WhatsApp Broadcast for a guest
     */
    public function generateBroadcast(Request $request, Guest $guest)
    {
        $invitation = $guest->invitation;

        // 1. Template Message (Simplified for now, can be moved to DB/Config)
        $template = "Kepada Yth. *{{nama_tamu}}*,\n\nUndangan Pernikahan {{pria}} & {{wanita}}\n\nBuka undangan: {{link}}";

        // 2. Data Replacement
        $link = url("/u/{$invitation->slug}?to={$guest->guest_code}");

        $message = str_replace(
            ['{{nama_tamu}}', '{{pria}}', '{{wanita}}', '{{link}}'],
            [$guest->name, $invitation->groom_name, $invitation->bride_name, $link],
            $template
        );

        // 3. Format Phone
        $phone = preg_replace('/[^0-9]/', '', $guest->phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        // 4. Generate WhatsApp URL
        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        // 5. Save Broadcast Record
        GuestBroadcast::create([
            'guest_id' => $guest->id,
            'invitation_id' => $invitation->id,
            'sent_by' => auth()->id(),
            'phone_number' => $phone,
            'whatsapp_url' => $whatsappUrl,
            'message_template' => $template, // saving raw template
            'message_rendered' => $message,
            'invitation_url' => $link,
            'status' => 'url_generated',
            'url_generated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'whatsapp_url' => $whatsappUrl
        ]);
    }
}
