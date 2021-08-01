<?php

namespace Tests\Unit\Auth;

use Tests\AssignAuthData;
use Tests\TestCase;

class StoreNewSubscriberTest extends TestCase
{ 
    use AssignAuthData;
    

    
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadUp();
    }


    /**
    * @test 
    */
    public function should_fail_if_missing_one_or_all_required_params()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('POST', '/api/v1/subscribers');

        $response->assertStatus(422);
    }

    /**
    * @test 
    */
    public function should_pass_if_correct()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('POST', '/api/v1/subscribers', [
                'name' => $this->faker->name(),
                'email' => $this->faker->safeEmail,
                'country' => $this->faker->country()
            ]);

        $response->assertStatus(200);
    }

}
