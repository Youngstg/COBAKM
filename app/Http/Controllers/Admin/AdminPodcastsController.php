<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPodcastsController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::orderBy("order")->get();
        return view("admin.podcasts.index", compact("podcasts"));
    }

    public function create()
    {
        return view("admin.podcasts.create");
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "judul" => "required|max:255",
                "deskripsi" => "required",
                "kategori" => "required",
                "narasumber" => "required",
                "pewawancara" => "required",
                "link" => "required|url",
                "thumbnail" =>
                    "required|image|mimes:jpeg,png,jpg,gif|max:10240",
            ]);

            if ($request->hasFile("thumbnail")) {
                $path = $request
                    ->file("thumbnail")
                    ->store("podcast_thumbnails", "public");
                $validatedData["thumbnail"] = $path;
            }

            $validatedData["features_podcast"] = $request->has(
                "features_podcast"
            )
                ? true
                : false;

            $validatedData["top_podcast"] = $request->has(
                "top_podcast"
            )
                ? true
                : false;

            $validatedData["order"] = Podcast::max("order") + 1;

            Podcast::create($validatedData);

            return redirect()
                ->route("admin.podcasts.index")
                ->with("success", "Podcast berhasil ditambahkan.");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors("Something went wrong. Please try again.");
        }
    }

    public function edit(Podcast $podcast)
    {
        return view("admin.podcasts.edit", compact("podcast"));
    }

    public function update(Request $request, Podcast $podcast)
    {
        $validatedData = $request->validate([
            "judul" => "required|max:255",
            "deskripsi" => "required",
            "kategori" => "required",
            "narasumber" => "required",
            "pewawancara" => "required",
            "link" => "required|url",
            "thumbnail" => "image|mimes:jpeg,png,jpg,gif|max:10240",
        ]);

        if ($request->hasFile("thumbnail")) {
            Storage::disk("public")->delete($podcast->thumbnail);
            $path = $request
                ->file("thumbnail")
                ->store("podcast_thumbnails", "public");
            $validatedData["thumbnail"] = $path;
        }

        $validatedData["features_podcast"] = $request->has("features_podcast")
            ? true
            : false;

        $validatedData["top_podcast"] = $request->has("top_podcast")
            ? true
            : false;

        $podcast->update($validatedData);

        return redirect()
            ->route("admin.podcasts.index")
            ->with("success", "Podcast berhasil diperbarui.");
    }

    public function destroy(Podcast $podcast)
    {
        Storage::disk("public")->delete($podcast->thumbnail);
        $podcast->delete();

        return redirect()
            ->route("admin.podcasts.index")
            ->with("success", "Podcast berhasil dihapus.");
    }

    public function moveUp(Podcast $podcast)
    {
        $previousPodcast = Podcast::where("order", "<", $podcast->order)
            ->orderBy("order", "desc")
            ->first();
        if ($previousPodcast) {
            $tempOrder = $podcast->order;
            $podcast->order = $previousPodcast->order;
            $previousPodcast->order = $tempOrder;
            $podcast->save();
            $previousPodcast->save();
        }

        return redirect()->route("admin.podcasts.index");
    }

    public function moveDown(Podcast $podcast)
    {
        $nextPodcast = Podcast::where("order", ">", $podcast->order)
            ->orderBy("order")
            ->first();
        if ($nextPodcast) {
            $tempOrder = $podcast->order;
            $podcast->order = $nextPodcast->order;
            $nextPodcast->order = $tempOrder;
            $podcast->save();
            $nextPodcast->save();
        }

        return redirect()->route("admin.podcasts.index");
    }
}
