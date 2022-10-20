<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

class PokeapiSyncCommand extends Command
{
    protected static $defaultName = 'pokeapi:sync';
    protected static $defaultDescription = 'Baixa a versão mais atual da lista de pokémons da PokeAPI.';

    private PokemonRepository $pokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository)
    {
        parent::__construct();
        $this->pokemonRepository = $pokemonRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $client = HttpClient::createForBaseUri('https://raw.githubusercontent.com/');
        $response = $client->request('GET', '/PokeAPI/pokeapi/master/data/v2/csv/pokemon.csv');

        if ($response->getStatusCode() !== 200) {
            $io->error("Não foi possível obter a lista de Pokémons. Código de resposta: {$response->getStatusCode()}.");
            return self::FAILURE;
        }

        $rawCsvLines = explode(PHP_EOL, $response->getContent());
        array_shift($rawCsvLines);
        array_pop($rawCsvLines);
        $csvEntries = array_map(fn (string $line) => str_getcsv($line, ','), $rawCsvLines);

        foreach ($csvEntries as [$id, $name]) {
            $this->upsertPokemon($id, $name);
        }

        return self::SUCCESS;
    }

    private function upsertPokemon(string $pokemonId, string $name): void
    {
        $pokemon = $this->pokemonRepository->find($pokemonId);

        if ($pokemon === null) {
            $pokemon = (new Pokemon())
                ->setId($pokemonId)
                ->setName($name);
        }

        $this->pokemonRepository->add($pokemon, true);
    }
}
