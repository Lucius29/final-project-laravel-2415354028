<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        "id",
        "name",
        "email",
        "phone",
        "address",
        "status"
    ];

    protected function casts(): array
    {
        return [
            "status" => "boolean",
        ];
    }

    /**
     * @return HasMany<Subscription, $this>
     */
    // public function subscriptions(): HasMany
    // {
    //     return $this->hasMany(Subscription::class);
    // }
}
