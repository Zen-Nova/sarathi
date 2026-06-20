<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->seed();
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_select_service_filters_by_department(): void
    {
        $this->seed();
        
        // Test citizenship department filtering (English locale)
        $response = $this->withSession(['locale' => 'en'])->get('/select-service?department=citizenship');
        $response->assertStatus(200);
        $response->assertSee('New Citizenship Certificate');
        $response->assertSee('General Inquiry');
        $response->assertDontSee('New e-Passport Application');

        // Test passport department filtering (Nepalese locale)
        $response = $this->withSession(['locale' => 'ne'])->get('/select-service?department=passport');
        $response->assertStatus(200);
        $response->assertSee('नयाँ ई-राहदानी दरखास्त दर्ता');
        $response->assertSee('राहदानी नवीकरण वा नयाँ प्रतिस्थापन');
        $response->assertDontSee('नयाँ नागरिकता प्रमाणपत्र प्राप्ति');
    }
}
