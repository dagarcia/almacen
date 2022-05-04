<?php

namespace App\Controller;

use App\Entity\Televisor;
use App\Repository\ProductoRepository;
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

    private $productoRepository;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ProductoRepository $productoRepository)
    {
        $this->entityManager = $entityManager;
        $this->productoRepository = $productoRepository;

    }   

    /**
     * @Route("/", name="get_productos", methods={"GET"})
     * 
     * @return JsonResponse
     */
    public function getAll() 
    {
        $productos = $this->productoRepository->findAll();

        return $this->json($productos, Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", name="get_producto_by_id", methods={"GET"})
     */
    public function getOne($id)
    {
        $producto = $this->productoRepository->find($id);
        $responseStatus = Response::HTTP_OK;

        if (!$producto) {
            $responseStatus = Response::HTTP_NOT_FOUND;
        }

        

        return $this->json(["producto" => $producto], Response::HTTP_OK);
    }

    /**
     * @Route("/", name="create_televisor")
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