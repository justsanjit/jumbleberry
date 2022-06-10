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

        $request->user()->products()->attach($product);

        return back()->with('success', 'Product submitted for promotion. Admin will review your request.');
    }
}
