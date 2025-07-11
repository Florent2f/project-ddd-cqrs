<?php

declare(strict_types=1);

namespace App\SharedKernel\Application\Bus;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final class QueryBus
{

    use HandleTrait {
        HandleTrait::handle as messengerHandle;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    /**
     * @throws \Throwable
     */
    public function handle(object $message): mixed
    {
        try {
            return $this->messengerHandle($message);
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                /** @var \Throwable $e */
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }

}