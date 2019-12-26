<?php

namespace ES\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('imageFile', VichImageType::class, [
                'required' => false
            ])
            ->add('extrait')
            ->add('contenu', CKEditorType::class, [
                'config' => array(
                    'uiColor' => '#ffffff',
                    //...
                ),
            ])
            ->add('isEnable')
            ->add('category', EntityType::class, array(
                'class' => 'ESAdminBundle:Category',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.isActive = :true')
                        ->orderBy('c.nomFr', 'ASC')
                        ->setParameter('true', true)
                        ;
                },
                'choice_label' => 'nomFr',
                'placeholder' => 'Choisisser une catégory',
            ));
    }/**
     * {@inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ES\AdminBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'es_adminbundle_article';
    }


}
