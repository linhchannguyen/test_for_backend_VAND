<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'product_name',
        'product_short_name',
        'sku',
        'price',
        'quantity',
        'product_description',
        'product_del_flg',
        'store_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Set the fillable attributes for the model.
     *
     * @param  array  $fillable
     * @return $this
     */
    public function fillable(array $fillable)
    {
        $this->fillable = $fillable;

        return $this;
    }

    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
