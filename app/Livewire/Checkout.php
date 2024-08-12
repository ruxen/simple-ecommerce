<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Traits\CartTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

#[Title('Checkout | RuxenShop')]

class Checkout extends Component
{
    use LivewireAlert;

    public $items;
    public $total;
    public $firstName;
    public $lastName;
    public $phone;
    public $address;
    public $district;
    public $city;
    public $province;
    public $zipCode;
    private $snapToken;

    public function mount()
    {
        $this->items = CartTrait::getCartItemsFromCookie();
        $this->total = CartTrait::calculateGrandTotal($this->items);

        if (count($this->items) == 0) {
            return redirect()->route('products');
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'district' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zipCode' => 'required|numeric|digits:5'
        ]);

        $this->integrateMidtrans();
    }

    private function integrateMidtrans()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
        \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = 0;
        \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = 0;
        \Midtrans\Config::$curlOptions[CURLOPT_HTTPHEADER] = [];

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $this->total,
            ],
            'customer_details' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        $this->dispatch('snap-token', token: $this->snapToken);
    }

    #[On('payment-status')]
    public function paymentStatus($status)
    {
        switch ($status) {
            case 'success':
                $this->handlePaymentSuccess();
                break;
            case 'pending':
                $this->handlePaymentPending();
                break;
            case 'error':
                $this->handlePaymentError();
                break;
            default:
                $this->alert('error', 'An unexpected issue occurred. Please try again later.', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
        }
    }

    private function handlePaymentSuccess()
    {
        $this->alert('success', 'Your payment was successful! Thank you for your purchase.', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);

        $this->decreaseStock();
        $this->createOrder();

        return redirect()->route('orders');
    }

    private function decreaseStock()
    {
        foreach ($this->items as $item) {
            Product::find($item['product_id'])->decrement('stock', $item['quantity']);
        }
    }

    private function createOrder()
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'grand_total' => $this->total,
        ]);

        Address::create([
            'order_id' => $order->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'address' => $this->address,
            'district' => $this->district,
            'city' => $this->city,
            'province' => $this->province,
            'zip_code' => $this->zipCode,
        ]);

        $order->items()->createMany($this->items);
        CartTrait::clearCartItems();
    }

    private function handlePaymentPending()
    {
        $this->alert('warning', 'Your payment is currently pending. Please try again later or contact support if the issue persists.', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    private function handlePaymentError()
    {
        $this->alert('error', 'Payment failed. Please check your payment details and try again.', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);

        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
