<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|gt:0',
        ]);

        $product = $request->only('id', 'image', 'title', 'quantity', 'price');

        $basket = collect($request->session()->get('basket'));

        $products = $basket->contains('id', $request->get('id'))
            ? $basket->map(function ($item) use ($product) {
                if ($item['id'] === $product['id']) {
                    $item['quantity']++;
                }

                return $item;
            })
            : $basket->push($product);

        $request->session()->put('basket', $products);

        return redirect()->route('checkout.index');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $basket = collect($request->session()->get('basket'));

        $products = $basket->filter(function ($item) use ($product) {
            return $item['id'] !== $product['id'];
        });

        $request->session()->put('basket', $products->toArray());

        return redirect()->route('checkout.index');
    }
}
