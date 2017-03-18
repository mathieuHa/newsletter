<?php

namespace MH\MailBundle\Form\Post;

use Symfony\Component\Form\AbstractType;
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
            ->add('jour1')->add('mois1')->add('lien1')->add('textlien1')->add('texte1')
            ->add('jour2')->add('mois2')->add('lien2')->add('textlien2')->add('texte2')
            ->add('jour3')->add('mois3')->add('lien3')->add('textlien3')->add('texte3')
            ->add('jour4')->add('mois4')->add('texte4')->add('textlien4')->add('lien4')
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
