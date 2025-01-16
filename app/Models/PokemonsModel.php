<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonsModel extends Model
{

    protected $table = 'pokemons';

    protected $fillable = [
        'id_pokedex',
        'nome', 
        'imagem',
        'tipo', 
        'altura', 
        'peso'
    ];

}
