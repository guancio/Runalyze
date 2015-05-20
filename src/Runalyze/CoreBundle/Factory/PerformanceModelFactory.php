<?php

namespace Runalyze\CoreBundle\Factory;

use Runalyze\CoreBundle\Entity\Account;
use Runalyze\Calculation\Performance\ModelQuery;

class PerformanceModelFactory
{
    private $account;
    private $mq;

public function __construct(Account $account = null, ModelQuery $ModelQuery)
    {
        $this->account = $account;
        $this->mq = $ModelQuery;
    }

    public function get()
    {
        //$PMF = null;
        dump($this->mq);
        if ($this->account) {
            $this->mq->setAccountid($this->account->getId());
        }
        return $this->mq;
    }
}