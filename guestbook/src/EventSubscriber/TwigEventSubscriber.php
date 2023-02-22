<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Repository\ConferenceRepository;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    public function __construct(

        private Environment $twig,
        private ConferenceRepository $conferenceRepository
        
    ) {}

    public function onControllerEvent(ControllerEvent $event): void
    {
        // ...
        $this->twig->addGlobal('conferences', $this->conferenceRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
