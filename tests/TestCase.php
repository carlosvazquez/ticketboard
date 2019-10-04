<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function signIn($user = null)
    {
        // the same as $this->be(factory('App\Models\User')->create());
        $this->actingAs($user ?: factory('App\Models\User')->create());
    }
}
