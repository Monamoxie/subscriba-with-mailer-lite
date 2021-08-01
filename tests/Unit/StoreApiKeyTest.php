<?php

namespace Tests\Unit\Auth;
 
use Tests\TestCase;

class StoreApiKeyTest extends TestCase
{ 
    /**
     * @test 
    */
    public function should_fail_if_request_method_not_post()
    {  
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('PATCH', '/api/v1/api_keys');

        $response->assertStatus(405);
    }

    /**
    * @test 
    */
    public function should_fail_if_missing_one_or_all_required_params()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('POST', '/api/v1/api_keys');

        $response->assertStatus(422);
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

}
