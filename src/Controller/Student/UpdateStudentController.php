<?php

namespace App\Controller\Student;

use DomainException;
use App\Entity\Student;
use App\Form\StudentForm;
use App\Form\Model\StudentModel;
use App\Controller\AbstractController;
use App\UseCase\Command\UpdateStudent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/student/{id}/edit', name: 'app_student_edit', methods: ['GET', 'POST'])]
final class UpdateStudentController extends AbstractController
{
    public function __invoke(Request $request, Student $student): Response
    {
        $model = StudentModel::createFromEntity($student);
        $form = $this->createForm(StudentForm::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            try {
                $this->handleCommand(new UpdateStudent(
                    $student->id,
                    $model->email,
                    $model->username,
                    $model->address
                ));
            } catch (DomainException $e) {
                $this->addFlash('error', $e->getMessage());
                return $this->redirectToRoute('app_student_edit', [
                    'id' => $student->id,
                ], Response::HTTP_SEE_OTHER);
            }

            return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }
    
}
