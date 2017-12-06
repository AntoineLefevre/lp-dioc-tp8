<?php

namespace App\Subscriber;

use App\AppEvent;
use App\Event\ParticipantEvent;
use App\Event\ParticipantsEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Symfony\Component\Validator\Constraints\DateTime;


class ParticipantSubscriber implements EventSubscriberInterface
{
    protected $em;

    /**
     * PlayerSubscriber constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public static function getSubscribedEvents()
    {
        return array(ParticipantsEvent::PARTICIPANT_ADD => 'participantAdd',
            ParticipantsEvent::PARTICIPANT_EDIT => 'participantEdit');
    }

    public function participantAdd(ParticipantEvent $participantEvent){

        $participant = $participantEvent->getParticipant();

        $this->em->persist($participant);
        $this->em->flush();

        echo 'ok ajout player';
    }
/*
    public function playerEdit(ParticipantEvent $playerEvent){

        $player = $playerEvent->getPlayer();
        $player->setUpdatedAt(new \DateTime());

        $this->em->persist($player);
        $this->em->flush();

        echo 'ok edit player';
    }
*/

}