<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController {

/** 
*@Route("/login" , name="login")
*/

 public function login(AuthenticationUtils $auth) {

    $error =  $auth->getLastAuthenticationError();
    $lastUserName = $auth->getLastUserName();
    return $this->render('Security/login.html.twig' , [
        'last_username' => $lastUserName,
        'error' => $error
    ]);
 }

 
}