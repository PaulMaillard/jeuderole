<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function displayMain(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/main.html.twig');
    }
    
    /**
     * @Route("/personnage/create", name="newCharacter")
     */
    public function newChar(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/newChar.html.twig');
    }
}
