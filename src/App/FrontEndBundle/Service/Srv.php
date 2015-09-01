<?php
namespace App\FrontEndBundle\Service;
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.06.15
 * Time: 8:43
 */
use Bundles\StoreBundle\Entity\Image;

class Srv
{

    public function __construct($container)
    {
        $this->container = $container;
    }



    public function changetab()
    {
        $em = $this->container->get('doctrine')->getManager();
        $image = new Image();
        $str=time();
        //$image->setLocation($str);
        $image->setFilename($str);
        $em->persist($image);
        $em->flush();
        return "ok";
    }


}