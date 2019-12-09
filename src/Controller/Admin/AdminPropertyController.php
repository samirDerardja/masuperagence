<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Routing\Annotation\Route;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminPropertyController extends AbstractController
{

    private $repository;


    public function __construct(PropertyRepository $repository , EntityManagerInterface $em) {

        $this->repository = $repository;
        $this->em = $em;
 
      
    }

    /**
    * @route("/admin", name="admin.property.index")
    */

public function index() {

$properties = $this->repository->findAll();
return $this->render('admin/property/index.html.twig', \compact('properties'));
}


/**
* @route("/admin/property/new", name="admin.property.new")
*/
public function new(Request $request) {

$property = new Property();

$form = $this->createForm(PropertyType::class, $property);

$form->handleRequest($request);

if($form->isSubmitted() && $form->isValid()) {

    $this->em->persist($property);
    $this->em->flush();
    $this->addFlash('success', 'Bien crée avec succes');
    return $this->redirectToRoute('admin.property.index');
}

return $this->render('admin/property/new.html.twig', [

    'property' => $property,
    'form' => $form->createView()
]);

}

/**
* @route("/admin/property/{id}", name="admin.property.edit" , methods="GET|POST")
*/

public function edit(Property $property, Request $request) {

    $form = $this->createForm(PropertyType::class, $property);

    $form->handleRequest($request);
   

    if($form->isSubmitted() && $form->isValid()) {

       
        $this->em->flush();
        $this->addFlash('success', 'Bien modifié avec success');
        return $this->redirectToRoute('admin.property.index');
    }

return $this->render('admin/property/edit.html.twig', [

    'property' => $property,
    'form' => $form->createView()
]);

}
 

/**
*@route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
*/
public function delete(Property $property, Request $request) {
 
   
    $submittedToken = $request->request->get('token');
    if($this->isCsrfTokenValid('delete-item', $submittedToken)){
        
    $this->em->remove($property);
    $this->em->flush();
    $this->addFlash('success', 'Bien supprimé avec succes');
    
   }
return $this->redirectToRoute('admin.property.index');

}

public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'      => PropertyType::class,
            // enable/disable CSRF protection for this form
            'csrf_protection' => true,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'task_item',
        ]);
    }


 
}