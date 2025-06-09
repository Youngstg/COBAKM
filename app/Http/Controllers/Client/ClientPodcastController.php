<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;

class ClientPodcastController extends Controller
{
    public function index(Request $request)
    {
        $latestPodcast = Podcast::latest()->first();
        $topPage = Podcast::where('top_podcast', true)->first();
        $podcasts = Podcast::where('id', '!=', $latestPodcast->id)
            ->latest()
            ->paginate(10);

        return view(
            'client.podcasts.index',
            compact('latestPodcast', 'podcasts', 'topPage')
        );
    }
}
