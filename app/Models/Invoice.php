<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property int $is_early
 * @property float $amount
 * @property string $invoice_date
 * @property int $quantity
 * @property int $customer_id
 * @property int $cake_id
 * @property string|null $zoho_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Cake $cake
 * @property-read Customer $customer
 * @method static Builder|Invoice newModelQuery()
 * @method static Builder|Invoice newQuery()
 * @method static Builder|Invoice query()
 * @method static Builder|Invoice whereAmount($value)
 * @method static Builder|Invoice whereCakeId($value)
 * @method static Builder|Invoice whereCreatedAt($value)
 * @method static Builder|Invoice whereCustomerId($value)
 * @method static Builder|Invoice whereId($value)
 * @method static Builder|Invoice whereInvoiceDate($value)
 * @method static Builder|Invoice whereIsEarly($value)
 * @method static Builder|Invoice whereQuantity($value)
 * @method static Builder|Invoice whereUpdatedAt($value)
 * @method static Builder|Invoice whereZohoId($value)
 * @mixin Eloquent
 */
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
