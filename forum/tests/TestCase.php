<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Debug\ExceptionHandler; //Class Tests\ExceptionHandler does not exist
use App\Exceptions\Handler; // Class 'Tests\Handler' not found



abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }


    /**
     * to make the user authenticated
     * @param $user //not required
     */
    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');

        $this->actingAs($user);

        return $this;
    }



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
}
