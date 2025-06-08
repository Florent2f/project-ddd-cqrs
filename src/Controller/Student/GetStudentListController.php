<?php

namespace App\Controller\Student;

use App\Controller\AbstractController;
use App\UseCase\Query\GetStudentList;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


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