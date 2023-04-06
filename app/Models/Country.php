<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * @package App\Models
 *
 * @property int    $id
 * @property String $code
 * @property String $name
 * @property int    $shipping_rate
 *
 * RELATIONS PROPERTIES
 *
 */
class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'shipping_rate',
    ];
}
