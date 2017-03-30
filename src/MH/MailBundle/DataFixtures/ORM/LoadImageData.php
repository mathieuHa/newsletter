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
            ),
            new Image(
                3,
                "https://gallery.mailchimp.com/16bae2ec1fa20c0cfb4cee035/images/33cdb192-25eb-4a22-a86c-bf68fbbfa4f5.jpg",
                "alt",
                "",
                "Footer Logo CTI, Concours Alpha, CGE, SECNemDu"
            ),
            new Image(
                4,
                "http://oscar-campus.com/doc/1420/image/newsletter%20mars/international.jpg",
                "alt",
                "",
                "Image réalité virtuelle"
            ),
            new Image(
                5,
                "http://oscar-campus.com/doc/1420/image/newsletter%20mars/skema.png",
                "alt",
                "",
                "Logo Skema"
            ),
            new Image(
                6,
                "http://oscar-campus.com/doc/1420/image/newsletter%20mars/femme%20numerique.jpg",
                "alt",
                "",
                "Femme du numérique"
            ),
            new Image(
                7,
                "https://gallery.mailchimp.com/16bae2ec1fa20c0cfb4cee035/images/fa0551d8-5c8e-4749-adc7-6396679301b4.jpg",
                "alt",
                "",
                "Projet IN'TECH"
            ),
            new Image(
                8,
                "https://gallery.mailchimp.com/16bae2ec1fa20c0cfb4cee035/images/ecd9f024-7aa4-4529-bcbb-a21156b360ec.jpg",
                "alt",
                "",
                "DEFNET 2017"
            ),
            new Image(
                9,
                "https://gallery.mailchimp.com/16bae2ec1fa20c0cfb4cee035/images/92922950-1169-4d10-90ac-1d3457d60af1.jpg",
                "alt",
                "",
                "Decouvrez IN'TECH en video"
            )

         ];

        foreach ($listImage as $image){
            $manager->persist($image);
        }
        $manager->flush();
    }
}