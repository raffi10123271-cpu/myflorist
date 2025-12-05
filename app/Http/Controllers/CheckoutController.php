<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ShippingMethod;
use App\Notifications\OrderCreatedForSeller;
use App\Notifications\OrderCreatedForBuyer;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->with('product')->get();
        $addresses = Address::where('user_id', auth()->id())->get();
        $shippingMethods = ShippingMethod::all();


        return view('checkout.index', compact('cart','addresses','shippingMethods'));
    }

   public function process(Request $req)
{
    $req->validate([
        'address_id' => 'required|exists:addresses,id',
        'payment_method' => 'required|string',
        'shipping_method' => 'nullable|exists:shipping_methods,id'
    ]);

    DB::transaction(function () use ($req) {

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = 0;

        foreach ($cartItems as $c) {
            $total += ($c->product->price * $c->qty);
        }

        $shippingCost = (int) $req->shipping_cost ?? 0;

        $order = Order::create([
            'user_id'           => auth()->id(),
            'address_id'        => $req->address_id,
            'total'             => $total + $shippingCost,
            'status'            => 'pending',
            'shipping_method_id'=> $req->shipping_method ?? null,
            'shipping_cost'     => $shippingCost,
        ]);

        // buat order items & kurangi stok
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item->product_id,
                'product_name' => $item->product->title,
                'price'        => $item->product->price,
                'qty'          => $item->qty,
            ]);

            $item->product->decrement('stock', $item->qty);
        }

        // payment record
        $payment = Payment::create([
            'order_id' => $order->id,
            'method'   => $req->payment_method,
            'status'   => 'pending',
        ]);

        // HAPUS cart
        Cart::where('user_id', auth()->id())->delete();

        // --- DISPATCH NOTIFICATIONS ---
        // 1) Notify buyer
        $user = auth()->user();
        $user->notify(new OrderCreatedForBuyer($order));

        // 2) Notify each seller separately (items grouped by seller)
        $itemsGrouped = $order->items()->with('product')->get()->groupBy(function($it){
            return $it->product->seller_id;
        });

        foreach ($itemsGrouped as $sellerId => $itemsForSeller) {
            $seller = \App\Models\User::find($sellerId);
            if ($seller) {
                // make simple array payload
                $itemsArray = $itemsForSeller->map(function($it){
                    return [
                        'product_id' => $it->product_id,
                        'product_name' => $it->product_name,
                        'qty' => $it->qty
                    ];
                })->toArray();

                $seller->notify(new OrderCreatedForSeller($order, $itemsArray, $user));
            }
        }
        // --- END notifications ---
    });

        // setelah order berhasil dibuat
            $chatUrl = route('chat.detail', $item->product->seller_id);

        // tambahkan ke data notifikasi
            $buyer->notify(new OrderCreatedForBuyer($order + [
        'chat_url' => $chatUrl
        ]));


    return redirect()->route('orders')->with('success', 'Pesanan berhasil dibuat dan notifikasi dikirim.');
}
}
