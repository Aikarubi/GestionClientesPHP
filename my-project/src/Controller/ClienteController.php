<?php


namespace App\Controller;


use App\Repository\ClienteRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ClienteController extends AbstractController
{
    // Asignar el EntityManager recibido al atributo privado $em
    private $em;

    /**
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Definir la ruta para la página de inicio del cliente
    #[Route('/', name: 'app_cliente')]
    public function index(): Response
    {
        // Renderizar la plantilla 
        return $this->render('base.html.twig', [
            'controller_name' => 'ClienteController',
        ]);
    }

    #[Route('/clients', name: 'lista_clientes')]
    public function listaClientes(ClienteRepository $clienteRepository): Response
    {
        //// Obtener todos los clientes desde el repositorio de clientes
        $clientes = $clienteRepository->findAll();

        return $this->render('cliente/list.html.twig', [
            'clientes' => $clientes,
        ]);
    }




    #[Route('/client/detail/{id}', name: 'ver_cliente')]
    public function verCliente($id, ClienteRepository $clienteRepository): Response
    {
        // Buscar el cliente por su ID
        $cliente = $clienteRepository->find($id);

        if (!$cliente) {
            throw $this->createNotFoundException('Cliente no encontrado');
        }

        return $this->render('cliente/ver_cliente.html.twig', [
            'cliente' => $cliente,
        ]);
    }


}
