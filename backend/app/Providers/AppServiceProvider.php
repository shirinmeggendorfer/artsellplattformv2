<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;



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
    public function boot()
    {
    
       
       
       
        View::composer('*', function ($view) {
            $hasNewMessages = false;
            if (auth()->check()) {
                $userId = auth()->id();
                $hasNewMessages = Message::where('recipient_id', $userId)
                                        ->where('is_read', false)
                                        ->exists();
            }
    
            $view->with('hasNewMessages', $hasNewMessages);
        });
    }
}
