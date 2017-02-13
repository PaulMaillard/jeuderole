<?php

namespace AppBundle\Controller;

use AppBundle\Form\PersonnageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function displayMain(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/main.html.twig');
    }

    /**
     * @Route("/personnage/create", name="newCharacter")
     */
    public function newChar(Request $request) {
        $form = $this->createForm(PersonnageType::class);
        $numeroDuJoueur = $request->getSession()->get('actuel');
        $numeroDuJoueurEnChaineDeCaractere = strval($numeroDuJoueur);
        $joueur = $request->getSession()->get("j" . $numeroDuJoueurEnChaineDeCaractere);
        // replace this example code with whatever you need
        return $this->render('default/newChar.html.twig', array(
                    "j" => $joueur,
                    "joueur" => $request->getSession()->get("j" . strval($request->getSession()->get('actuel'))),
                    "formulaire" => $form->createView()
        ));
    }

    /**
     * @Route("/game", name="game")
     */
    public function getGameUI(Request $r) {
        
        return $this->render('default/game_ui.twig', array(
            "joueur" => $r->getSession()->get("j" . strval($r->getSession()->get('actuel')))
        ));
    }

}
