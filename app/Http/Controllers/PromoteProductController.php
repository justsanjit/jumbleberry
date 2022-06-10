<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PromoteProductController extends Controller
{
    public function __invoke(Product $product, Request $request)
    {
        if ($product->status !== ProductStatus::ACTIVE) {
            throw ValidationException::withMessages([
                'message' => 'You cannot promote products that are not active.'
            ]);
        }

        // Ensure user cannot request same product promotion twice
        if($request->user()->products()->where('product_id', $product->id)->exists()) {
            throw ValidationException::withMessages([
                'message' => 'You are already promoting this product'
            ]);
        }

        $request->user()->products()->attach($product);

        return back()->with('success', 'Product submitted for promotion. Admin will review your request.');
    }
}
