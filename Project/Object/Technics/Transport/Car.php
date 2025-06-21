<?php

class Car {
    public $brand;
    public $speed;
    public static $totalCars = 0;

    public function __construct($brand, $speed) {
        $this->brand = $brand;
        $this->speed = $speed;
        self::$totalCars++;
    }

    public function drive() {
        echo "Машина {$this->brand} едет со скоростью {$this->speed} км/ч.<br>";
    }

    public function stop() {
        echo "Машина {$this->brand} остановилась.<br>";
    }

    public static function carCount() {
        echo "Общее количество машин: " . self::$totalCars . "<br>";
    }
}

