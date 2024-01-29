<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ClienteType extends AbstractType
{

    //Formulario creado con make:form, he añadido el botón submit para enviar los datos
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('direc')
            ->add('ciudad')
            ->add('estado')
            ->add('cod_postal')
            ->add('area')
            ->add('telefono')
            ->add('limite_credito')
            ->add('observaciones')
            ->add('submit', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }

}