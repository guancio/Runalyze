<?php

namespace Runalyze\CoreBundle\Form\Model;
use Symfony\Component\Validator\Constraints as Assert;

use Runalyze\CoreBundle\Entity\Account;

class Registration
{
    /**
     * @Assert\Type(type="Runalyze\Core\Entity\Account")
     * @Assert\Valid()
     */
    protected $account;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;

    public function setAccount(Account $account)
    {
        $this->account = $account;
    }

    public function getAccount()
    {
        return $this->account;
    }

    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }
}
