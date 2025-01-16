<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\PokemonsModel;

class CargaBancoService {

    /**
     * @var Client
     */
    protected $client;

    const API_POKEMON = 'https://pokeapi.co/api/v2/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Pega na API da pokedex somente os pokemons da primeira geração com info de peso e imagem
     * 
     * @return Array
     * 
     */
    function getPokemonsPrimeiraGeracao($detailedPokemons = []) {

        $response = $this->client->request('GET', self::API_POKEMON . 'pokemon', [
            'query' => [
                'offset' => 0,
                'limit' => 151,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $pokemons = $data['results'] ?? [];
        
        if (!empty($pokemons)) {

            foreach ($pokemons as $pokemon) {
                $pokemonsInfos = $this->client->request('GET', $pokemon['url']);
                $details = json_decode($pokemonsInfos->getBody(), true);

                $detailedPokemons[] = [
                    'id_pokedex' => $details['id'],
                    'nome' => $details['name'],
                    'imagem' => $details['sprites']['front_default'],
                    'peso' => $details['weight'],
                    'altura' => $details['height'],
                ];
            }

            return $detailedPokemons;
        }

        return [];

    }

    public function saveDBPokedex($pokemons) {

        foreach($pokemons as $pokemon) {

            PokemonsModel::updateOrCreate(
                ['id_pokedex' => $pokemon['id_pokedex']],
                [
                    'nome' => $pokemon['nome'],
                    'imagem' => $pokemon['imagem'],
                    'peso' => $pokemon['peso'],
                    'altura' => $pokemon['altura'],
                ]
            );
        }
        
        return true;

    }


}