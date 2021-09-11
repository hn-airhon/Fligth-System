<?php

namespace App\Repository;

use App\Entity\Destination;
use App\Entity\Flight;
use App\Entity\Terminal;
use App\Model\FlightModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Flight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flight[]    findAll()
 * @method Flight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    // /**
    //  * @return Flight[] Returns an array of Flight objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Flight
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function save(FlightModel $flightModel)
    {
        $destination = $this->_em->getRepository(Destination::class)->find($flightModel->destinationId);
        $terminal = $this->_em->getRepository(Terminal::class)->find($flightModel->terminalId);

        $flight = new Flight();

        $flight->setDestination($destination)
            ->setTerminal($terminal)
            ->setCapacity($flightModel->capacity);

        $this->_em->persist($flight);
        $this->_em->flush();

        return $flight;
    }
}
