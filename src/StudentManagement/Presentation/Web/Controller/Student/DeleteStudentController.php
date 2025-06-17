<?php

namespace App\StudentManagement\Presentation\Web\Controller\Student;

use DomainException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\StudentManagement\Domain\Model\Entity\Student;
use App\StudentManagement\Application\UseCase\Command\DeleteStudent;
use App\StudentManagement\Presentation\Web\Controller\AbstractController;


#[Route('/student/{id}', name: 'app_student_delete', methods: ['POST'])]
final class DeleteStudentController extends AbstractController
{
    public function __invoke(Student $student, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->getPayload()->getString('_token'))) {
            try {
                $this->handleCommand(new DeleteStudent($student->getId()));
            } catch (DomainException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
    }
    
}