<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoque';
    use HasFactory;
   
    protected $fillable = [
        'id_produto',
        'id_usuario',
        'quantidade',
        'estoque_minimo'

    ];

    protected $dates = ['deleted_at'];
}