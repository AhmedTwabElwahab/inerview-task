<?php

namespace Tests\Feature\traits;
trait LoginTest
{
    /**
     * login to access your app.
     *
     * @return void
     */
    public function test_login(): void
    {
        $response = $this->post('/login',[
            'email'     => EMAIL,
            'password'  => PASSWORD
        ]);

        $response->assertRedirect('/home');
    }
}
