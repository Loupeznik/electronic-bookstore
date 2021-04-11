<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ShippingMethodTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests creation of a shipping method.
     *
     * @return void
     */
    public function test_shipping_method_creation()
    {
        $user = User::factory()->admin()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->post('/admin/shipping-methods/create', [
            'name' => 'Shipping method test',
            'cost' => 120.39
        ]);

        $response->assertSee(['success', 'Shipping method test', '120.39']);
        return $user;
    }

    /**
     * Tests permissions on shipping method operations.
     *
     * @return void
     */
    public function test_shipping_method_access_restrictions()
    {
        $user = User::factory()->customer()->create();
        $method = ['Invalid method', 0];

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->post('/admin/shipping-methods/create', [
            'name' => $method[0],
            'cost' => $method[1]
        ]);

        $response->assertLocation('/');
        $this->assertDatabaseMissing('shipping_methods', ['name' => $method[0], 'cost' => $method[1]]);
    }

    /**
     * Tests shipping method update and deletion.
     *
     * @return void
     */
    public function test_shipping_method_update_delete()
    {
        $response = $this->post('/admin/shipping-methods/1/edit', [
            'name' => 'Edited shipping method',
            'cost' => 100
        ]);

        $response->assertSee(['success', 'Edited shipping method', '100']);

        $response = $this->delete('/admin/shipping-methods/1');

        $response->assertDontSee(['Edited shipping method', '100']);
    }
}
