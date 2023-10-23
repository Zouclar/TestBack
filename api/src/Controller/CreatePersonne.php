<?php
namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class CreatePersonne extends AbstractController
{
    public function __construct(
        private Personne $personne
    ) {}
    public function __invoke(Personne $personne): Personne
    {
        return $personne;
    }
}