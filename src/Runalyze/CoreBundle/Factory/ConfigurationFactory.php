<?php

namespace Runalyze\CoreBundle\Factory;

use Runalyze\CoreBundle\Entity\Account;
use Runalyze\CoreBundle\Service\Configuration;


class ConfigurationFactory
{
    private $account;
    private $configuration;

public function __construct(Account $account = null, Configuration $configuration)
    {
        $this->account = $account;
        $this->configuration = $configuration;
    }

    public function get()
    {
        $ConfigurationInstance = null;
        if ($this->account) {
            $this->configuration->setAccountid($this->account->getId());
            $ConfigurationInstance = $this->configuration;
        }
        return $ConfigurationInstance;
    }
}