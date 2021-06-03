<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProgrammeRepository;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    

        /**
         * Undocumented function
         *@Route("/", name="home");
         *@param ProgrammeRepository $repository
         * @return Response
         */
    public function index(ProgrammeRepository $repository): Response 
    {
            $service = $repository->findLatest();
            return $this->render('pages/home.html.twig', [
                'service' => $service
            ]);
    }

}
