<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * to make the user authenticated
     * @param $user
     */
    public function signIn($user)
    {
        $this->be($user);
    }
}
