<?php

namespace App\Controller\Student;

use DomainException;
use App\Entity\Student;
use App\Controller\AbstractController;
use App\UseCase\Command\DeleteStudent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


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