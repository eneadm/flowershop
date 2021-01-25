<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Products/Index', [
            'products' => Product::latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'price' => 'required|numeric',
        ]);

        $product = new Product($request->only('title', 'description', 'price'));

        if ($request->exists('image')) {
            $product->image = str_replace('public/', '', $request->file('image')->store('public'));
        }

        $product->save();

        return redirect()->route('products.index');
    }

    public function create(): Response
    {
        return Inertia::render('Products/Create');
    }

    public function show(Product $product): Response
    {
        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'price' => 'required|numeric',
        ]);

        if ($request->exists('image')) {
            $product->image = str_replace('public/', '', $request->file('image')->store('public'));
        }

        $product->update($request->only('title', 'description', 'price'));

        return redirect()->route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
