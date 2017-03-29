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
use MH\MailBundle\Form\Tool\CouleurType;


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
                "0086C7",
                "Bleu"
            ),
            new Couleur(
                4,
                "E7E8EA",
                "Gris"
            ),
            new Couleur(
                5,
                "FF0000",
                "Rouge"
            ),
            new Couleur(
                5,
                "FF6600",
                "Orange"
            ),
            new Couleur(
                5,
                "2EC4B6",
                "Turquoise"
            )


         ];

        foreach ($listCouleur as $couleur){
            $manager->persist($couleur);
        }
        $manager->flush();
    }
}