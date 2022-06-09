<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PromoteProductController extends Controller
{
    public function __invoke(Product $product, Request $request)
    {
        $request->user()->products()->attach($product);
        return back();
    }
}
