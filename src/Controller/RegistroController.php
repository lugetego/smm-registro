<?php

namespace App\Controller;

use App\Entity\Registro;
use App\Form\RegistroType;
use App\Form\RecomendacionType;
use App\Form\EvaluacionType;
use App\Repository\RegistroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;





/**
 * @Route("/registro")
 */
class RegistroController extends AbstractController
{
    /**
     * @Route("/", name="app_registro_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $registros = $entityManager
            ->getRepository(Registro::class)
            ->findAll();

        return $this->render('registro/index.html.twig', [
            'registros' => $registros,
        ]);
    }

    /**
     * @Route("/{_locale}/new", name="app_registro_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,\Swift_Mailer $mailer): Response
    {
        $registro = new Registro();
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);
        $twigglobals = $this->get("twig")->getGlobals();
        $nombre_evento = $twigglobals["nombre_evento"];


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($registro);
            $entityManager->flush();

            // Mail
            $message = (new \Swift_Message('SMM - Registro'))
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($registro->getCorreo() ))
                //->setTo('gerardo@matmor.unam.mx')
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('mails/confirmacion.txt.twig', array('registro' => $registro)));

            ;
            $mailer->send($message);

            //return $this->redirectToRoute('app_registro_index', [], Response::HTTP_SEE_OTHER);
            return $this->render('registro/confirmacion.html.twig', [
                'registro' => $registro,
            ]);
        }

        return $this->renderForm('registro/new.html.twig', [
            'registro' => $registro,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{slug}", name="app_registro_show", methods={"GET"})
     */
    public function show(Registro $registro): Response
    {
              return $this->render('registro/show.html.twig', [
            'registro' => $registro,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="app_registro_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Registro $registro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_registro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('registro/edit.html.twig', [
            'registro' => $registro,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{slug}/evaluacion", name="app_registro_evaluacion", methods={"GET", "POST"})
     */
    public function evaluacion(Request $request, Registro $registro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvaluacionType::class, $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($registro);
            $entityManager->flush();

            return $this->redirectToRoute('app_registro_show', ['slug'=>$registro->getSlug()], Response::HTTP_SEE_OTHER);

        }
        $template = $request->isXmlHttpRequest() ? '_evalua.html.twig' : 'show.html.twig';


        return $this->renderForm('registro/'.$template, [
            'registro' => $registro,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_registro_delete", methods={"POST"})
     */
    public function delete(Request $request, Registro $registro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$registro->getId(), $request->request->get('_token'))) {
            $entityManager->remove($registro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_registro_index', [], Response::HTTP_SEE_OTHER);
    }
}
