<?php

declare(strict_types=1);

namespace App\Tests;

use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PokemonRepositoryTest extends KernelTestCase
{
    private PokemonRepository $pokemonRepository;

    protected function setUp(): void
    {
        self::bootKernel();
        $di = self::getContainer();

        $this->pokemonRepository = $di->get(PokemonRepository::class);
    }

    public function testGetTodaysPokemon(): void
    {
        $today = new \DateTimeImmutable('2022-10-21');
        $pokemon = $this->pokemonRepository->getPokemonByDate($today);

        self::assertEquals($pokemon->getId(), 193);
        self::assertEquals($pokemon->getName(), 'yanma');
    }
}
