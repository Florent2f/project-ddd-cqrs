<?php

declare(strict_types=1);

namespace App\SharedKernel\Application\Bus;

use Symfony\Component\Messenger\MessageBusInterface;

final class MessageBus
{

    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatch(object $message) : void 
    {
        $this->messageBus->dispatch($message);
    }

}