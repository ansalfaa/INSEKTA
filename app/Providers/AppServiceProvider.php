<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PengumumanGlobal;

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
        // Share $pengumumanGlobals ke semua view komponen right-sidebar siswa & admin
        View::composer([
            'components.siswa.right-sidebar',
            'components.admin.right-sidebar'
        ], function ($view) {
            $view->with('pengumumanGlobals', PengumumanGlobal::latest()->get());
        });
    }
}
