<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cake extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    /**
     * Get all of the customers for the cake.
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,
            'cakes_customers',
            'cake_id',
            'customer_id'
        );
    }

    /**
     * Get all of the invoices for the cake.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
