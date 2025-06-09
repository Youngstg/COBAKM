<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrmawaRequest;
use App\Http\Requests\UpdateOrmawaRequest;
use App\Models\Ormawa;

class OrmawaController extends Controller
{
    public function index()
    {
        $ormawa = Ormawa::all();

        return response()->json($ormawa);
    }

    public function store(StoreOrmawaRequest $request)
    {
        $ormawa = Ormawa::create($request->validated());

        return response()->json($ormawa, 201);
    }

    public function show($id)
    {
        $ormawa = Ormawa::findOrFail($id);

        return response()->json($ormawa);
    }

    public function update(UpdateOrmawaRequest $request, $id)
    {
        $ormawa = Ormawa::findOrFail($id);
        $ormawa->update($request->validated());

        return response()->json($ormawa);
    }

    public function destroy($id)
    {
        $ormawa = Ormawa::findOrFail($id);
        $ormawa->delete();

        return response()->json(null, 204);
    }
}
