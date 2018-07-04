<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
        /**
	     * @Route("/login/check", name="login")
	     */
        public function loginAction()
 		{

         return $this->render('default/accueil.html.twig');
 		}
}
