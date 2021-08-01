<?php

namespace Tests\Unit\Auth;

use Tests\AssignAuthData;
use Tests\TestCase;

class GetSubscribersTest extends TestCase
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
    public function should_pass_if_correct()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('GET', '/api/v1/subscribers');

        $response->assertStatus(200);
    } 

}
