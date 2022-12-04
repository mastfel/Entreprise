<?php

namespace App\Controller;

use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default_home")
     */
    public function home(EntityManagerInterface $entityManger): Response

    {
        $employes = $entityManger ->getRepository(Employe::class)->findALL();
        return $this->render("default/home.html.twig",[
            "employes" => $employes
        ]);
    }
}
