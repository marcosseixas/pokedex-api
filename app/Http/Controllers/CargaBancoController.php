<?php

namespace App\Http\Controllers;

use App\Services\CargaBancoService as Service;

class CargaBancoController {


    /**
     * @var Service
     */
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Carga de dados pokemons primeira geração
     * 
     */
    public function getPokemonsPrimeiraGeracao() {

        try {

            $pokemons = $this->service->pokemonsPrimeiraGercao();

            return $pokemons;
            

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Pokémon data',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

}
