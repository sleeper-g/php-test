<?php
declare(strict_types=1);

require_once 'Car.php';
require_once 'Student.php';
require_once 'TV.php';

// Студент
$student = new Student("Иван", 2);
$student->study();
$student->takeExam("Математика");
Student::getUniversityInfo();

// Машины
$car1 = new Car("Toyota", 120);
$car2 = new Car("BMW", 150);
$car1->drive();
$car2->stop();
Car::carCount();

// Телевизор
$tv = new TV("Samsung");
$tv->turnOn();
$tv->turnOff();
TV::showSupportedResolutions();

