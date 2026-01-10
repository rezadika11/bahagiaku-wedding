<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invitation;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInvitations = Invitation::count();
        $publishedInvitations = Invitation::where('status', 'published')->count();
        $totalClients = Client::count();

        // Upcoming weddings (next 5)
        $upcomingWeddings = Invitation::where('wedding_date', '>=', Carbon::today())
            ->orderBy('wedding_date', 'asc')
            ->take(5)
            ->with(['client'])
            ->get()
            ->map(function ($invitation) {
                return [
                    'id' => $invitation->id,
                    'slug' => $invitation->slug,
                    'couple_name' => $invitation->groom_name . ' & ' . $invitation->bride_name,
                    'wedding_date' => $invitation->wedding_date->format('d M Y'),
                    'client_name' => $invitation->client?->name,
                    'is_today' => $invitation->wedding_date->isToday(),
                ];
            });

        // Recent Activity (Latest 5 created invitations)
        $recentInvitations = Invitation::latest()
            ->take(5)
            ->get()
            ->map(function ($invitation) {
                return [
                    'id' => $invitation->id,
                    'description' => 'Created invitation for ' . $invitation->groom_name . ' & ' . $invitation->bride_name,
                    'created_at' => $invitation->created_at->diffForHumans(),
                    'user' => $invitation->createdBy?->name ?? 'System',
                ];
            });

        // Chart Data: Invitations per month for last 6 months
        $months = collect(range(5, 0))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('M Y');
        });

        $chartData = collect(range(5, 0))->map(function ($i) {
            $start = Carbon::now()->subMonths($i)->startOfMonth();
            $end = Carbon::now()->subMonths($i)->endOfMonth();
            return Invitation::whereBetween('created_at', [$start, $end])->count();
        });

        // Pie Chart Data: Invitations by Status
        $invitationsByStatus = Invitation::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $pieChartData = [
            'labels' => $invitationsByStatus->keys()->map(fn($k) => ucfirst($k))->toArray(),
            'series' => $invitationsByStatus->values()->toArray(),
        ];

        return Inertia::render('Dashboard', [
            'stats' => [
                'total_invitations' => $totalInvitations,
                'published_invitations' => $publishedInvitations,
                'total_clients' => $totalClients,
            ],
            'upcoming_weddings' => $upcomingWeddings,
            'recent_activity' => $recentInvitations,
            'chart_data' => [
                'labels' => $months,
                'series' => $chartData
            ],
            'pie_chart_data' => $pieChartData
        ]);
    }
}
