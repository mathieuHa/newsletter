<?php
/**
 * Created by PhpStorm.
 * User: mat
 * Date: 26/03/2017
 * Time: 18:31
 */

namespace MH\MailBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MH\MailBundle\Entity\Tool\Couleur;
use MH\MailBundle\Entity\Tool\Image;
use MH\MailBundle\Form\Tool\CouleurType;


class LoadImageData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $listImage = [
            new Image(
               1,
               "http://oscar-campus.com/doc/1420/image/1-header/ESIEA-header.jpg",
               "img",
               "Esiea L'école d'ingénieur du monde numérique",
               "Header ESIEA 1"
           ),
            new Image(
                2,
                "https://gallery.mailchimp.com/16bae2ec1fa20c0cfb4cee035/images/90a6e78a-993a-4f82-9cec-c7671e98d6e4.jpg",
                "alt",
                "",
                "Header INTECH 1"
            )

         ];

        foreach ($listImage as $image){
            $manager->persist($image);
        }
        $manager->flush();
    }
}