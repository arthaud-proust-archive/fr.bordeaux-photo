<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use \nadar\quill\Lexer;
use App\Models\Page;

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
        Schema::defaultStringLength(191);
        Blade::if('authRole', function ($value) {
            return (Auth::check() && in_array(Auth::user()->role, explode(',', $value)));
        });

        Blade::directive('infoPagesRoute', function () {
            return "<?php echo infoPagesRoute(); ?>";
        });

        Blade::directive('bindPagesRoute', function ($expression) {
            return "<?php echo bindPagesRoute($expression); ?>";
        });

        Blade::directive('quillContent', function ($expression) {
            return "<?php echo (new \\nadar\quill\Lexer($expression) )->render(); ?>";
        });

    }
}
