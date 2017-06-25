<?php

namespace MH\MailBundle\Form\Post;

use MH\MailBundle\Form\Tool\LienType;
use MH\MailBundle\Form\Tool\TexteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlocTexteImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class)
            ->add('titre',LienType::class)
            ->add('texte',TexteType::class)
            ->add('couleurFond', EntityType::class, array(
                'class'        => 'MHMailBundle:Tool\Couleur',
                'choice_label' => 'nom',
                'multiple'     => false,
            ))
            ->add('image', EntityType::class, array(
                'class'        => 'MHMailBundle:Tool\Image',
                'choice_label' => 'nom',
                'multiple'     => false,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MH\MailBundle\Entity\Post\BlocTexteImage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mh_mailbundle_post_bloctexteimage';
    }


}
