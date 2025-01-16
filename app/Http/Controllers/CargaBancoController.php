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

            if(!empty($pokemons)) {
                return response()->json($pokemons, 200);

            }
            
            return response()->json("Nenhum pokemon encontrado =(", 404);
            

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Pokémon data',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

}
