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

            $pokemons = $this->service->getPokemonsPrimeiraGeracao();
            $saveDBPokedex = $this->service->saveDBPokedex($pokemons);
            if($saveDBPokedex) {
                return response()->json("Tabela atualizada com sucesso", 201);
            }
            
            return response()->json("O caminhão de pokemons tombou, por favor tente mais tarde. =(", 404);
            

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Pokémon data',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

}
