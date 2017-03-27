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
use MH\MailBundle\Entity\Tool\Police;


class LoadPoliceData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $listPolice = [
            new Police(
                1,
                10
            ),
            new Police(
                2,
                12
            ),
            new Police(
                3,
                14
            )
         ];

        foreach ($listPolice as $Police){
            $manager->persist($Police);
        }
        $manager->flush();
    }
}