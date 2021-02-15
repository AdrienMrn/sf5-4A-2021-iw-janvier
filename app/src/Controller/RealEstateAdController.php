<?php

namespace App\Controller;

use App\Entity\RealEstateAd;
use App\Form\RealEstateAdType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $realEstateAds = $em->getRepository(RealEstateAd::class)->findAll();

        return $this->render('real_estate_ad/index.html.twig', [
            'realEstateAds' => $realEstateAds,
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request)
    {
        $realEstateAd = new RealEstateAd();
        $form = $this->createForm(RealEstateAdType::class, $realEstateAd);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($realEstateAd);
            $em->flush();

            return $this->redirectToRoute('real_estate_ad_index');
        }

        return $this->render('real_estate_ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="show", requirements={"id": "\d+"})
     */
    public function show($id)
    {
        $em = $this->getDoctrine()->getManager();
        $realEstateAd = $em->getRepository(RealEstateAd::class)->find($id);

        return $this->render('real_estate_ad/show.html.twig', [
            'realEstateAd' => $realEstateAd
        ]);
    }
}
