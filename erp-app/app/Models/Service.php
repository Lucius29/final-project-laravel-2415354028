<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    /** 
     *@return HasMany<Subcription, $this>
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
