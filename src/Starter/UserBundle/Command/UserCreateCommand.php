<?php

namespace Starter\UserBundle\Command;

use Exception;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Starter\UserBundle\Entity\Role;
use Starter\UserBundle\Entity\User;

class UserCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('starter:user:create')
            ->setDescription('Create an user')
            ->addArgument('username', InputArgument::REQUIRED)
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            ->addArgument('role', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user           = new User;
        $encoder        = $this->getContainer()->get('starter_user.encoder');
        $entityManager  = $this->getContainer()->get('doctrine.orm.entity_manager');

        $passwordHash = $encoder
            ->encodePassword($input->getArgument('password'), $user->getSalt());

        $role = $entityManager
            ->getRepository('StarterUserBundle:Role')
            ->findOneByRole($input->getArgument('role'));

        $user->setUsername($input->getArgument('username'));
        $user->setEmail($input->getArgument('email'));
        $user->setPassword($passwordHash);
        $user->addRole($role);
        $user->setChangepassword(false);

        $entityManager->persist($user);
        $entityManager->flush();
    }


}