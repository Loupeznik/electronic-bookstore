<?php

namespace Tests\Feature;

use App\Models\Cart;
use Illuminate\Foundation\Testing\Concerns\InteractsWithSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithSession;

    /**
     * Create a cart for testing purposes.
     *
     * @return void
     */
    public function test_cart_creation()
    {
        $session = $this->session_id = session()->getId();
        
        Cart::create([
            'session_id' => $session
        ]);

        $this->assertDatabaseHas('carts', [
            'session_id' => $session
        ]);

    }

    /**
     * Create a cart for testing purposes.
     *
     * @return void
     */
    public function test_adding_cart_items_with_factory()
    {
        Cart::factory()->hasItems(2)->create([
            'session_id' => 'session_xxx'
        ]);

        $cart = Cart::withCount('items')->where('session_id', 'session_xxx')->first()->count();

        $this->assertEquals(2, $cart);
    }
}
