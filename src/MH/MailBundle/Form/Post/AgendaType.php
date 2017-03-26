<?php

namespace MH\MailBundle\Form\Post;

use MH\MailBundle\Form\Tool\LienType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('mois1')
            ->add('jour1')
            ->add('texte1')
            ->add('mois2')
            ->add('jour2')
            ->add('texte2')
            ->add('mois3')
            ->add('jour3')
            ->add('texte3')
            ->add('mois4')
            ->add('jour4')
            ->add('texte4')
            ->add('liens', CollectionType::class, array(
                'entry_type' => LienType::class
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
            ->add('save',SubmitType::class)
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
