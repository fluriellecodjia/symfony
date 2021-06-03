<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class programController extends AbstractController
 {
     /**
      * Undocumented function
      *@Route("/programmes", name="program.index")
      * @return Response
      */
   public function program(): Response
   {
        return $this-> render('services/program.html.twig', [
           'current_menu'=> 'programme'
        ]);
   }
    
   

}
 