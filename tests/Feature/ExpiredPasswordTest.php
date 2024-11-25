<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExpiredPasswordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->post('api/v1/forgot/password', [
            'email' => 'test@gmail.com',
        ]);


        $response->assertStatus(200);
    }
}
