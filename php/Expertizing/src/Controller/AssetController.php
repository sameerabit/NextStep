<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\User;
use App\Form\AssetType;
use App\Repository\AssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/assets')]
class AssetController extends AbstractController
{
    #[Route('/', name: 'app_asset_index', methods: ['GET'])]
    public function index(AssetRepository $assetRepository): Response
    {
        return $this->render('asset/index.html.twig', [
            'assets' => $assetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_asset_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AssetRepository $assetRepository, #[CurrentUser] ?User $user): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $asset = new Asset();
        $form = $this->createForm(AssetType::class, $asset);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $asset->setUser($user);
            $assetRepository->save($asset, true);

            return $this->redirectToRoute('app_asset_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('asset/new.html.twig', [
            'asset' => $asset,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asset_show', methods: ['GET'])]
    public function show(Asset $asset): Response
    {
        return $this->render('asset/show.html.twig', [
            'asset' => $asset,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_asset_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Asset $asset, AssetRepository $assetRepository): Response
    {
        $form = $this->createForm(AssetType::class, $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assetRepository->save($asset, true);

            return $this->redirectToRoute('app_asset_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('asset/edit.html.twig', [
            'asset' => $asset,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asset_delete', methods: ['POST'])]
    public function delete(Request $request, Asset $asset, AssetRepository $assetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$asset->getId(), $request->request->get('_token'))) {
            $assetRepository->remove($asset, true);
        }

        return $this->redirectToRoute('app_asset_index', [], Response::HTTP_SEE_OTHER);
    }
}