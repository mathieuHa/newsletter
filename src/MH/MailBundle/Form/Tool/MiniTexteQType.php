<?php

namespace MH\MailBundle\Form\Tool;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MiniTexteQType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('couleur')
            ->remove('police')
        ;
    }

    public function getParent()
    {
        return MiniTexteType::class;
    }



}
