<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/artisan-command', function () {
    $artisanCommand = '<a href="' . route('clear-cache') . '" target="_blank">Clear Cache</a><br><br>';
    $artisanCommand .= '<a href="' . route('optimize') . '" target="_blank">Reoptimized class loader</a><br><br>';
    $artisanCommand .= '<a href="' . route('route-cache') . '" target="_blank">Route cache</a><br><br>';
    $artisanCommand .= '<a href="' . route('route-clear') . '" target="_blank">Route clear</a><br><br>';
    $artisanCommand .= '<a href="' . route('view-clear') . '" target="_blank">View clear</a><br><br>';
    $artisanCommand .= '<a href="' . route('config-cache') . '" target="_blank">Config cache clear</a><br><br>';

    $artisanCommand .= '<a href="' . route('queue-work') . '" target="_blank">Queue Work</a><br><br>';
    $artisanCommand .= '<a href="' . route('queue-retry') . '" target="_blank">Queue Retry</a><br><br>';
    $artisanCommand .= '<a href="' . route('migrate') . '" target="_blank">Migrate</a><br><br>';

    return $artisanCommand;
});

Route::group(['prefix' => 'artisan-command'], function () {
    // migrate
    Route::get('/migrate', function () {
        Artisan::call('migrate --force');
        return '<h1>Migrate Successully</h1>';
    })->name('migrate');

    //Clear Cache facade value:
    Route::get('/clear-cache', function () {
        $exitCode = Artisan::call('cache:clear');
        return '<h1>Cache facade value cleared</h1>';
    })->name('clear-cache');

    //Reoptimized class loader:
    Route::get('/optimize', function () {
        $exitCode = Artisan::call('optimize');
        return '<h1>Reoptimized class loader</h1>';
    })->name('optimize');

    //Route cache:
    Route::get('/route-cache', function () {
        $exitCode = Artisan::call('route:cache');
        return '<h1>Routes cached</h1>';
    })->name('route-cache');

    //Clear Route cache:
    Route::get('/route-clear', function () {
        $exitCode = Artisan::call('route:clear');
        return '<h1>Route cache cleared</h1>';
    })->name('route-clear');

    //Clear View cache:
    Route::get('/view-clear', function () {
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    })->name('view-clear');

    //Clear Config cache:
    Route::get('/config-cache', function () {
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared</h1>';
    })->name('config-cache');

    //queuw work:
    Route::get('/queue-work', function () {
        Artisan::call('queue:work --stop-when-empty');
        return '<h1>Queue Work</h1>';
    })->name('queue-work');

    //queuw retry:
    Route::get('/queue-retry', function () {
        Artisan::call('queue:retry all');
        return '<h1>Queue retry</h1>';
    })->name('queue-retry');

    //queuw flush (delete):
    Route::get('/queue-flush', function () {
        Artisan::call('queue:flush');
        return '<h1>Queue flush (delete)</h1>';
    })->name('queue-flush');
});
