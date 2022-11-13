<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Controller;

use App\Services\DataProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DataController extends AbstractController
{
    private DataProvider $dataPovider;

    public function __construct(DataProvider $dataPovider)
    {
        $this->dataPovider = $dataPovider;
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

}