<?php

namespace App\Providers;

use Illuminate\Testing\TestResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        TestResponse::macro('assertData', function ($json) {
            $this->assertJson([
                'data' => $json,
            ]);

            return $this;
        });

        TestResponse::macro('assertDataStructure', function ($structure) {
            $this->assertJsonStructure([
                'data' => $structure,
            ]);

            return $this;
        });

        TestResponse::macro('assertFailedResponse', function ($message, $code = null) {

            $this->assertJson([
                'success' => 0,
                'error'   =>  $message,
            ]);

            if ($code) {
                $this->assertStatus($code);
            }

            return $this;
        });

        TestResponse::macro('assertSuccessResponse', function ($dataKeys = []) {
            $this->assertSuccessful()
                ->assertJson([
                    'success' => 1,
                    'error'   => null
                ])
                ->assertDataStructure($dataKeys);

            return $this;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
