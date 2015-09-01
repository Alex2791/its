<?php

namespace App\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class PageController extends Controller
{
    public function indexAction()
    {
        $fac = new \Factual("grmdbAPOg2AXOdvYVPnRRzoOIRfUNjEmi4TplyLN","QgT0GhdafbnyCDIhIFPq7kf54M2sglg7q1MypA4j");
        $query = new \FactualQuery();
       // $query->field("BMW");
        //$query->limit(4);
       // $res = $fac ->fetch("places",$query);*/
      /* $query->search("Miko");
        $res = $fac->fetch("places", $query);
        dump($res->getData());*/
        //$phpExcelObject = $this->get('phpexcel')->createPHPExcelObject('file.xls');

        return $this->render('AppFrontEndBundle:Page:index.html.twig');
    }

    //письмо
    public function sendAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody("Hello" )

        ;
        $this->get('mailer')->send($message);
        return $this->render('AppFrontEndBundle:Page:index.html.twig');
    }

    //пагинация
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

    //хлебные кошки
    public function breadAction()
    {
        $router = $this->get('router');
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Главная', $router->generate('app_front_end_wellcome'));
        $breadcrumbs->addItem('Хлеб');
        return $this->render('AppFrontEndBundle:Page:bread.html.twig');

    }

    //мультиязычность
    public function multiAction(Request $request)
    {

       /*$request->setLocale("ru");
        $session = $request->getSession();

        $session->set('_locale', $request->getLocale());
        $t =  $this->get('translator');
        dump($t);
        $m = $request->getLocale();
        dump($m);*/
      // return new Response($t);
       return $this->render('AppFrontEndBundle:Page:multi.html.twig');
    }


    //потестить
    public   function testAction(Request $request)
    {

        $t = $request->get("service");
        /*$this->getDoctrine()->getRepository("");
        dump($t);*/
       // return $this->redirectToRoute("app_front_end_wellcome");
    }


    public function autocompliteAction(Request $request)
    {
        return $this->render('AppFrontEndBundle:Page:autocomplite.html.twig');
    }



}
