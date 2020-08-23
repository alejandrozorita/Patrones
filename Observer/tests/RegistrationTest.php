<?php

namespace Patrones\Observer\Tests;

use Patrones\Observer\Registration;

class RegistrationTest extends TestCase
{
    /** @test */
    function user_registration()
    {
        $registration = new Registration();

        $result = $registration->create([
          'name' => 'Alejandro',
          'email' => 'alzort@gmail.com',
          'password' => 'laravel',
        ]);

        $this->assertTrue($result);
    }
}