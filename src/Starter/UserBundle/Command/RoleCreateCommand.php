<?php

namespace Starter\UserBundle\Command;

use Exception;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Starter\UserBundle\Entity\Role;

class RoleCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('starter:role:create')
            ->setDescription('Create a role')
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('role', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $role = new Role;
        $role->setName($input->getArgument('name'));
        $role->setRole($input->getArgument('role'));

        $entityManager->persist($role);
        $entityManager->flush();
    }


}