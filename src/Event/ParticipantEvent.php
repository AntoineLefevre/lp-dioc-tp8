<?php

/**
 * Created by PhpStorm.
 * User: antoine.lefevre
 * Date: 04/12/17
 * Time: 15:41
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class ParticipantEvent extends Event
{
    private $participant;

    /**
     * @return mixed
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param mixed $participant
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
    }




}