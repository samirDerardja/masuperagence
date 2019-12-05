<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\MoreOption;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class, [
                'choices' => $this->getChoices()
            ]) 
            ->add('more_options', EntityType::class, [
                'class' => MoreOption::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple' => true
            ] )
            ->add('imageFile',FileType::class, [
                'required' => false,
                
            ] )
            ->add('city')
            ->add('address')
            ->add('postale_code')
            ->add('sold')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices() {

        $Choises  = Property::HEAT;
        $output = [];

        foreach($Choises as $k => $v){
            $output[$v] = $k;
        }

        return $output;
    }


}
