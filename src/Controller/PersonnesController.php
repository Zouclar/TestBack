<?php

namespace App\Controller;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonnesController extends AbstractController
{
    #[Route('/api/getAllPersonnesForCompany/{id}', name: 'app_personnes')]
    public function getAllPersonnesForCompany(Company $company, EntityManagerInterface $entityManager): Response
    {
        $personnes = $entityManager->getRepository(Company::class)->getAllPersonnesForCompany($company);
        
        return new Response(json_encode($personnes), 200);
    }
}
