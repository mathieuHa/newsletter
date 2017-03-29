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
use MH\MailBundle\Entity\PostType;


class LoadTypeData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $listPostType = [
            new PostType(
                1,
                1,
                'Agenda Personnalisable',
                'Agenda',
                'agenda.JPG',
                'rendu d un agenda'
            ),
            new \MH\MailBundle\Entity\PostType(
                2,
                2,
                'Header, Footer, Img',
                'Header',
                'header.jpg',
                'Header emailling Esiea'
            ),
             new \MH\MailBundle\Entity\PostType(
                 3,
                 2,
                 'Footer Admission',
                 'Footer_admission',
                 'footer_admission.JPG',
                'Footer emailling Esiea'
            ),
            new \MH\MailBundle\Entity\PostType(
                7,
                2,
                'Contact Admission Esiea',
                'Contact_admission',
                'contact_admission.JPG',
                'Contact emailling Esiea'
            ),
             new \MH\MailBundle\Entity\PostType(
                 4,
                 2,
                 'Bloc Texte Couleur',
                 'texte_separation',
                 'texte_separation.JPG',
                 'Texte separation Esiea'
             ),
            new \MH\MailBundle\Entity\PostType(
                5,
                2,
                'Bloc de Couleur',
                'bloc',
                'bloc.JPG',
                'Bloc Couleur'
            ),
            new \MH\MailBundle\Entity\PostType(
                6,
                2,
                'Bloc Photo et Texte',
                'bloc_photo_texte',
                'bloc_photo_texte.JPG',
                'Bloc Photo Texte'
             ),
         ];

        foreach ($listPostType as $type){
            $manager->persist($type);
        }
        $manager->flush();
    }
}