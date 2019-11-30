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
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
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
 
  
    if($this->isCsrfTokenValid('delete_token', $property->getId(), $request->get('_token'))){
    $this->em->remove($property);
    $this->em->flush();
    $this->addFlash('success', 'Bien supprimer avec succes');
    return new Response('suppresion');
    
}
return $this->redirectToRoute('admin.property.index');

}


}

