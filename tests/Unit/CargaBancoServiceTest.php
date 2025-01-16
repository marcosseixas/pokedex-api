<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CargaBancoService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;

class CargaBancoServiceTest extends TestCase
{

    /** 
     * @var Mockery 
    */
    protected $mockClient;

    /**
     * Teste da API dos pokemons de primeira geração
     */
    public function testPokemonsPrimeiraGeracao()
    {
        $mockClient = Mockery::mock(Client::class);

        $mockClient->shouldReceive('request')
                    ->with('GET', 'https://pokeapi.co/api/v2/pokemon', ['query' => ['offset' => 0, 'limit' => 151]])
                    ->once()
                    ->andReturn(new Response(200, [], json_encode([
                        'results' => [
                            ['name' => 'bulbasaur', 'url' => 'https://pokeapi.co/api/v2/pokemon/1/'],
                            ['name' => 'ivysaur', 'url' => 'https://pokeapi.co/api/v2/pokemon/2/'],
                        ],
                    ])));
        
        $mockClient->shouldReceive('request')
                    ->with('GET', 'https://pokeapi.co/api/v2/pokemon/1/')
                    ->once()
                    ->andReturn(new Response(200, [], json_encode([
                        'id' => 1,
                        'name' => 'bulbasaur',
                        'sprites' => ['front_default' => 'bulbasaur.png'],
                        'weight' => 69,
                        'height' => 7,
                    ])));

        $mockClient->shouldReceive('request')
                    ->with('GET', 'https://pokeapi.co/api/v2/pokemon/2/')
                    ->once()
                    ->andReturn(new Response(200, [], json_encode([
                        'id' => 2,
                        'name' => 'ivysaur',
                        'sprites' => ['front_default' => 'ivysaur.png'],
                        'weight' => 130,
                        'height' => 10,
                    ])));
        
        $service = new CargaBancoService($mockClient);

        $result = $service->getPokemonsPrimeiraGeracao();

        $expected = [
            [
                'id_pokedex' => 1,
                'nome' => 'bulbasaur',
                'imagem' => 'bulbasaur.png',
                'peso' => 69,
                'altura' => 7,
            ],
            [
                'id_pokedex' => 2,
                'nome' => 'ivysaur',
                'imagem' => 'ivysaur.png',
                'peso' => 130,
                'altura' => 10,
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
