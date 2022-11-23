<?php declare(strict_types=1);

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $a = $this->takesAnInt(6);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'a'=>$a
        ]);
    }

    /**
     * @return array<string>
     */
    function takesAnInt(int $i): array
    {
        return [$i,"hello"];
    }

}
