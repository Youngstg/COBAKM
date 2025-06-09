<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ormawa;
use Illuminate\Http\Request;

class ClientOrmawaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input("search");
        $activeTab = "HMPS";

        $hmpsQuery = Ormawa::where("hmps", true);
        $ukmsQuery = Ormawa::where("ukm", true);

        if ($search) {
            $hmpsQuery->where("name", "like", "%$search%");
            $ukmsQuery->where("name", "like", "%$search%");
        }

        $hmps = $hmpsQuery->orderBy("order")->paginate(1, ["*"], "hmps_page");
        $ukms = $ukmsQuery->orderBy("order")->paginate(1, ["*"], "ukm_page");

        if ($search !== "") {
            if ($hmps->count() > 0) {
                $activeTab = "HMPS";
            } elseif ($ukms->count() > 0) {
                $activeTab = "UKM";
            }
        }

        return view(
            "client.ormawa.index",
            compact("hmps", "ukms", "search", "activeTab")
        );
    }

    public function show($slug)
    {
        $organization = Ormawa::where("slug", $slug)->firstOrFail();

        return response()->json($organization);
    }
}
