<?php

namespace App\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;


class AjaxController extends Controller
{

    private $defaultLocale;

    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function indexAction(Request $request)
    {
        $locale = $request->getLocale();
       // $newLocal = $request->get('loc');
        $newLocal = $request->get('lang');
       // dump($newLocal);
        if(!$newLocal){
            return new JsonResponse(['change'=> false ]);
        }
        if(!in_array($newLocal, ['en' , 'ru'])){
            return new JsonResponse(['change'=> false ]);
        }
        if($locale == $newLocal){
            return new JsonResponse(['change'=> false ]);
        }

        $session = $request->getSession();

        $request->setLocale($newLocal);
       // $request->setLocale('en');
      // dump($request->getLocale());
        $session->set('_locale', $newLocal);
        return new JsonResponse(['change'=> true ]);
    }







}
