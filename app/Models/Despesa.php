<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    public $timestamps = false;
    protected $fillable = ['descricao', 'valor', 'data'];
}
