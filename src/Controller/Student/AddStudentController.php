<?php

namespace App\Controller\Student;

use App\DTO\StudentModel;
use App\Form\StudentForm;
use App\Controller\AbstractController;
use App\UseCase\Command\AddStudent;
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
            $this->handleCommand(new AddStudent(
                $model->email,
                $model->username,
                $model->address
            ));

            return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('student/new.html.twig', [
            'student' => $model,
            'form' => $form,
        ]);
    }

    
}
