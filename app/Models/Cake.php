<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Cake
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property string|null $zoho_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Customer> $customers
 * @property-read int|null $customers_count
 * @property-read Collection<int, Invoice> $invoices
 * @property-read int|null $invoices_count
 * @method static Builder|Cake newModelQuery()
 * @method static Builder|Cake newQuery()
 * @method static Builder|Cake onlyTrashed()
 * @method static Builder|Cake query()
 * @method static Builder|Cake whereCreatedAt($value)
 * @method static Builder|Cake whereDeletedAt($value)
 * @method static Builder|Cake whereDescription($value)
 * @method static Builder|Cake whereId($value)
 * @method static Builder|Cake whereName($value)
 * @method static Builder|Cake wherePrice($value)
 * @method static Builder|Cake whereUpdatedAt($value)
 * @method static Builder|Cake whereZohoId($value)
 * @method static Builder|Cake withTrashed()
 * @method static Builder|Cake withoutTrashed()
 * @mixin Eloquent
 */
class Cake extends Model
{
    use HasFactory, SoftDeletes;

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
