<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Documento;
use App\Models\FlujoTramite;
use App\Models\FlujoDocumento;
use App\Models\TipoTramite;
use App\Models\Programa;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Observers\HistorialObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Documento::observe(HistorialObserver::class);
        FlujoTramite::observe(HistorialObserver::class);
        FlujoDocumento::observe(HistorialObserver::class);
        TipoTramite::observe(HistorialObserver::class);
        Programa::observe(HistorialObserver::class);
        User::observe(HistorialObserver::class);
        Permission::observe(HistorialObserver::class);
        Role::observe(HistorialObserver::class);
    }
}
