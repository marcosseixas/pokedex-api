<?php

namespace App\Services;

use GuzzleHttp\Client;

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

    function pokemonsPrimeiraGeracao($detailedPokemons = []) {

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



}