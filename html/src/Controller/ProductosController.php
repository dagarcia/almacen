<?php

namespace App\Controller;

use App\Entity\Televisor;
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
    private $_entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_entityManager = $entityManager;

    }   

    /**
     * @Route("/", name="productos")
     * 
     * @return JsonResponse
     */
    public function listAction(Request $request) 
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

    /**
     * @Route("/televisores", name="create_televisor")
     */
    public function createTelevisor()
    {
        $tv = new Televisor();
        $tv->setNombre("Televisor");
        $tv->setMarca("Philips");
        $tv->setCosto(1000.50);
        $tv->setSku("TV-PHIL-50");
        $tv->setTamanioPantalla('50"');
        $tv->setTipoPantalla("LCD");

        try {
            $this->_entityManager->persist($tv);
            $this->_entityManager->flush();
            return $this->json($tv, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->json([
                "result" => "error",
                "message" => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
        

    }
}