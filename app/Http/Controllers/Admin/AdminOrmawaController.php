<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ormawa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminOrmawaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;

        $hmpsPage = $request->query('hmps_page', 1);
        $ukmsPage = $request->query('ukms_page', 1);

        $hmps = Ormawa::where('hmps', true)->orderBy('order')->paginate($perPage, ['*'], 'hmps_page', $hmpsPage);
        $ukms = Ormawa::where('ukm', true)->orderBy('order')->paginate($perPage, ['*'], 'ukms_page', $ukmsPage);

        return view('admin.ormawa.index', compact('hmps', 'ukms'));
    }


    public function create()
    {
        return view('admin.ormawa.create');
    }

    public function edit($slug, $type)
    {
        $ormawa = Ormawa::where('slug', $slug)->firstOrFail();

        return view('admin.ormawa.edit', compact('ormawa', 'type'));
    }

    public function update(Request $request, $slug, $type)
    {
        $ormawa = Ormawa::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'nama_ormawa' => 'required|string|max:255',
            'ketua_ormawa' => 'required|string|max:255',
            'website' => 'nullable|url',
            'deskripsi_ormawa' => 'nullable|string',
            'dies_natalis' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ormawa->name = $validatedData['nama_ormawa'];
        $ormawa->ketua = $validatedData['ketua_ormawa'];
        $ormawa->website = $validatedData['website'] ?? null;
        $ormawa->details = $validatedData['deskripsi_ormawa'] ?? null;
        $ormawa->dies_natalis = $validatedData['dies_natalis'] ?? null;
        $ormawa->linkedin = $validatedData['linkedin'] ?? null;
        $ormawa->instagram = $validatedData['instagram'] ?? null;
        $ormawa->youtube = $validatedData['youtube'] ?? null;

        if ($request->hasFile('logo')) {
            if ($ormawa->image) {
                Storage::disk('public')->delete($ormawa->image);
            }
            $imagePath = $request->file('logo')->store('ormawa_images', 'public');
            $ormawa->image = $imagePath;
        }

        $ormawa->save();

        return redirect()->route('admin.ormawa.index')->with('success', "{$type} updated successfully");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori' => 'required|string|in:HMPS,UKM',
            'nama_ormawa' => 'required|string|max:255',
            'ketua_ormawa' => 'required|string|max:255',
            'website' => 'nullable|url',
            'deskripsi_ormawa' => 'nullable|string',
            'dies_natalis' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ormawa = new Ormawa;
        $ormawa->name = $validatedData['nama_ormawa'];
        $ormawa->slug = Str::slug($validatedData['nama_ormawa']);
        $ormawa->ketua = $validatedData['ketua_ormawa'];
        $ormawa->website = $validatedData['website'] ?? null;
        $ormawa->details = $validatedData['deskripsi_ormawa'] ?? null;
        $ormawa->dies_natalis = $validatedData['dies_natalis'] ?? null;
        $ormawa->linkedin = $validatedData['linkedin'] ?? null;
        $ormawa->instagram = $validatedData['instagram'] ?? null;
        $ormawa->youtube = $validatedData['youtube'] ?? null;
        $ormawa->order = Ormawa::max('order') + 1;
        $ormawa->hmps = $validatedData['kategori'] === 'HMPS';
        $ormawa->ukm = $validatedData['kategori'] === 'UKM';

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('ormawa_images', 'public');
            $ormawa->image = $imagePath;
        }

        $ormawa->save();

        return redirect()->route('admin.ormawa.index')->with('success', "{$validatedData['kategori']} created successfully");
    }

    public function destroy($slug, $type)
    {
        $ormawa = Ormawa::where('slug', $slug)->firstOrFail();

        if ($ormawa->image) {
            Storage::disk('public')->delete($ormawa->image);
        }

        $ormawa->delete();

        return redirect()->route('admin.ormawa.index')->with('success', "{$type} deleted successfully");
    }

    public function changeOrder(Request $request, $slug, $type, $direction)
    {
        $ormawa = Ormawa::where('slug', $slug)->firstOrFail();
        $currentOrder = $ormawa->order;

        if ($direction === 'up') {
            $swapOrmawa = Ormawa::where('order', '<', $currentOrder)->orderBy('order', 'desc')->first();
        } else {
            $swapOrmawa = Ormawa::where('order', '>', $currentOrder)->orderBy('order', 'asc')->first();
        }

        if ($swapOrmawa) {
            $tempOrder = $ormawa->order;
            $ormawa->order = $swapOrmawa->order;
            $swapOrmawa->order = $tempOrder;

            $ormawa->save();
            $swapOrmawa->save();
        }

        return redirect()->route('admin.ormawa.index')->with('success', 'Order updated successfully.');
    }
}
