<?php

namespace App\Providers;

use App\Models\Footer;
use App\Models\kbt;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        view()->composer(
            'layouts.client.footer',
            function ($view) {
                $logos = kbt::where('status_kbt', true)->select('nama_kbt', 'logo_kbt')->get();
                $footers = Footer::all();

                // Pass both footers and logos to the view
                $view->with([
                    'footers' => $footers,
                    'logos' => $logos,
                ]);
            }
        );

        view()->composer(
            'layouts.client.header',
            function ($view) {
                $kbt = kbt::where('status_kbt', true) // Mengurutkan berdasarkan tahun_kbt dari yang terbesar
                    ->select('nama_kbt', 'slug_kbt')
                    ->first();

                $view->with([
                    'kbt' => $kbt
                ]);
            }
        );


        view()->composer(
            'layouts.admin.menu',
            function ($view) {
                $logos = kbt::where('status_kbt', true)->select('nama_kbt', 'logo_kbt')->get();
                // Pass both footers and logos to the view
                $view->with([
                    'logos' => $logos,
                ]);
            }
        );

    }
}
