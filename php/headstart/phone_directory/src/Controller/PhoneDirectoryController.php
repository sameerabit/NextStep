<?php

namespace App\Controller;

use App\Entity\PhoneDirectory;
use App\Form\PhoneDirectoryType;
use App\Repository\PhoneDirectoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/phone/directory')]
class PhoneDirectoryController extends AbstractController
{


    #[Route('/', name: 'app_phone_directory_index', methods: ['GET'])]
    public function index(PhoneDirectoryRepository $phoneDirectoryRepository): Response
    {
        return $this->render('phone_directory/index.html.twig', [
            'phone_directories' => $phoneDirectoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_phone_directory_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PhoneDirectoryRepository $phoneDirectoryRepository): Response
    {
        $phoneDirectory = new PhoneDirectory();
        $form = $this->createForm(PhoneDirectoryType::class, $phoneDirectory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $phoneDirectoryRepository->save($phoneDirectory, true);

            return $this->redirectToRoute('app_phone_directory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('phone_directory/new.html.twig', [
            'phone_directory' => $phoneDirectory,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_phone_directory_show', requirements: ['page' => '\d+'], methods: ['GET'])]
    // public function show(PhoneDirectory $phoneDirectory): Response
    // {
    //     return $this->render('phone_directory/show.html.twig', [
    //         'phone_directory' => $phoneDirectory,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_phone_directory_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PhoneDirectory $phoneDirectory, PhoneDirectoryRepository $phoneDirectoryRepository): Response
    {
        $form = $this->createForm(PhoneDirectoryType::class, $phoneDirectory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $phoneDirectoryRepository->save($phoneDirectory, true);

            return $this->redirectToRoute('app_phone_directory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('phone_directory/edit.html.twig', [
            'phone_directory' => $phoneDirectory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_phone_directory_delete', methods: ['POST'])]
    public function delete(Request $request, PhoneDirectory $phoneDirectory, PhoneDirectoryRepository $phoneDirectoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $phoneDirectory->getId(), $request->request->get('_token'))) {
            $phoneDirectoryRepository->remove($phoneDirectory, true);
        }

        return $this->redirectToRoute('app_phone_directory_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/test', name: 'phone_directory_csv_upload', methods: ['GET'])]
    public function upload(Request $request): Response
    {
        dd('test');
    }
}
