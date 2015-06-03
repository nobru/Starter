<?php

namespace Starter\UserBundle\EventListener;

use Starter\UserBundle\Controller\AccountAccessInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class AccountAccessListener
{
    public function __construct()
    {
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof AccountAccessInterface) {
            $accountName = $event->getRequest()->attributes->get('accountName');
            $accounts = $controller[0]->getUser()->getAccounts();
            $hasAccount = false;
            foreach ($accounts as $account) {
                if ($account->getName() == $accountName) {
                    $hasAccount = true;
                    break;
                }
            }

            if (!$hasAccount) {
                throw new AccessDeniedHttpException('Access denied.');
            }

            $event->getRequest()->attributes->set('accountTitle', $account->getTitle());

            $router = $controller[0]->get('router');
            $routeCollection = $router->getRouteCollection();

            foreach ($routeCollection as $route) {
                $route->setDefault('accountName', $accountName);
            }
        }
    }
}