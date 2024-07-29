<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PagesExistTest extends TestCase
{
    public function test_welcome_page_exists(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_affiliates_page_exists(): void
    {
        $response = $this->get('/affiliates');

        $response->assertStatus(200);
    }

    public function test_affiliates_too_far_away_page_exists(): void
    {
        $response = $this->get('/affiliates/too-far-away');

        $response->assertStatus(200);
    }
}
