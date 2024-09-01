<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class GlobalFunctionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        require_once base_path().'/app/GlobalFunctions.php';

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->checkCreditLine();
    }

    protected function checkCreditLine()
    {

        $creditLine = 'Designed and Developed by <b><q>Muhammad Azam</q></b>';

        $admin_layout = File::get(resource_path('views/admin_panel/_layout.blade.php'));
        $student_layout = File::get(resource_path('views/student/_layout.blade.php'));

        if (strpos($admin_layout, $creditLine) === false || 
        strpos($student_layout, $creditLine) === false) {
            // If not present, abort with a 403 Forbidden error
            abort(403, 'Unauthorized modification detected.');
        }
    }
}
