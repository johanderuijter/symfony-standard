<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('article', 'entity', array(
            'class' => 'AppBundle\Entity\Article',
            'property' => 'id',
            'choices' => $options['repository']->findAll(),
            'data' => 1,
        ));

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();

            $form->add('article', 'entity', array(
                'class' => 'AppBundle\Entity\Article',
                'property' => 'id',
                'choices' => $options['repository']->findAll(),
                'data' => 1,
            ));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));

        $resolver->setRequired(array(
            'repository',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'article';
    }
}
