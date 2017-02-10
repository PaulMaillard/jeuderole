<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use AppBundle\Entity\Personnage;
use AppBundle\Form\PersonnageType;
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
                    $joueur = $playerList[0];
                } else {
                    //si nouveau joueur
                    $joueur = new Joueur();
                    $joueur->setEmail($email);
                    $em->persist($joueur);
                }
                //mise en session du joueur
                $r->getSession()->set('j' . strval($i), $joueur);
            }
        }
        $em->flush();
        $r->getSession()->set('actuel', 1);
        return $this->redirectToRoute('newCharacter');
    }

    /**
     * @Route("/perso/create", name="saveCharacter")
     * @param Request $r
     */
    public function savePersonnage(Request $r) {
        $em = $this->getDoctrine()->getManager();
        $personnage = new Personnage();
        $form = $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($r);
        $em->persist($personnage->majStats());
        $em->persist($personnage);
        $joueur = $r->getSession()->get('j' . strval($r->getSession()->get('actuel')));
        $joueur->setPersonnage($personnage);
        $em->merge($joueur);
        $em->flush();
        return $this->redirectToRoute("switch");
    }

    /**
     * Doit être apppelé par la validation de la création du personnage précédent
     * @param Request $r
     * @return type
     * @Route ("/perso/switch", name="switch")
     */
    public function switchPlayer(Request $r) {
        $next = $r->getSession()->get('actuel') + 1;
        if ($r->getSession()->has('j' . strval($next))) {
            $r->getSession()->set('actuel', $next);
            return $this->redirectToRoute('newCharacter');
        } else {
            return $this->redirectToRoute('game');
        }
    }

}
