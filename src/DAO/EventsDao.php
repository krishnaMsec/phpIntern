<?php
  namespace App\DAO;
  use App\utils\DbConnect;

  class EventsDao extends DbConnect
  {
    public $tableName = 'events';
    public $categoryId;

    public function getEventCategoryId($categoryType)
    {
      $selector = "event_category_id";
      $wherePhrase = array('event_category_name' => $categoryType);
      $results = parent::selectBy("event_category", $wherePhrase, $selector);
      return $results;
    }

    public function insertEventDetails($eventName, $categoryId, $coordinatorId, $eventDate, $startTime,
                                       $endTime, $addressId)
    {

      $columns = array('event_name', 'event_category_id', 'coordinator_id', 'event_date', 'start_time', 'end_time', 'address_id');
      $values = array('event_name' => $eventName, 'event_category_id' => $categoryId,
                      'coordinator_id' => $coordinatorId, 'event_date' => $eventDate,
                      'start_time' => $startTime, 'end_time' => $endTime,
                      'address_id' => $addressId);
      parent::insert($this->tableName, $columns, $values);

    }

    public function showAllEventsDetails()
    {
      $results = parent::hardCodeSelect("select * from events join address_details on events.address_id = address_details.address_id
                                    join event_category on events.event_category_id = event_category.event_category_id
                                    join users on users.user_id = events.coordinator_id
                                    left join participation on events.event_id = participation.event_id");
      return $results;
    }

    public function getEventSpots($eventId)
    {
      $selector = "spots";
      $wherePhrase = array('event_id' => $eventId);
      $results = parent::selectBy($this->tableName, $wherePhrase, $selector);
      return $results;
    }

    public function getTotalEventsList()
    {
      $selector = "count(event_id) as events_count";
      $results = parent::selectBy($this->tableName, $wherePhrase, $selector);
      return $results;
    }

  }


 ?>
