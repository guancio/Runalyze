<?php
namespace Runalyze\CoreBundle\Factory;

use Runalyze\CoreBundle\Entity\Account;

class CompanyFactory
{
    private $user;

    public function __construct(account $user = null)
    {
        $this->user = $user;
    }

    public function get()
    {
        $company = null;

        if ($this->user) {
            $company = $this->user->getID();
        }

        return $company;
    }
}