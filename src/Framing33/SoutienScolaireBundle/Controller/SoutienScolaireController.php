<?php

namespace Framing33\SoutienScolaireBundle\Controller;


use Framing33\SoutienScolaireBundle\Entity\Etudiant;
use Framing33\SoutienScolaireBundle\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SoutienScolaireController extends Controller{

    public function indexAction(){

        return $this->render('Framing33SoutienScolaireBundle:SoutienScolaire:index.html.twig');

    }
    public function inscriptionAction(Request $request){

        $etudiant = new Etudiant();

        $form = $this->createForm(new EtudiantType(),$etudiant);

        if ($form->handleRequest ( $request )->isValid ()) {
            // On l'enregistre notre objet $advert dans la base de données
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

            //envoie du mail de confirmation
            $message = \Swift_Message::newInstance()
                ->setSubject('Confirmation de demande d\'inscription')
                ->setFrom('framing33.test@gmail.com')
                ->setTo($etudiant->getMail())
                ->setBody('Bonjour '.$etudiant->getNom().' '.$etudiant->getPrenom().',<br><br>Nous vous confirmons la
                 prise en compte de votre demande d\'inscription.Un mail de confirmation vous sera envoyé dès la validation de votre inscription.<br><br>Bien cordialement<br>L\'équipe de Framing33','text/html')
            ;
            $this->get('mailer')->send($message);

            // On redirige vers la page de confirmation
            return $this->render('Framing33SoutienScolaireBundle:SoutienScolaire:confirmation.html.twig' );
        }

        return $this->render('Framing33SoutienScolaireBundle:SoutienScolaire:inscription.html.twig',array(
            'form' => $form->createView(),
        ));

    }
}