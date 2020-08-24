<?php

namespace Patrones\Observer\Tests;

use Patrones\Observer\Registration;

class RegistrationTest extends TestCase
{
    /** @test */
    function user_registration()
    {
        $logger = $this->loggerFake('logger-test.txt');

        $mailer = $this->mailerFake();

        $registration = new Registration($logger, $mailer);

        $result = $registration->create([
          'name' => 'Alejandro',
          'email' => 'alzort@gmail.com',
          'password' => 'laravel',
        ]);

        $this->assertTrue($result);

        $logger->assertFileEquals('User Alejandro <alzort@gmail.com> was created');

        $mailer->assertSentTimes(1)
               ->assertSentTo('alzort@gmail.com')
               ->assertSubjectEquals('Welcome')
        ->assertBodyEquals("Hello Alejandro, welcome to bytecode.es");

    }

}