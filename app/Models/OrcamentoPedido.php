<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentoPedido extends Model
{
    protected $table = 'orcamento_pedido';
    use HasFactory;

    protected $fillable = [
        'id_produto',
        'quantidade',
        'preco',
        'id_orcamento',
    ];
}
