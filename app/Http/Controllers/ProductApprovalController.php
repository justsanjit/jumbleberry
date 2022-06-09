<?php

namespace App\Http\Controllers;

use App\Enums\ApprovalStatus;
use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductApprovalController extends Controller
{
    public function index()
    {
        $this->authorize('manage_approvals');

        $pendingProducts = fn(Builder $query) => $query->where('product_user.status', 'pending');

        $users = User::query()
            ->whereHas('products', $pendingProducts)
            ->with('products', $pendingProducts)
            ->orderBy('name')
            ->get();

        return view('products-approval', [
            'users' => $users
        ]);
    }

    public function changeStatus(Product $product, Request $request)
    {
        $this->authorize('manage_approvals');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:approved,rejected'
        ]);

        if ($product->status !== ProductStatus::ACTIVE) {
            throw ValidationException::withMessages([
                'message' => 'Product is no longer active',
            ]);
        }

        $product->users()->updateExistingPivot($request->user_id, [
            'status' => $request->status
        ]);

        return back();
    }

    public function decline(Product $product, Request $request)
    {
        $this->authorize('manage_approvals');

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if ($product->status !== ProductStatus::ACTIVE) {
            throw ValidationException::withMessages([
                'message' => 'Product is no longer active',
            ]);
        }

        $product->users()->updateExistingPivot($request->user_id, [
            'status' => ApprovalStatus::APPROVED->value
        ]);

        return back();
    }
}
