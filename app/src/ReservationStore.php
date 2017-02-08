<?php

use Psr\Log\LoggerInterface;

final class ReservationStore
{
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;

        $this->logger->info("Opening datastore");
        ORM::configure('logging', true);
        ORM::configure('sqlite:'.  __DIR__ . '/data.sqlite');
        ORM::configure('id_column_overrides', array(
            'car' => 'car_id',
            'reservation' => 'reservation_id',
        ));
    }

    public function get_cars() {
        $cars = ORM::for_table('car')->where('is_available', true)->find_array();
        $this->logger->info("SQL: " . ORM::get_last_query());
        return $cars;
    }

    public function how_many_cars() {
        $count = ORM::for_table('car')->count();
        return $count;
    }

    public function get_reservations_for_car($car) {

    }

    public function make_reservation($car, $data) {

    }

    public function update_reservation($id, $data) {

    }

    public function delete_reservation($id) {

    }

    
}