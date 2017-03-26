<?php

namespace MH\MailBundle\Form\Tool;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MiniTexteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte',TextType::class)
            ->add('couleur', EntityType::class, array(
                'class'        => 'MHMailBundle:Tool\Couleur',
                'choice_label' => 'nom',
                'multiple'     => false,
            ))
            ->add('police', EntityType::class, array(
                'class'        => 'MHMailBundle:Tool\Police',
                'choice_label' => 'taille',
                'multiple'     => false,
            ))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MH\MailBundle\Entity\Tool\MiniTexte'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mh_mailbundle_tool_minitexte';
    }


}
