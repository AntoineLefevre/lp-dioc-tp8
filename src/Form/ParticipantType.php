<?php

namespace App\Form;
use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ParticipantType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Participant::class));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('enable', CheckboxType::class, array('required' => false))
            ->addEventListener( FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData'))
            ->add('save',SubmitType::class, array('label'=>"créer"))
            ->getForm();
    }

    public function onPreSetData(FormEvent $event)
    {
        $person = $event->getData();
        $form = $event->getForm();

        if ($person->getId() !== null){
            $form->remove('name');
            $form->remove('enable');
        }

    }

}