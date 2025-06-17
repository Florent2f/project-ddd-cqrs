<?php

namespace App\StudentManagement\Presentation\Web\Controller;

use App\SharedKernel\Application\Bus\QueryBus;
use App\SharedKernel\Application\Bus\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyController;


abstract class AbstractController extends SymfonyController
{
    #[\Override]
    public static function getSubscribedServices(): array
    {
        $subscribedServices = parent::getSubscribedServices();

        $subscribedServices[] = CommandBus::class;
        $subscribedServices[] = QueryBus::class;

        return $subscribedServices;
    }

    protected function handleCommand(object $command): mixed
    {
        return $this->container->get(CommandBus::class)->handle($command);
    }

    protected function handleQuery(object $query): mixed
    {
        return $this->container->get(QueryBus::class)->handle($query);
    }

}