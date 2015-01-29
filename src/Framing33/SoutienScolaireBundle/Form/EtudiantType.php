<?php

namespace Framing33\SoutienScolaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EtudiantType extends AbstractType
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
            ->add('adresse','text')
            ->add('tel','text')
            ->add('mail','email')
            ->add('classe','choice',array(
                'choices' => array('CI'=>'CI', 'CP'=>'CP', 'CE1'=>'CE1','CE2'=>'CE2',
                    'CM1'=>'CM1','CM2'=>'CM2','6EME'=>'6EME','5EME'=>'5EME','4EME'=>'4EME','3EME'=>'3EME','2ND'=>'2ND','1ERE'=>'1ERE','TERMINALE'=>'TERMINALE')))
            ->add('save','submit')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Framing33\SoutienScolaireBundle\Entity\Etudiant'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'framing33_soutienscolairebundle_etudiant';
    }
}
