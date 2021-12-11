<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $table = 'item_pedido';
    use HasFactory;
   
    protected $fillable = [
        'id_produto',
        'quantidade',
        'preco',
        'id_pedido',
    ];
}
