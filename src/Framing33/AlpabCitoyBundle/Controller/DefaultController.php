<?php

namespace Framing33\AlpabCitoyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Framing33AlpabCitoyBundle:Default:index.html.twig', array('name' => $name));
    }
}
