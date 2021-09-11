<?php

namespace App\Repository;

use App\Entity\Passenger;
use App\Model\PassengerModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Passenger|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passenger|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passenger[]    findAll()
 * @method Passenger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassengerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Passenger::class);
    }

    // /**
    //  * @return Passenger[] Returns an array of Passenger objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Passenger
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function save(PassengerModel $passengerModel)
    {
        $passenger = new Passenger();

        $passenger->setFirstName($passengerModel->firstName)
            ->setMiddleName($passengerModel->middleName)
            ->setLastName($passengerModel->lastName)
            ->setAge($passengerModel->age)
            ->setGender($passengerModel->gender);

        $this->getEntityManager()->persist($passenger);
        $this->getEntityManager()->flush();

        return $passenger;
    }
}
