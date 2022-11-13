<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Controller;

use App\Services\DataProvider;
use App\Services\ProductProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DataController extends AbstractController
{
    private DataProvider $dataPovider;

    private ProductProvider $productProvider;

    public function __construct(DataProvider $dataPovider, ProductProvider $productProvider)
    {
        $this->dataPovider = $dataPovider;
        $this->productProvider = $productProvider;
    }

    /**
    * @Route("/get", name="getData")
    */
    public function getData()
    {
        $data = $this->dataPovider->serializeData();

        return $this->render('Products//list.html.twig', [
            'data' => $data,
          ]);
    }

    /**
    * @Route("/get/{product}", name="getProduct")
    */
    public function getProduct(string $product)
    {
        $data = $this->productProvider->serializeProduct($product);

        $variants = $this->productProvider->serializeVariants($product);

        return $this->render('Products//details.html.twig', [
            'data' => $data,
            'variants' => $variants,
          ]);
    }
}