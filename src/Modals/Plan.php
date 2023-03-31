<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'product_id',
        'stripe_id',
        'active',
        'currency',
        'interval',
        'type',
        'amount'
    ];

    /**
     * Get the product associated at plan.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
