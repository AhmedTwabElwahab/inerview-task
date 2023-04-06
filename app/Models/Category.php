<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * Class Category
 * @package App\Models
 *
 * @property int    $id
 * @property String $name
 *
 * RELATIONS PROPERTIES
 * @property Product[] $products
 *
 * @method static paginate($APP_PAGINATE)
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded =[];

    /**
     * Get all Product ander Category
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
}
