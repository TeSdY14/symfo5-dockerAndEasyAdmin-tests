<?php

namespace App\EventSubscriber;

use App\Repository\ConferenceRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

/**
 * Class TwigEventSubscriber
 * @package App\EventSubscriber
 */
class TwigEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var ConferenceRepository
     */
    private $conferenceRepository;

    /**
     * TwigEventSubscriber constructor.
     * @param Environment $twig
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(Environment $twig, ConferenceRepository $conferenceRepository)
    {
        $this->twig = $twig;
        $this->conferenceRepository = $conferenceRepository;
    }

    /**
     * Rend accessible la variable "conferences" dans toutes les vues twig (sans même devoir la définir dans les fonctions des controllers).
     * @param ControllerEvent $event
     */
    public function onControllerEvent(ControllerEvent $event)
    {
        $this->twig->addGlobal('conferences', $this->conferenceRepository->findAll());
        $this->twig->addGlobal('TwigGlobalVariable', "<p> >>> Ce message apparait grâce à une Variable rendue disponible \r\n dans \"./src/EventSubscriber/TwigEventSubscriber.php\" ! <<< </p>");
    }

    /**
     * @return array|string[]
     */
    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
