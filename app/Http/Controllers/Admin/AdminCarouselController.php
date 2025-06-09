<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCarouselController extends Controller
{
   public function index()
   {
      $carousels = Carousel::orderBy('order')->get();

      return view('admin.carousel.index', compact('carousels'));
   }

   public function edit(Carousel $carousel)
   {
      return view('admin.carousel.edit', compact('carousel'));
   }

   public function update(Request $request, Carousel $carousel)
   {
      $validatedData = $request->validate([
         'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);

      if ($request->hasFile('image')) {
         $imagePath = $request->file('image')->store('carousel', 'public');
         $carousel->image_path = $imagePath;
      }

      $carousel->save();

      if (Auth::user()->id_role == 1111) {
         return redirect()->route('ekraf.carousel.index')->with('success', 'Carousel item updated successfully');
      }
      return redirect()->route('admin.carousel.index')->with('success', 'Carousel item updated successfully');
   }

   public function store(Request $request)
   {
      $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);

      $imagePath = $request->file('image')->store('carousel', 'public');

      Carousel::create([
         'image_path' => $imagePath,
         'order' => Carousel::max('order') + 1,
      ]);
      if (Auth::user()->id_role == 1111) {
         return redirect()->route('ekraf.carousel.index')->with('success', 'Carousel item created successfully');
      }
      return redirect()->route('admin.carousel.index')->with('success', 'Carousel item created successfully');
   }

   public function create()
   {
      return view('admin.carousel.create');
   }

   public function destroy(Carousel $carousel)
   {
      $carousel->delete();
      if (Auth::user()->id_role == 1111) {
         return redirect()->route('ekraf.carousel.index')->with('success', 'Carousel item deleted successfully');
      }
      return redirect()->route('admin.carousel.index')->with('success', 'Carousel item deleted successfully');
   }

   public function changeOrder(Request $request, Carousel $carousel)
   {
      $direction = $request->input('direction');
      $currentOrder = $carousel->order;

      if ($direction === 'up' && $currentOrder > 1) {
         $swapCarousel = Carousel::where('order', $currentOrder - 1)->first();
         $swapCarousel->order = $currentOrder;
         $swapCarousel->save();

         $carousel->order = $currentOrder - 1;
         $carousel->save();
      } elseif ($direction === 'down') {
         $swapCarousel = Carousel::where('order', $currentOrder + 1)->first();
         if ($swapCarousel) {
            $swapCarousel->order = $currentOrder;
            $swapCarousel->save();

            $carousel->order = $currentOrder + 1;
            $carousel->save();
         }
      }

      if (Auth::user()->id_role == 1111) {
         return redirect()->route('ekraf.carousel.index')->with('success', 'Carousel order updated successfully');
      }
      return redirect()->route('admin.carousel.index')->with('success', 'Carousel order updated successfully');
   }
}
