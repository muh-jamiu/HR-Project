<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\PdfToText\Pdf;

class PdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Pdf::class, function ($app) {
            $pdf = new Pdf('C:\Program Files\poppler-24.02.0\Library\bin\pdftotext.exe');
            return $pdf;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
