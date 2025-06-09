<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\KMActivity;
use App\Models\TagATK;
use Carbon\Carbon;

class ClientKMActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = Carbon::now();

        $activities = KMActivity::with('tags')
            ->get()
            ->map(function ($activity) {
                $activity->formatted_date = Carbon::parse($activity->tgl_pelaksanaan)->locale('id')->format('j F Y, H:i');

                return $activity;
            });

        $nears = $activities->sortBy(function ($activity) use ($currentDate) {
            return abs($currentDate->diffInDays(Carbon::parse($activity->tgl_pelaksanaan)));
        })
            ->take(3);

        $tags = TagATK::all();

        return view('client.km-activity.index', compact('activities', 'tags', 'nears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(string $slug)
    {
        //
        $activity = KMActivity::where('slug_kmac', $slug)->first();
        if (! $activity) {
            abort(404);
        }

        return view('client.km-activity.read', compact('activity'));
    }

    /**
     * Store a newly created resource in storage.
     */
}
