<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInvitationRequest;
use App\Http\Requests\Admin\UpdateInvitationRequest;
use App\Models\Client;
use App\Models\Invitation;
use App\Models\Theme;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Invitation::with(['client', 'theme']);

        if ($request->has('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(groom_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(bride_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$search}%"]);
            });
        }

        $invitations = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return Inertia::render('Admin/Invitations/Index', [
            'invitations' => $invitations,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Invitations/Create', [
            'clients' => Client::select('id', 'name')->get(),
            'themes' => Theme::where('is_active', true)->select('id', 'name', 'thumbnail')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvitationRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();

        // Auto generate slug if not provided
        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['groom_name'] . '-' . $validated['bride_name']);
            $validated['slug'] = $baseSlug;
            // Handle duplicates logic could be added here
        }

        $invitation = Invitation::create($validated);

        return redirect()->route('admin.invitations.show', $invitation)
            ->with('success', 'Invitation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Invitation $invitation)
    {
        $guestQuery = $invitation->guests()->orderBy('id', 'desc');

        if ($request->has('guest_search')) {
            $search = strtolower($request->guest_search);
            $guestQuery->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return Inertia::render('Admin/Invitations/Show', [
            'invitation' => $invitation->load(['client', 'theme', 'events']),
            'guests' => $guestQuery->paginate(10)->withQueryString(),
            'guestFilters' => $request->only(['guest_search']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        $invitationData = $invitation->toArray();
        if ($invitation->wedding_date) {
            $invitationData['wedding_date'] = $invitation->wedding_date->format('Y-m-d');
        }

        return Inertia::render('Admin/Invitations/Edit', [
            'invitation' => $invitationData,
            'themes' => Theme::where('is_active', true)->select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvitationRequest $request, Invitation $invitation)
    {
        $invitation->update($request->validated());

        return to_route('admin.invitations.index')
            ->with('success', 'Invitation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();

        return to_route('admin.invitations.index')
            ->with('success', 'Invitation deleted successfully.');
    }
}
