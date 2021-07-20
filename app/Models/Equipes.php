<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipes extends Model
{
    use HasFactory;

    protected $table='equipes';
    
    protected $fillable = [
        'aux', 'equipe', 'usuario', 'ativo', 'empresa'
    ];

    public $rules= [ 'aux'=>'max:10',
     'equipe'=>'required|max:255|unique', 
     'usuario'=>'required', 
     'ativo'=>'required', 
     'empresa'=>'required'
    ];
}
