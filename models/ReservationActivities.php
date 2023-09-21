<?php

namespace Model;

class ReservationActivities extends ActiveRecord{
    protected static $table = "activitiesXreservation";
    protected static $columns_db = [
        "id",
        "reservationId",
        "activityId"
    ];

    public $id;
    public $reservationId;
    public $activityId;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->reservationId = $args["reservationId"] ?? null;
        $this->activityId = $args["activityId"] ?? null;
    }
}