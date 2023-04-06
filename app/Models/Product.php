<?php

namespace App\Models;

use App\Http\Requests\ProductRequest;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasOne;



/**
 * Class Product
 * @package App\Models
 *
 * @property integer $id
 * @property string  $name
 * @property integer $barcode
 * @property integer $quantity_in_Stock
 * @property integer $weight
 * @property integer $price
 * @property integer $image
 *
 * RELATIONS PROPERTIES
 *
 * @property Category    $category
 *
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * Get category
     *
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
