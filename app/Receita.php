<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    public $timestamps = false;
    protected $fillable = ['descricao', 'valor', 'data'];
}
