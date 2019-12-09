<?php


namespace App\Controller\Admin;

use App\Entity\Picture;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/more/picture")
 */
class AdminPictureController extends AbstractController {

 
    /**
     * @Route("/{id}", name="admin.picture.delete", methods={"DELETE"})
     */
    public function delete(Picture $picture, Request $request) {

        $data = json_decode($request->getContent(), true);
        $propertyId = $picture->getProperty()->getId();
        $submittedToken = $request->request->get('token');
        // $this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('token'))
        if ($this->isCsrfTokenValid('delete-item' .$picture->getId(), $data['token'])) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
            return new JsonResponse(['success' => 1]);

    } 
        return new JsonResponse(['error' => 'Token invalide'], 400);

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