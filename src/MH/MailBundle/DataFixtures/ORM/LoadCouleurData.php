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


class LoadCouleurData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $listCouleur = [
            new Couleur(
                1,
                "000000",
                "Noir"
            ),
            new Couleur(
                2,
                "ffffff",
                "Blanc"
            ),
            new Couleur(
                3,
                "0x2424",
                "Bleu"
            )
         ];

        foreach ($listCouleur as $couleur){
            $manager->persist($couleur);
        }
        $manager->flush();
    }
}