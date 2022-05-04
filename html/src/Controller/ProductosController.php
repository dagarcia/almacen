<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/productos")
 */
class ProductosController extends AbstractController
{

    private $_productoRepository;

    public function __construct()
    {

    }

    /**
     * @Route("/", name="productos")
     * 
     * @return JsonResponse
     */
    public function listAction(Request $request, EntityManagerInterface $entityManager) 
    {
        // $producto = [
        //     "nombre" => "iphone x",
        //     "precio" => "$1000"
        // ];

        $producto = new stdClass();
        $producto->nombre = "iPhoneXXX";
        $producto->precio = "$200";


        return $this->json($producto, Response::HTTP_OK);
    }

    /**
     * 
     */
    public function getProductoAction(Request $request)
    {

    }
}