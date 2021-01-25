<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class HomepageController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Homepage', [
            'products' => Product::latest()->get(),
        ]);
    }
}
