<?php

namespace App\Controller;

use App\Form\TaxCalculateType;
use App\Service\CalculateTax;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculateTaxController extends AbstractController
{
    public function __construct(private CalculateTax $calculateTax)
    {
    }

    #[Route('/')]
    public function number(Request $request): Response
    {
        $calculateTaskRequest = new CalculateTaxRequest();
        $form = $this->createForm(TaxCalculateType::class, $calculateTaskRequest);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $taxAmount = ($this->calculateTax)($calculateTaskRequest->product, $calculateTaskRequest->taxNumber);

            return $this->render('index/tax.html.twig', [
                'taxAmount' => $taxAmount,
                'product' => $calculateTaskRequest->product,
            ]);
        }

        return $this->render('index/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
