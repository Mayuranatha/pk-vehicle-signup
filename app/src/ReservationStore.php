<?php

use Psr\Log\LoggerInterface;

final class ReservationStore
{
    private $logger;
    private $days;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;

        $this->logger->info("Opening datastore");
        ORM::configure('logging', true);
        ORM::configure('sqlite:'.  __DIR__ . '/data.sqlite');
        ORM::configure('id_column_overrides', array(
            'car' => 'car_id',
            'reservation' => 'reservation_id',
        ));

        // get the next seven days
        $daysJson = file_get_contents("https://akasha.hindu.org:8080/days/7");
        $this->days = json_decode($daysJson,true);
    }

    public function get_days() {
        return $this->days;
    }

    public function get_data_for_template() {
        $days = $this->get_days();
        $cars = $this->get_cars();
        $data = [];

        foreach ($days as $day) {
            $item = array(
                "SunOrStar" => $day["SunOrStar"],
                "Date" => $day["Date_"],
                "SunOrStar_Num" => $day["SunOrStar_Num"],
                "Cars" => array()
            );

            foreach ($cars as $car) {
                $carItem = $car;
                $carItem["Reservations"] = $this->get_reservations_for_car($car, $day);
            }
        }

    }

    public function get_cars() {
        $cars = ORM::for_table('car')->where('is_available', 1)->find_array();
        $this->logger->info("SQL: " . ORM::get_last_query());
        return $cars;
    }

    public function how_many_cars() {
        $count = ORM::for_table('car')->count();
        return $count;
    }

    public function get_car($id) {
        $car = ORM::for_table('car')->find_one($id);
        return $car;
    }

    public function is_car_available($id) {
        $car = ORM::for_table('car')->find_one($id);

        if (!$car) {
            return false;
        }

        return $car->is_available;
    }

    public function get_reservations_for_car($car, $day) {
        $reservations = ORM::for_table("reservation")
            ->where("car_id", $car["car_id"])
            ->where("start", $day)
            ->find_array();

        return $reservations;
    }

    public function make_reservation($id, $data) {
        // check if car is_available is 0, which means the car is somehow unavailable (repair shop, etc)

        $car = $this->get_car($id);

        if ($car->is_available == 0) {
            return false;
        }

        // check if there is a reservation for the given period...
        // step 1: query for all reservations on the same date range for the given car
        // step 2: if this results in a non-zero set, then we can't make the reservation (someone already reserved)

        /*
         * CUE (this works, and detects conflicts in the table after they happen):
          SELECT *,
               EXISTS (SELECT 1
                       FROM reservation AS other
                       WHERE other.reservation_id != reservation.reservation_id
                         AND other.end > reservation.start
                         AND other.start < reservation.end) AS conflict
        FROM reservation

        interval algebra: http://en.wikipedia.org/wiki/Allen%27s_Interval_Algebra
         */

    }

    public function update_reservation($id, $data) {

    }

    public function delete_reservation($id) {

    }

    
}