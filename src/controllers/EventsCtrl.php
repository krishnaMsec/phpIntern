<?php
namespace App\controllers;
use App\Delegates\AllEventsDelegate;
use App\Delegates\EventsDelegates;
use App\Delegates\ParticipateEvent;
use App\Delegates\Suggestion;

class EventsCtrl extends BaseController
{

  public function showAddEventPage($request, $response, $args)
  {
    return $this->c->view->render($response, 'addevents.twig');
  }

  public function addEvents($request, $response, $args)
  {
    $eventsDelegates = new EventsDelegates();
    $datas = $request->getParsedBody();
    $eventResponse = $eventsDelegates->addEvents($datas);
    return $response->withJson($eventResponse);
  }

  public function showAllEventsPage($request, $response, $args)
  {
    $allEventsDelegate = new AllEventsDelegate();
    $results = $allEventsDelegate->showAllEventsDetails();
    return $this->c->view->render($response, 'allEvents.twig', compact('results'));
  }

  public function joinEvent( $request, $response, $args )
  {

    $joinEvents = new ParticipateEvent();
    $participateResponse = $joinEvents->participateInEvent($args);
    // return $this->withJson($participateResponse);
    return $this->c->view->render( $response, 'sample.twig' );
  }

  public function suggestEvent( $request, $response, $args )
  {
    $suggestion = new Suggestion();
    $results = $suggestion->suggestionRequest($args);
    return $results;
  }

}

 ?>
