<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'company_name',
        'phone',
        'address'
    ];

    /**
     * Get all of the cakes for the customer.
     */
    public function cakes(): BelongsToMany
    {
        return $this->belongsToMany(
            Cake::class,
            'cakes_customers',
            'customer_id',
            'cake_id'
        );
    }

    /**
     * Get all of the invoices for the customer.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
