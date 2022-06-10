<?php

namespace App\Http\Controllers;

use App\Enums\ApprovalStatus;
use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductApprovedNotification;
use App\Notifications\ProductRejectedNotification;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
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

    public function changeStatus(Product $product, User $user, Request $request)
    {
        $this->authorize('manage_approvals');

        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        if ($product->status !== ProductStatus::ACTIVE) {
            throw ValidationException::withMessages([
                'message' => 'Product is no longer active',
            ]);
        }

        $product->users()->updateExistingPivot($user, [
            'status' => $request->status
        ]);

        $notification = $request->status === 'approved'
            ? new ProductApprovedNotification($product)
            : new ProductRejectedNotification($product);

        Notification::send($user, $notification);

        return back();
    }
}
