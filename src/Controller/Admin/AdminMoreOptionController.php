<?php

namespace App\Controller\Admin;

use App\Entity\MoreOption;
use App\Form\MoreOptionType;
use App\Repository\MoreOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/more/option")
 */
class AdminMoreOptionController extends AbstractController
{
    /**
     * @Route("/", name="admin.more_option.index", methods={"GET"})
     */
    public function index(MoreOptionRepository $moreOptionRepository): Response
    {
        return $this->render('admin/option/index.html.twig', [
            'more_options' => $moreOptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.more_option.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $moreOption = new MoreOption();
        $form = $this->createForm(MoreOptionType::class, $moreOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($moreOption);
            $entityManager->flush();

            return $this->redirectToRoute('admin.more_option.index');
        }

        return $this->render('admin/option/new.html.twig', [
            'more_option' => $moreOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.more_option.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MoreOption $moreOption): Response
    {
        $form = $this->createForm(MoreOptionType::class, $moreOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.more_option.edit', ['id'  => $moreOption->getId()]);
        }

        return $this->render('admin/option/edit.html.twig', [
            'more_option' => $moreOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.more_option.delete", methods={"DELETE"})
     */
    public function delete(Request $request, MoreOption $moreOption): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moreOption->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($moreOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.more_option.index');
    }
}
