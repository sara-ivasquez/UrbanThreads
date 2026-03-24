<?php

namespace App\Models;

/**
 * Franchesca Garcia
 */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * REVIEW ATTRIBUTES
     * $this->attributes['id'] - int - contains the primary key of the review
     * $this->attributes['qualification'] - int - contains the review qualification
     * $this->attributes['description'] - string - contains the review description
     * $this->attributes['user_id'] - int - contains the foreign key of the user
     * $this->attributes['product_id'] - int - contains the foreign key of the product
     * $this->attributes['created_at'] - timestamp - contains the record creation date
     * $this->attributes['updated_at'] - timestamp - contains the record update date
     *
     * $this->user - User - contains the associated user
     * $this->product - Product - contains the associated product
     */
    protected $fillable = [
        'qualification',
        'description',
        'user_id',
        'product_id',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQualification(): int
    {
        return $this->attributes['qualification'];
    }

    public function setQualification(int $qualification): void
    {
        $this->attributes['qualification'] = $qualification;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public static function getByProductIdOrderedByDate(int $productId): Collection
    {
        return self::where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}