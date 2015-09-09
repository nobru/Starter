<?php

namespace Starter\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;


class LoginController extends Controller
{
    /**
     * @Template()
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $error = false;

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        if ($error) {
            $this->addFlash('error', $error->getMessage());
        }

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME)
        );
    }

    /**
     * @Template()
     */
    public function changepasswordAction()
    {
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $user           = $this->getUser();
            $oldPassword    = $request->request->get('oldpassword');
            $newPassword    = $request->request->get('password');
            $repPassword    = $request->request->get('newpassword');
            $encoder        = $this->get('starter_user.encoder');
            $passwordHash   = $encoder->encodePassword(
                $oldPassword,
                $user->getSalt()
            );

            $errors = [];

            if ($passwordHash != $user->getPassword()) {
                $errors[] = 'The old password does not match.';
            }

            if ($newPassword != $repPassword) {
                $errors[] = 'The password and the password repetition does not match.';
            }

            if (strlen($newPassword) < 6) {
                $errors[] = 'The password must have at least 6 carachters.';
            }

            if ($oldPassword == $newPassword) {
                $errors[] = 'The new password and the old password cannot be the same.';
            }

            if (count($errors) == 0) {
                $newPasswordHash = $encoder->encodePassword(
                    $newPassword,
                    $user->getSalt()
                );

                $user->setPassword($newPasswordHash);
                $user->setChangepassword(false);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('redirect');
            }

            foreach ($errors as $error) {
                $this->addFlash('error', $error);
            }

        }

        return [];
    }
}
