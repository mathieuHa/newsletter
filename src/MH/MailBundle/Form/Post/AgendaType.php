<?php

namespace MH\MailBundle\Form\Post;

use MH\MailBundle\Form\Tool\LienQType;
use MH\MailBundle\Form\Tool\LienType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgendaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class)
            ->add('mois1',TextType::class)
            ->add('jour1',TextType::class)
            ->add('texte1',TextType::class)
            ->add('mois2',TextType::class)
            ->add('jour2',TextType::class)
            ->add('texte2',TextType::class)
            ->add('mois3',TextType::class)
            ->add('jour3',TextType::class)
            ->add('texte3',TextType::class)
            ->add('mois4',TextType::class)
            ->add('jour4',TextType::class)
            ->add('texte4',TextType::class)
            ->add('liens', CollectionType::class, array(
                'entry_type' => LienQType::class
            ))
            ->add('police', EntityType::class, array(
                'class'        => 'MHMailBundle:Tool\Police',
                'choice_label' => 'taille',
                'multiple'     => false,
            ))
            ->add('couleur', EntityType::class, array(
                'class'        => 'MHMailBundle:Tool\Couleur',
                'choice_label' => 'nom',
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
            'data_class' => 'MH\MailBundle\Entity\Post\Agenda'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mh_mailbundle_post_agenda';
    }


}
