<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;
    
    protected function setUp():void
    {
        parent::setUp();

        DB::statement('PRAGMA foreign_keys=on;');

        $this->artisan('passport:install');
        $this->disableExceptionHandling();
    }


    // Hat tip, @adamwathan. to fix test exception handling
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }

    /**
     * Create user and get token
     * @return string
     */
    protected function authenticate(){
        
        $user = factory('App\User')->create();

        //Passport::actingAs($user);

        $token = $user->createToken('MyApp')->accessToken;


        $this->user = $user;

        return $token;
    }
}
