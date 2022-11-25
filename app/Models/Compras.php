<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    use HasFactory;
    
    protected $table = 'compras';

    protected $fillable = [
        'user_id',
        'producto_id',
        'monto',
        'impuesto',
        'facturado',
        'factura_id',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class,'id','producto_id');
    }
}
