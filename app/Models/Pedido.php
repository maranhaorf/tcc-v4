<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';
    use HasFactory;
   
    protected $fillable = [
        'nome_cliente',
        'cpf_cliente',
        'telefone_cliente',
        'status',
        'id_usuario',
    ];
}
