<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PlayerController
 *
 * @author paul-maillard
 */
class PlayerController extends Controller {

    /**
     * Méthode qui va ajouter les joueurs en base de données, à la fin du traitement
     * on est redirigé sur le controlleur de vue afin de retourner la vue de
     * création de personnage
     * Si le joueur existe en base de données, on le met en session, sinon on
     * l'enregistre et on le met en session
     * 
     * @Route("/players/add", name="addPlayers")
     * @Method({"POST"})
     * @param \Request $r
     */
    public function addPlayers(Request $r) {
        $em = $this->getDoctrine()->getManager();
        //boucle sur les valeurs de 1 à 4
        for ($i = 1; $i <= 4; $i++) {
            //stockage de la valeur dans la variable email
            $email = $r->get('j' . strval($i));
            //créer un joueur en DB et le mettre en session
            if ($email != null) {
                $playerList = $em->getRepository(Joueur::class)->findByEmail($email);
                if ($playerList != null) {
                    //si joueur déjà existant
                    $r->getSession()->set('j' . strval($i), $playerList[0]);
                } else {
                    //si nouveau joueur
                    $joueur = new Joueur();
                    $joueur->setEmail($email);
                    $em->persist($joueur);
                    //mise en session du joueur
                    $r->getSession()->set('j' . strval($i), $joueur);
                }
            }
        }
        $em->flush();
        return $this->redirectToRoute('newCharacter');
//        //m'a permis de vérifier les valeurs du formulaire
//        return new Response($r->get('j1'));
    }

}
