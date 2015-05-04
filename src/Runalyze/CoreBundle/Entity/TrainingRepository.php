<?php
namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TrainingRepository extends EntityRepository
{
    /*
     * Get all activities for an account
     */
    public function findAllByAccount($accountid)
    {
        return $this->createQueryBuilder('t')
                ->select('t')
                ->where('t.accountid = :accountid')
                ->setParameter('accountid', $accountid)
                ->getQuery()->getResult();
    }
    
    /*
     * Get all activities data between a given time range for an account
     */
    public function findByTimeRangeForAccount($starttime, $endtime, $accountid)
    {
        $parameters = array(
            'accountid' => $accountid,
            'starttime' => $starttime,
            'endtime' => $endtime
        );
        return $this->createQueryBuilder('t')
                ->select('t')
                ->where('t.accountid = :accountid')
                ->andWhere('t.time >= :starttime')
                ->andWhere('t.time <= :endtime')
                ->setParameters($parameters)
                ->getQuery()->getResult();
    }
}
