<?php

namespace MH\MailBundle\Form\Post;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgendaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mois1')->add('jour1')->add('lien1')->add('textelien1')->add('texte1')->add('mois2')->add('jour2')->add('mois3')->add('mois4')->add('jour3')->add('jour4')->add('texte2')->add('texte3')->add('texte4')->add('textlien2')->add('textlien3')->add('textlien4')->add('lien2')->add('lien3')->add('lien4')        ;
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
