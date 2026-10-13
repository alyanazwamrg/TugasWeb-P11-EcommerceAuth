<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    // Hanya admin dan editor yang boleh menambah produk
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    // Admin boleh semua; editor hanya produk miliknya
    public function update(User $user, Product $product): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'editor' && $product->user_id === $user->id);
    }

    public function delete(User $user, Product $product): bool
    {
        return $this->update($user, $product);
    }
}