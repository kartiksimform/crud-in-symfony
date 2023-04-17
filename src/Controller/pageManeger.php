<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\InsertOneDataBySelfType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class pageManeger extends AbstractController
{

    #[Route("/", name: "app_home")]
    public function appHome()
    {
        return $this->render("mainManu/home.html.twig");
    }

    #[Route("/new", name: "app_insert")]
    public function appInsert(Request $reqvest,EntityManagerInterface $em)
    {
        $emp = new Employee();
        $form = $this->createForm(InsertOneDataBySelfType::class, $emp);
        // $formView=$form->createView();
        // dd($formView);
        $form->handleRequest($reqvest);
        if($form->isSubmitted()){
            $this->addFlash('success',"Data Added");
            $em->persist($emp);
            $em->flush();
            // dd($emp->getId());
            return $this->redirectToRoute('app_show');
        }

        // dd($form->createView());
        return $this->render('mainManu/insert.html.twig', ['insert_form' => $form->createView()]);
    }

    #[Route("/show", name: "app_show")]
    public function appShow(EmployeeRepository $emp)
    {
        $emp = $emp->getAllOrderById();
        // dd($emp);

        return $this->render("mainManu/show.html.twig", ["emp" => $emp]);
    }
    #[Route("/delete/{id}", name: "user_delete")]
    public function userDelete(int $id, EmployeeRepository $emprepo, EntityManagerInterface $em)
    {
        $ob = $emprepo->find($id);
        if ($ob) {
            $em->remove($ob);
            $em->flush();
            $this->addFlash('success', "Record Deleted");
            dd($em);
        } else {
            dd("Not valid id");
        }

        // return $this->redirectToRoute("app_show");
    }
}
