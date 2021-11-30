<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    protected $table = 'produto';
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'tamanho',
        'cor',
        'valor',
        'id_fornecedor',
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
