<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReturn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Order creation process test.
     * Creates the order from a cart for a dummy customer. Then deletes the cart.
     *
     * @return void
     */
    public function test_order_creation_and_operations()
    {
        $session = 'session_xxx';
        $checksum = 0;
        $checkvat = 0;

        $customer = Customer::factory()->hasPaymentMethods()->create([
            'name' => 'Test',
            'surname' => 'Customer'
        ]);
        
        $cart = Cart::with('items')->where('session_id', $session)->firstOrCreate([
            'session_id' => $session
        ]);

        CartItem::factory()->count(10)->create([
            'cart_id' => $cart->id
        ]);
        
        $order = Order::factory()->fresh()->create([
            'cart_id' => $cart->id,
            'customer_id' => $customer->id,
            'payment_method_id' => $customer->paymentMethods->first()
        ]);

        foreach ($cart->items as $item)
        {
            OrderItem::create([
                'book_id' => $item->book_id,
                'order_id' => $order->id,
                'count' => $item->count,
                'unit_price' => $item->book->sale_price ?? $item->book->price
            ]);

            $order->update([
                'sum' => $order->sum + ($item->count * $item->book->price),
                'vat' => $order->vat + (($item->count * $item->book->price) * 0.15),
                'status' => 1,
            ]);

            $checksum += $item->count * $item->book->price;
            $checkvat += ($item->count * $item->book->price) * 0.15;
        }

        $cart->delete();
        CartItem::where('cart_id', $cart->id)->delete();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 1,
            'sum' => $checksum,
            'vat' => $checkvat
        ]);

        $this->assertTrue($cart->trashed());
        $this->assertDatabaseMissing('cart_items', [
            'cart_id' => $cart->id
        ]);

        $order->update([
            'status' => 3
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 3
        ]);

        $return = OrderReturn::factory()->assigned()->create([
            'order_id' => $order->id,
        ]);

        $this->assertNotNull($return->assignee);
        $this->assertEquals($return->id, $order->orderReturn->id);

        return $order;
    }


    /**
     * Test soft deletes on orders.
     *
     * @depends test_order_creation
     * @return void
     */
    public function test_order_deletion($order)
    {
        $order->delete();

        $this->assertTrue($order->trashed());
    }
}
