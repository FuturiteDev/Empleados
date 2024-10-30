<?php

namespace Ongoing\Empleados;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class EmpleadosBaseServiceProvider extends ServiceProvider {

    public function boot(){
        $this->registerResources();
    }

    public function register(){
        $this->commands([
            Console\EmpleadosInitCommand::class
        ]);
    }

    private function registerResources(){
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'empleados');

        $this->registerRoutes();
    }

    protected function registerRoutes(){
        Route::group(["prefix" => "empleados"], function(){
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        Route::group([
            "prefix" => "api",
            "middleware" => ['api']
        ], function(){
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }
}