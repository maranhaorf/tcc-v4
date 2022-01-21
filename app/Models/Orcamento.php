<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $table = 'solicitacao_orcamento';
    use HasFactory;
   
    protected $fillable = [
        'nome_cliente',
        'cpf_cliente',
        'telefone_cliente',
        'email_cliente',
        'status',
       
    ];
}
