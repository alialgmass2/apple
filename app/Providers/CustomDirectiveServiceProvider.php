<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class CustomDirectiveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->bootMacros();
// TO CHEKC ROUTE NAME TO MARK CATEGORIES AS ACTIVE
        Blade::directive('success', function () {
            return "<?php echo session()->flash('success', __('app.success'))?>";
        });

    }

    public function bootMacros()
    {

        Component::macro('alertSuccess', function ($text, $title = 'success', $type = 'success') {
            $icon = asset('images/tick.png');
            $ok = __('app.ok');
            $this->js(<<<JS
                Swal.fire({
                      imageUrl: "{$icon}",
                      text:"{$text}",
                    confirmButtonText: '{$ok}',
                    showCloseButton: true,
                });
            JS);
            // $this->js(<<<JS
            //     Swal.fire(
            //     '{$title}',
            //     '{$text}',
            //     '{$type}'
            //     );
            // JS);
        });

        Component::macro('alertSuccessCart', function ($text, $title = 'success', $type = 'success') {
            $icon = asset('images/tick.png');
            $routeCart = route('carts.index');
            $ContinueShopping = __('app.continue_shopping');
            $goToCart = __('app.go_to_cart');
            $this->js(<<<JS
                Swal.fire({
                      imageUrl: "{$icon}",
                      text:"{$text}",
                    //   showCloseButton:true,
                      showCancelButton: true,
                      focusConfirm: false,
                      confirmButtonText: '{$ContinueShopping}',
                      showCloseButton: true,
                    cancelButtonText: '<a href="{$routeCart}" class="btn-alert-go-to-cart">{$goToCart}</a>',
                    cancelButtonColor:"#000"
                            // confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                });
            JS);
            // $this->js(<<<JS
            //     Swal.fire(
            //     '{$title}',
            //     '{$text}',
            //     '{$type}'
            //     );
            // JS);
        });

        Component::macro('success', function ($text = '', $type = 'success') {
            session()->flash($type, __('app.data_saved'));
        });
    }
}
