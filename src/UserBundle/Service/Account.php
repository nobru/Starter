<?php

namespace Starter\UserBundle\Service;

use Doctrine\ORM\EntityManager;
use Starter\UserBundle\Entity\Account as EntityAccount;
use Starter\UserBundle\Entity\User;
use Starter\UserBundle\Service\Encoder;
use Starter\BillingBundle\Service\Billing;
use InvalidArgumentException;

class Account
{
    private $em;
    private $encoder;
    private $billing;

    public function __construct(EntityManager $em, Encoder $encoder, Billing $billing)
    {
        $this->em       = $em;
        $this->encoder  = $encoder;
        $this->billing  = $billing;

    }

    public function create($name, $email, $password)
    {
        $find = $this
            ->getEntityManager()
            ->getRepository('StarterUserBundle:User')
            ->findOneBy(array('email' => $email));

        if ($find) {
            throw new InvalidArgumentException('Someone already registered with that e-mail.');
        }

        $account = $this->createAccount();
        $user = $this->createUser($account, $name, $email, $password);

        $this->changeAccountStatus($account, 1);

        $billing = $this->getBillingService()->create($account);

        return $user;
    }

    public function createAccount()
    {
        $account = new EntityAccount;
        $account->setStart(new \DateTime());
        $account->setIsActive(0);

        $em = $this->getEntityManager();
        $em->persist($account);
        $em->flush();

        return $account;
    }

    public function createUser(EntityAccount $account, $name, $email, $password)
    {
        $user = new User;
        $user->setAccount($account);
        $user->setName($name);
        $user->setEmail($email);
        $user->setUsername($email);

        $encoder = $this->encoder;
        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));

        $userRole = $this->em->getRepository('StarterUserBundle:Role')->findOneByRole('ROLE_CUSTOMER');
        $user->addRole($userRole);

        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();

        return $user;
    }

    public function changeAccountStatus(EntityAccount $account, $status = 0)
    {
        $status = $status != 0;
        $account->setOwner($user);
        $account->setIsActive($status);

        $em = $this->getEntityManager();
        $em->persist($account);
        $em->flush();
    }

    private function getEntityManager()
    {
        return $this->em;
    }

    private function getBillingService()
    {
        return $this->billing;
    }
}
