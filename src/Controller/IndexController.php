<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private PokemonRepository $pokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        $pokemon = $this->pokemonRepository->getPokemonByDate(new DateTimeImmutable('today'));

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'pokemon_img' => "/images/pokemon/{$pokemon->getId()}.png",
        ]);
    }
}
