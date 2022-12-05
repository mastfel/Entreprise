<?php

namespace App\Controller;

use Requests;
use App\Entity\Employe;
use App\Form\EmployeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EmployeController extends AbstractController
{
    /**
     * @Route ("/ajouter-un-employe", name="employe_create", methods={"GET|POST"})
     */
    public function create (Request $request, EntityManagerInterface $entityManager ):Response
    {
        $employe = new Employe();

        $form = $this->createForm(EmployeFormType::class, $employe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            //$form->get('salary')->getData();
            $entityManager->persist($employe);
            $entityManager->flush();
            
            return $this->redirectToRoute('default_home');

        }

        return $this->render("form/employe.html.twig", [
            "form_employe" => $form->createView()
        ]);

    }#end function create()


    /**
     * @Route("/modifier-un-employe-{id}", name="employe_update", methods={"GET|POST"})

     */
    public function update ( Employe $employe,Request $request, EntityManagerInterface $entityManager):Response
    {

        $form = $this->createForm(EmployeFormType::class, $employe)
        ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('default_home');
        }
        return $this->render("form/employe.html.twig", [

            'employe'=>$employe,
            "form_employe" => $form->createView()
        ]);     
}

 /**
     * @Route("/supprimer-un-employe-{id}", name="employe_delete", methods={"GET"})

     */
public function delete(Employe $employe, EntityManagerInterface $entityManager): RedirectResponse
{
$entityManager->remove($employe);
$entityManager->flush();

return $this->redirectToRoute("default_home");

}


}
