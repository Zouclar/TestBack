<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class PersonnesController extends AbstractController
{
    #[Route('/api/getAllPersonnesForCompany/{id}', name: 'app_personnes')]
    public function getAllPersonnesForCompany(Company $company, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $companyRepo = $entityManager->getRepository(Company::class);
        $personnes = $companyRepo->getAllPersonnesForCompany($company);

        $jsonData = $serializer->serialize($personnes, 'json');

        $response = new JsonResponse($jsonData, JsonResponse::HTTP_OK, [], true);

        return $response;
    }
}
