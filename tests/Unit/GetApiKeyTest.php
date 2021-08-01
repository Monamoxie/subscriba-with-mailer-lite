<?php

namespace Tests\Unit\Auth;
use Tests\TestCase;

class GetApiKeyTest extends TestCase
{ 
    /**
     * @test 
    */
    public function should_fail_if_request_method_not_get()
    {  
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('PATCH', '/api/v1/api_keys');

        $response->assertStatus(405);
    }

    /**
    * @test 
    */
    public function should_fail_if_invalid_key()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('POST', '/api/v1/api_keys', [
                'api_key' => $this->faker->firstName
            ]);

        $response->assertStatus(400);
    }

    /**
    * @test 
    */
    public function should_pass_if_correct()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('GET', '/api/v1/api_keys');

        $response->assertStatus(200);
    } 

}
