<?php
namespace App\Controller;

use App\Entity\Programme;
use App\Repository\ProgrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class serviceController extends AbstractController
 {
    /**
     * Undocumented variable
     *
     * @var ProgrammeRepository
     */
    private $repository;

    public function __construct(ProgrammeRepository $repository)
    
    {
      $this->repository = $repository;
    }
     /**
      * Undocumented function
      *@Route("/service", name="service.index")
      * @return Response
      */
   public function index(): Response
   {
            return $this-> render('services/index.html.twig', [
           'current_menu'=> 'services'
        ]);
   }
   
   /**
     *@Route("/service/{slug}-{id}", name="service.show", requirements={"slug": "[a-z0-9\-]*"})
    * @return Response
    *@param Programme $programme
    */
   public function show(Programme $programme, string $slug): Response
   {
         if($programme->getSlug() !== $slug){
             return $this->redirectToRoute('service.show', [
                'id' => $programme->getId(),
                'slug' => $programme->getSlug()
             ], 301);
         }
         return $this-> render('services/show.html.twig', [
         'programme'=> $programme,
         'current_menu'=> 'services'

      ]);
   }
}
 