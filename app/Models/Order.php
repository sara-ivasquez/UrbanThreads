<?php

namespace App\Models;

// Made by: Franchesca Garcia

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * ORDER ATTRIBUTES
 * $this->attributes['id'] - int - contains the primary key of the order
 * $this->attributes['totalPrice'] - int - contains the total price of the order
 * $this->attributes['state'] - string - contains the state of the order
 * $this->attributes['user_id'] - int - contains the foreign key of the user
 * $this->attributes['created_at'] - timestamp - contains the record creation date
 * $this->attributes['updated_at'] - timestamp - contains the record update date
 *
 * $this->items - Collection<Item> - contains the associated items
 * $this->user - User - contains the associated user
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'totalPrice',
        'state',
        'user_id',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTotalPrice(): int
    {
        return $this->attributes['totalPrice'];
    }

    public function setTotalPrice(int $totalPrice): void
    {
        $this->attributes['totalPrice'] = $totalPrice;
    }

    public function getState(): string
    {
        return $this->attributes['state'];
    }

    public function setState(string $state): void
    {
        $this->attributes['state'] = $state;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'] ?? null;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'] ?? null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public static function getOrdersByUserId(int $userId): Collection
    {
        return self::with(['items.product'])->where('user_id', $userId)->get();
    }
}