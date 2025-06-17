<?php

namespace App\StudentManagement\Presentation\Web\Controller\Student;


use DomainException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\StudentManagement\Domain\Model\Entity\Student;
use App\StudentManagement\Presentation\Web\Form\StudentForm;
use App\StudentManagement\Presentation\Web\Form\Model\StudentModel;
use App\StudentManagement\Application\UseCase\Command\UpdateStudent;
use App\StudentManagement\Presentation\Web\Controller\AbstractController;


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
