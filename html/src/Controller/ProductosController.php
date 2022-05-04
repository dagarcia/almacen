<?php

namespace App\Controller;

use App\Entity\Televisor;
use App\Repository\ProductoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
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
        try {
            $productos = $this->productoRepository->findAll();
            $status = (!$productos) ? Response::HTTP_NOT_FOUND : Response::HTTP_OK;                
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $productos = null;
        }
        
        $response = [
            "success" => (isset($error)) ? false : true,
            "error" => (isset($error)) ? $error : null,
            "data" => $productos
        ];

        return $this->json($response, $status);
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
     * @Route("/", name="create_producto", methods={"POST"})
     */
    public function create(Request $request, LoggerInterface $logger)
    {
        $contenido = json_decode($request->getContent(), true);
        $logger->info("diego");
        $logger->info("categoria: " . $contenido);

        // switch ($categoria) {
        //     case 'televisor':
        //         $producto = new Televisor();
        //         $producto->setTamanioPantalla('50"');
        //         $producto->setTipoPantalla("LCD");
        //     break;
        // }

        

        // try {
        //     $this->entityManager->persist($tv);
        //     $this->entityManager->flush();
        //     return $this->json($tv, Response::HTTP_CREATED);
        // } catch (\Throwable $th) {
        //     return $this->json([
        //         "result" => "error",
        //         "message" => $th->getMessage(),
        //     ], Response::HTTP_BAD_REQUEST);
        // }
        return $this->json($contenido);

    }
}