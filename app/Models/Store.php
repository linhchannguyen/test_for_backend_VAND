<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'store_name',
        'store_address',
        'user_id',
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

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($store) { // before delete() method call this
             $store->products()->delete();
        });
    }
}
