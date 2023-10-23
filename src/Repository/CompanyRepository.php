<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 *
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

   public function getAllPersonnesForCompany(Company $company): array
   {
    return $this->createQueryBuilder('c')
        ->Join('c.personnes', 'p')
        ->where('p = :company')
        ->setParameter('company', $company->getId())
        ->getQuery()
        ->getResult();
   }
}
