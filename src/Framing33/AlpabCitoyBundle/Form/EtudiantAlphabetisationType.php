<?php

namespace Framing33\AlpabCitoyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EtudiantAlphabetisationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text')
            ->add('prenom','text')
            ->add('mail','email')
            ->add('adresse','text')
            ->add('tel','text')
            ->add('langues','entity',array(
                'class'=>'Framing33AlpabCitoyBundle:Langue',
                'property'=>'name',
                'multiple'=>true
         ))
            ->add('Enregistrer','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Framing33\AlpabCitoyBundle\Entity\EtudiantAlphabetisation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'framing33_alpabcitoybundle_etudiantalphabetisation';
    }
}
