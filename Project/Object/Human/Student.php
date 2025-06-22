<?php
declare(strict_types=1);

class Student 

{
    public $name;
    public $course;
    public static $universityName = "Институт информационных технологий";

    public function construct($name, $course) 
    
    {
        $this->name = $name;
        $this->course = $course;
    }

    public function study() 
    
    {
        echo "{$this->name} учится на {$this->course} курсе.<br>";
    }

    public function takeExam($subject) 
    
    {
        echo "{$this->name} сдаёт экзамен по предмету: {$subject}.<br>";
    }

    public static function getUniversityInfo() 
    
    {
        echo "Обучение проходит в университете: " . self::$universityName . "<br>";
    }
}

