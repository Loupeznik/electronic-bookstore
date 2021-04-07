<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test isAdmin middleware and custom redirections
     *
     * @return void
     */
    public function test_admin_section_access()
    {
        $user = User::factory()->admin()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::ADMIN_HOME);

        $route = $this->get('/admin/books');
        $route->assertStatus(200);
    }

    /**
     * Test access to both sections for non-admin users
     *
     * @return void
     */
    public function test_user_section_access()
    {
        $user = User::factory()->customer()->create();
        
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $route = $this->get('/admin/books');
        $route->assertRedirect('/');
    }
}
