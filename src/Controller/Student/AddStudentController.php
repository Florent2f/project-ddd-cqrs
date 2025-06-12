<?php

namespace App\Controller\Student;

use DomainException;
use App\Form\StudentForm;
use App\Form\Model\StudentModel;
use App\UseCase\Command\AddStudent;
use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/student/new', name: 'app_student_new', methods: ['GET', 'POST'])]
final class AddStudentController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        $model = new StudentModel();
        $form = $this->createForm(StudentForm::class, $model);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->handleCommand(new AddStudent(
                $model->email,
                $model->username,
                $model->address
            ));
            } catch (DomainException $e) {
                $this->addFlash('error', $e->getMessage());
                return $this->redirectToRoute('app_student_new', [], Response::HTTP_SEE_OTHER);
            }

            return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('student/new.html.twig', [
            'student' => $model,
            'form' => $form,
        ]);
    }

    
}
