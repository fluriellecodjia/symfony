<?php
namespace App\Controller\Admin;
use App\Form\ProgrammeType;
use App\Entity\Programme;
use App\Repository\ProgrammeRepository;
use Symfony\Component\Security\Csrf\CsrfToken;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProgramController extends AbstractController{
    /**
     * Undocumented function
     *@var ProgrammeRepository
    */
    private $repository;
    /**
     * Undocumented function
     *@var ObjectManager
     *
     */
     private $em;

   public function __construct(ProgrammeRepository $repository, EntityManagerInterface $em)
   {
       $this->repository = $repository;
       $this->em = $em;
   }
   /**
    * Undocumented function
    *@Route("/admin", name="admin.program.index") 
    * @return \symfony\Component\HttpFoundation\Response
    */
    public function index()
    {
       $Programme = $this-> repository ->findAll();
       return $this->render('admin/programme/index.html.twig',  compact('Programme'));
    }
    /**
     * Undocumented function
     *@Route("/admin/program/create", name="admin.program.new")
     * 
     */
     public function new(Request $request)
     {
        $programme = new Programme();
         $form = $this->createForm(ProgrammeType::class, $programme);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($programme);
            $this->em->flush();
            $this->addFlash('success', 'Service ajouter avec succès');
            return $this->redirectToRoute('admin.program.index');

        }
        return $this -> render('admin/programme/new.html.twig', [
            'programme' => $programme,
            'form'=> $form->createView()
        ]);
     }

    /**
     * @Route("/admin/program/{id}", name="admin.program.edit", methods="GET|POST")
     * @param Programme $programme
     * @param Request $request
     * @return \symfony\Component\HttpFoundation\Response
     */
    public function edit(Programme $programme, Request $request)
    {
      $form = $this->createForm(ProgrammeType::class, $programme);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Service modifier avec succès');
            return $this->redirectToRoute('admin.program.index');

        }
        return $this -> render('admin/programme/edit.html.twig', [
            'programme' => $programme,
            'form'=> $form->createView()
        ]);
    }
    
} 