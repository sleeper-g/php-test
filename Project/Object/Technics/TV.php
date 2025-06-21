<?php

class TV {
    public $brand;
    public $isOn;
    public static $supportedResolutions = ["720p", "1080p", "4K"];

    public function __construct($brand) {
        $this->brand = $brand;
        $this->isOn = false;
    }

    public function turnOn() {
        $this->isOn = true;
        echo "Телевизор {$this->brand} включен.<br>";
    }

    public function turnOff() {
        $this->isOn = false;
        echo "Телевизор {$this->brand} выключен.<br>";
    }

    public static function showSupportedResolutions() {
        echo "Поддерживаемые разрешения: " . implode(", ", self::$supportedResolutions) . "<br>";
    }
}

