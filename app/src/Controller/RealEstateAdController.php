<?php

namespace App\Controller;

use App\Entity\RealEstateAd;
use App\Form\RealEstateAdType;
use App\Repository\RealEstateAdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RealEstateAdController
 * @package App\Controller
 *
 *
 *
 * @Route("/real-estate-ad", name="real_estate_ad_")
 */
class RealEstateAdController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(RealEstateAdRepository $realEstateAdRepository): Response
    {
        return $this->render('real_estate_ad/index.html.twig', [
            'realEstateAds' => $realEstateAdRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $realEstateAd = new RealEstateAd();
        $form = $this->createForm(RealEstateAdType::class, $realEstateAd);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($realEstateAd);
            $em->flush();

            $this->addFlash('green', 'Annonce immobilière créée avec succès !');

            return $this->redirectToRoute('real_estate_ad_index');
        }

        return $this->render('real_estate_ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id": "\d+"}, methods={"GET", "POST"})
     */
    public function edit(Request $request, RealEstateAd $realEstateAd): Response
    {
        $form = $this->createForm(RealEstateAdType::class, $realEstateAd);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('green', 'Annonce immobilière éditée avec succès !');

            return $this->redirectToRoute('real_estate_ad_show', [
                'slug' => $realEstateAd->getSlug()
            ]);
        }

        return $this->render('real_estate_ad/edit.html.twig', [
            'form' => $form->createView(),
            'realEstateAd' => $realEstateAd
        ]);
    }

    /**
     * @Route("/{slug}", name="show", requirements={"id": "\d+"}, methods={"GET"})
     */
    public function show(RealEstateAd $realEstateAd): Response
    {
        return $this->render('real_estate_ad/show.html.twig', [
            'realEstateAd' => $realEstateAd
        ]);
    }

    /**
     * @Route("/delete/{id}/{token}", name="delete", requirements={"id": "\d+"}, methods={"GET"})
     * @param RealEstateAd $realEstateAd
     * @return Response
     */
    public function delete(RealEstateAd $realEstateAd, string $token): Response
    {
        if (!$this->isCsrfTokenValid('delete' . $realEstateAd->getId(), $token)) {
            throw new Exception('Invalid CSRF Token');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($realEstateAd);
        $em->flush();

        $this->addFlash('green', 'Annonce immobilière supprimée avec succès !');

        return $this->redirectToRoute('real_estate_ad_index');
    }
}
