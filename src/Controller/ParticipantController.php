<?php

/**
 * Created by PhpStorm.
 * User: antoine.lefevre
 * Date: 13/11/17
 * Time: 14:16
 */

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Persisters\Entity;
use Symfony\Component\Translation\Tests\StringClass;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Event\ParticipantsEvent;

/**
 * @Route(path="/participant")
 */
class ParticipantController extends Controller
{

    /**
     * @Route("/new",name="new")
     */
    public function newAction(Request $request)
    {
        $participant = $this->get(\App\Entity\Participant::class);
        $form=$this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if( $form->isSubmitted() &&  $form->isValid() ) {
            $participantEvent = $this->get(\App\Event\ParticipantEvent::class);
            $participantEvent->setParticipant($participant);
            $dispatcher = $this->get('event_dispatcher');

            $dispatcher->dispatch(ParticipantsEvent::PARTICIPANT_ADD, $participantEvent);

        }

        return $this->render('Participant/new.html.twig', array('form' => $form->createView()));

    }

    /**
     * @Route("/edit",name="edit")
     *
    public function editAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Person::class);
        $player = $repo->find(1);
        $form=$this->createForm(PersonType::class, $player);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()) {
            $playerEvent = $this->get(\App\Event\PlayerEvent::class);

            $dispatcher = $this->get('event_dispatcher');

            $dispatcher->dispatch(AppEvent::PLAYER_EDIT, $playerEvent);

        }

        return $this->render('Person/edit.html.twig', array('form' => $form->createView()));


    }
*/
    /**
     * @Route("/index",name="index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Participant::class);
        $participants = $repo->findAll();
        return $this->render('Participant/index.html.twig',array('Participants' => $participants));
    }

    /**
     * @Route(
     *     path="/show/{id}",
     *     name="show_id"
     * )
     */
    public function showAction(Participant $participant)
    {
        return $this->render('Participant/show.html.twig', ['participant' => $participant]);
    }
}
