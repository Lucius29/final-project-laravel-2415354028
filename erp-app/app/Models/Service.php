<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ["name", "price", "description", "status"];
    protected function casts(): array
    {
        return [
            "status" => "boolean",
            "price" => "integer"
        ];
    }

    // @return HasMany<Subcription, $this>

    // public function subcriptions(): HasMany
    // {
    //     return $this->hasMany(Subscription::class);
    // }
}
