<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/dashboard/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapFrontEndRoutes();

        $this->mapAddonRoutes();

        if (paytmRoute()) {
            // Paytm Route Map
            $this->mapPaytmRoutes();
            // paytm route goes here
        }

        if (zoomRoute()) {
            // Zoom Route Map
            $this->mapZoomRoutes();
            // Zoom route goes here
        }

        if (forumRoute()) {
            // Zoom Route Map
            $this->mapForumRoutes();
            // Zoom route goes here
        }

        if (quizRoute()) {
            //quiz route
            $this->mapQuizRoutes();
        }

        if (subscriptionRoute()) {
            //quiz route
            $this->mapSubscriptionRoutes();
        }

        if (certificate()) {
            /*certificate*/
            $this->mapCertificateRoutes();
        }

        if (env('THEME_MANAGER') == "YES") {
        // THEME MANAGER
            $this->mapThemeRoute();
        }

        /**
         * Coupon
         */

        if (couponRoute()) {
            $this->mapCouponRoutes();
        }

        /**
         * Wallet
         */

        if (walletRoute()) {
            $this->mapWalletRoutes();
        }

    }


    /*Theme manager*/
    protected function mapThemeRoute()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/theme.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }


    /**
     * Define the "Student" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapFrontEndRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend.php'));
    }


    /**
     * ADDON
     */
    protected function mapAddonRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/addon.php'));
    }


    /**
     * PayTM
     */
    protected function mapPaytmRoutes()
    {
        if (paytmRoute()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/paytm.php'));
        }
    }


    /**
     * Quiz Route
     */
    protected function mapQuizRoutes()
    {
        if (quizRoute()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/quiz.php'));

        }
    }

    /**
     * Zoom Route
     */

    protected function mapZoomRoutes()
    {
        if (zoomRoute()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/zoom.php'));
        }
    }

    /**
     * forum Route
     */

    protected function mapForumRoutes()
    {
        if (forumRoute()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/forum.php'));
        }
    }


    /*Certificate Route
     * */

    protected function mapCertificateRoutes()
    {
        if (certificate()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/certificate.php'));
        }
    }

    /* Subscription Route */

    protected function mapSubscriptionRoutes()
    {
        if (subscriptionRoute()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/subscription.php'));
        }
    }

    /* Coupon Route */

    protected function mapCouponRoutes()
    {
        if (couponRoute()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/coupon.php'));
        }
    }

    /* Wallet Route */

    protected function mapWalletRoutes()
    {
        if (walletRoute()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/wallet.php'));
        }
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
