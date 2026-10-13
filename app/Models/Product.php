<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'user_id', 'name', 'slug',
        'description', 'price', 'stock', 'published',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'published' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag')
            ->withPivot('created_by')
            ->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scope: Product::published()->get()
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    // Scope: Product::inStock()->get()
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}