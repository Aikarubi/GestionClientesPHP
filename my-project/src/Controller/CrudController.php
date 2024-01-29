<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClienteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cliente;
use App\Form\ClienteType;


class CrudController extends AbstractController
{

    private $em;

    /**
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /*ACTUALIZAR CLIENTE */

    #[Route('/update/{id}', name: 'app_updateCliente')]
    public function update($id, Request $request, ClienteRepository $clienteRepository): Response
    {
        // Buscar el cliente por su ID
        $cliente = $clienteRepository->find($id);

        if (!$cliente) {
            throw $this->createNotFoundException('Cliente no encontrado');
        }

        // Crear un formulario usando ClienteType y pasarle el cliente encontrado
        $formulario = $this->createForm(ClienteType::class, $cliente);
        // Manejar la solicitud del formulario
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            // Guardar el cliente actualizado utilizando el repositorio de clientes
            $clienteRepository->save($cliente);

            $this->addFlash('success', 'Cliente actualizado correctamente');

            return $this->redirectToRoute('lista_clientes');
        }

        return $this->render('cliente/update.html.twig', [
            'formulario' => $formulario->createView(),
            'cliente' => $cliente,
        ]);
    }


    /*INSERTAR CLIENTE*/

    #[Route('/insert', name: 'app_form')]
    public function insertar(Request $request): Response
    {
        $cliente = new Cliente();
        $formulario = $this->createForm(ClienteType::class, $cliente);
        $formulario->handleRequest($request);
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $this->em->persist($cliente);
            $this->em->flush();
            return $this->redirectToRoute('lista_clientes');
        }

        return $this->render('cliente/insert.html.twig', [
            'formulario' => $formulario->createView(),
        ]);
    }

        /*BORRAR CLIENTE*/

        #[Route('/delete/{id}', name: 'borrar_cliente')]
        public function borrarCliente($id, ClienteRepository $clienteRepository): Response
        {
            $cliente = $clienteRepository->find($id);
    
            if (!$cliente) {
                throw $this->createNotFoundException('Cliente no encontrado');
            }
    
            $clienteRepository->remove($cliente);
    
            $this->addFlash('success', 'Cliente borrado correctamente');
    
            return $this->redirectToRoute('lista_clientes');
        }
}
