<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'is_early',
        'amount',
        'invoice_date',
        'quantity',
        'cake_id'
    ];

    /**
     * Belongs to cake.
     */
    public function cake(): BelongsTo
    {
        return $this->belongsTo(Cake::class);
    }

    /**
     * Belongs to customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
