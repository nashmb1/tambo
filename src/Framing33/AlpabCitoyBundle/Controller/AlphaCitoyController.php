<?php

namespace Framing33\AlpabCitoyBundle\Controller;

use Framing33\AlpabCitoyBundle\Entity\EtudiantAlphabetisation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Framing33\AlpabCitoyBundle\Form\EtudiantAlphabetisationType;

class AlphaCitoyController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Framing33AlpabCitoyBundle:Alph:index.html.twig');
    }
    public function inscriptionAction(Request $request){
        $etudiant = new EtudiantAlphabetisation();

        $form = $this->createForm(new EtudiantAlphabetisationType(),$etudiant);

        if ($form->handleRequest ( $request )->isValid ()) {
            // On l'enregistre notre objet $advert dans la base de données
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

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

        return $this->render('Framing33AlpabCitoyBundle:Alph:inscription.html.twig',array(
            'form' => $form->createView(),
        ));
    }
}
