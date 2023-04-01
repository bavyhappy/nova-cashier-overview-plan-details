<?php

namespace Bavyhappy\NovaCashierOverviewPlanDetail\Http\Models;

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
        'description',
        'stripe_id',
        'default_price',
        'active',
    ];

    /**
     * Get the plans associated ad project.
     */
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
