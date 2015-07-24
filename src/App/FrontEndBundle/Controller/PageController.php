<?php

namespace App\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppFrontEndBundle:Page:index.html.twig');
    }

    public function sendAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody("Hello" )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $this->get('mailer')->send($message);
        return $this->render('AppFrontEndBundle:Page:index.html.twig');
    }

    public function paginAction(Request $request)
    {
       // $em    = $this->get('doctrine.orm.entity_manager');

        //$query = $em->createQuery($dql);BundlesStoreBundle:ProdtoOrder
        $em = $this->getDoctrine()->getManager();

        $repo =$em->getRepository("BundlesStoreBundle:Page");
        $query =$repo->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );

        // parameters to template
      //  return $this->render('AcmeMainBundle:Article:list.html.twig', array('pagination' => $pagination));
        return $this->render('AppFrontEndBundle:Page:page.html.twig', array('pagination' => $pagination));
    }


    public function breadAction()
    {
        $router = $this->get('router');
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Главная', $router->generate('app_front_end_wellcome'));
        $breadcrumbs->addItem('Хлеб');
        return $this->render('AppFrontEndBundle:Page:bread.html.twig');

    }

}
