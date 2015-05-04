<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ConfRepository
 *
 */
class ConfRepository extends EntityRepository
{
    /*
     * Get all configurations for an account
     */
    public function findAllByAccount($accountid)
    {
        return $this->createQueryBuilder('c')
                ->select('c')
                ->where('c.accountid = :accountid')
                ->setParameter('accountid', $accountid)
                ->getQuery()->getResult();
    }
    /*
     * Get configurations for an account by categoryname
     */
    public function findByAccountAndCategory($accountid, $category)
    {
        $parameters = array(
            'accountid' => $accountid,
            'category' => $category
        );
        return $this->createQueryBuilder('c')
                ->select('c')
                ->where('c.accountid = :accountid')
                ->andWhere('c.category = :category')
                ->setParameters($parameters)
                ->getQuery()->getResult();
    }
}
