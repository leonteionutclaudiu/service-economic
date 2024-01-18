<?php

namespace App\Providers;

use A17\Twill\Facades\TwillNavigation;
use A17\Twill\View\Components\Navigation\NavigationLink;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;


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
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');

        TwillNavigation::addLink(
            NavigationLink::make()->forModule('homes')->title('Acasa')
        );
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('contacts')->title('Contact')
        );
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('noutatis')->title('Noutati')
        );
        // Modulul ECHIPA poate contine mai multe pagini (echipa,despre noi,cariera)
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('echipas')->title('Despre noi')
        );
    }
}
