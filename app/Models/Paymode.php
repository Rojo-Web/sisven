<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymode extends Model
{
    use HasFactory;
    protected $table = 'pay_mode'; //indicamos la tabla de referencia
    protected $primaryKey = 'id'; //indicamos la columna de la llave primaria
    public $timestamps = true; //quitar columnas de fecha y registro created_at y updated_at.
}
