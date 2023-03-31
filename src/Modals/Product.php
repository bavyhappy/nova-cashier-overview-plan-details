<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'stripe_id',
        'default_price',
        'active',
    ];

    /**
     * Get the prices associated ad project.
     */
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
