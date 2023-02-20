<?php

namespace App\Models;

use Eloquent;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $type
 * @property string $first_name
 * @property string $last_name
 * @property string $display_name
 * @property string $company_name
 * @property string $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $zoho_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Cake> $cakes
 * @property-read int|null $cakes_count
 * @property-read Collection<int, Invoice> $invoices
 * @property-read int|null $invoices_count
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer onlyTrashed()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereAddress($value)
 * @method static Builder|Customer whereCompanyName($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereDeletedAt($value)
 * @method static Builder|Customer whereEmail($value)
 * @method static Builder|Customer whereFirstName($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereLastName($value)
 * @method static Builder|Customer whereDisplayName($value)
 * @method static Builder|Customer wherePhone($value)
 * @method static Builder|Customer whereType($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @method static Builder|Customer whereZohoId($value)
 * @method static Builder|Customer withTrashed()
 * @method static Builder|Customer withoutTrashed()
 * @mixin Eloquent
 */
class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'type',
        'first_name',
        'last_name',
        'display_name',
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
