<?php

namespace App\StudentManagement\Presentation\Web\Controller\Student;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\StudentManagement\Application\UseCase\Query\GetStudentList;
use App\StudentManagement\Presentation\Web\Controller\AbstractController;


#[Route('/student', name: 'app_student_index', methods: ['GET'])]
final class GetStudentListController extends AbstractController
{
    public function __invoke(): Response
    {
        $students = $this->handleQuery(new GetStudentList());

        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }
    
}