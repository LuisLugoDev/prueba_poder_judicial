<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facturas extends Model
{
    use HasFactory;
    
    protected $table = 'facturas';

    protected $fillable = [
        'user_id',
        'monto_total',
        'impuesto_total',
        'pagado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function compras()
    {
        return $this->hasMany(Compras::class,'factura_id','id');
    }

}
