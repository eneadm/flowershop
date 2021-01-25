<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CheckoutController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Checkout', [
            'products' => collect($request->session()->get('basket'))->values()->toArray()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $order = Order::create([
            'user_id' => auth()->id(),
        ]);

        $basket = collect($request->session()->get('basket'));

        $products = Product::whereIn('id', $basket->pluck('id'))->get();

        foreach ($products as $product) {
            $order->items()->create([
                'title' => $product->title,
                'description' => $product->description,
                'quantity' => $basket->firstWhere('id', $product->id)['quantity'] ?? 1,
                'price' => $product->price,
            ]);
        }

        $request->session()->forget('basket');

        return redirect()->route('homepage')->with('flash', [
            'message' => 'Thank you for using FLOWERSHOP, we will notify you when the order is shipped.'
        ]);
    }
}
