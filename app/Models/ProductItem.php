<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductItem extends Model
{
    use HasFactory;



    public function productItemFeatures(): HasMany
    {
        return $this->hasMany(ProductItemFeature::class);
    }
}
