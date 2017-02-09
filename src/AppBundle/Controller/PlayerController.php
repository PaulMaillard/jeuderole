<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PlayerController
 *
 * @author paul-maillard
 */
class PlayerController extends Controller{
    
    /**
     * Méthode qui va ajouter les joueurs en base de données, à la fin du traitement
     * on est redirigé sur le controlleur de vue afin de retourner la vue de
     * création de personnage
     * @Route("/players/add", name="addPlayers")
     * @param \Request $r
     */
    public function addPlayers(Request $r) {
        
        return $this->redirectToRoute('newCharacter');
//        //m'a permis de vérifier les valeurs du formulaire
//        return new Response($r->get('j1'));
    }
}
