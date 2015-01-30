<?php

namespace Framing33\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Framing33\HomeBundle\Entity\Contact;
use Framing33\HomeBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('Framing33HomeBundle:Home:index.html.twig');
    }

    public function contactAction(Request $request){

        $contact = new Contact();
        $form = $this->createForm(new ContactType(),$contact);

        if($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $request->getSession()->getFlashBag ()->add ( 'notice','Votre demande a été prise en charge' );

            return $this->render('Framing33HomeBundle:Home:contact.html.twig',array(
                'form' => $form->createView()
            ));

        }

        return $this->render('Framing33HomeBundle:Home:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
