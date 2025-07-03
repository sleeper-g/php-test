<?php
declare(strict types=1);

/**
  * Interface LeadInterface
  * Сотрудник, который может управлять командой
 */ 
interface LeadInterface {
    /**
      * Руководит командой
      * @return string
     */  
    public function leadTeam(): string;
}

/**
  * Interface ApplicationCreatorInterface
  * Сотрудник, который может разрабатывать приложения
 */ 
interface ApplicationCreatorInterface {
    /**
      * Разрабатывает приложение
      * @return string
     */  
    public function developApplication(): string;
}

/**
  * Interface WebinarSpeakerInterface
  * Сотрудник, который может проводить вебинары
 */ 
interface WebinarSpeakerInterface {
    public function conductWebinar(): string;
}


/**
  * Class Employee
  * Абстрактный базовый класс для всех сотрудников
 */ 
abstract class Employee {

    /** @var string */
    protected string $firstName;

    /** @var string */
    protected string $lastName;

    /** @var int */
    protected int $salary;

    /** @var int */
    public static int $totalEmployees = 0;

    /** @var int */
    public static int $totalSalary = 0;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param int $salary
     */
    public function __construct(string $firstName, string $lastName, int $salary) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->salary = $salary;

        self::$totalEmployees++;
        self::$totalSalary += $salary;
    }

    /**
     * Описание выполняемой работы
     * @return string
     */
    abstract public function workDescription(): string;

    /**
     * Полное имя сотрудника
     * @return string
     */
    public function getFullName(): string {
        return "{$this->lastName} {$this->firstName}";
    }

    /**
     * Зарплата сотрудника
     * @return int
     */
    public function getSalary(): int {
        return $this->salary;
    }

    /**
     * Должность (по имени класса)
     * @return string
     */
    public function getPosition(): string {
        return strtolower((new \ReflectionClass($this))->getShortName());
    }
}


/**
 * Class Director
 * Директор отдела
 */
class Director extends Employee implements LeadInterface, WebinarSpeakerInterface {
    /** @var string */
    private string $department;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param int $salary
     * @param string $department
     */
    public function __construct(string $firstName, string $lastName, int $salary, string $department) {
        parent::__construct($firstName, $lastName, $salary);
        $this->department = $department;
    }

    /**
     * @return string
     */
    public function workDescription(): string {
        return "Управляет отделом {$this->department}";
    }

    /**
     * @return string
     */
    public function leadTeam(): string {
        return "Руководит всей командой.";
    }

    /**
     * @return string
     */
    public function conductWebinar(): string {
        return "Проводит стратегические вебинары для руководства.";
    }
}

/**
 * Class Manager
 * Менеджер проекта
 */
class Manager extends Employee implements LeadInterface, WebinarSpeakerInterface {
    /** @var int */
    private int $teamSize;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param int $salary
     * @param int $teamSize
     */
    public function __construct(string $firstName, string $lastName, int $salary, int $teamSize) {
        parent::__construct($firstName, $lastName, $salary);
        $this->teamSize = $teamSize;
    }

    /**
     * @return string
     */
    public function workDescription(): string {
        return "Координирует работу команды из {$this->teamSize} человек.";
    }

    /**
     * @return string
     */
    public function leadTeam(): string {
        return "Организует ежедневные встречи и задачи.";
    }

    /**
     * @return string
     */
    public function conductWebinar(): string {
        return "Проводит обучающие вебинары для сотрудников.";
    }
}

/**
 * Class Programmer
 * Программист
 */
class Programmer extends Employee implements ApplicationCreatorInterface, WebinarSpeakerInterface {
    /** @var string */
    private string $language;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param int $salary
     * @param string $language
     */
    public function __construct(string $firstName, string $lastName, int $salary, string $language) {
        parent::__construct($firstName, $lastName, $salary);
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function workDescription(): string {
        return "Пишет код на {$this->language}.";
    }

    /**
     * @return string
     */
    public function developApplication(): string {
        return "Разрабатывает приложения на {$this->language}.";
    }
    /**
     * @return string
     */
    public function conductWebinar(): string {
        return "Проводит вебинары на технические темы.";
    }
}

/**
 * Class Tester
 * Тестировщик
 */
class Tester extends Employee implements WebinarSpeakerInterface {
    /** @var string[] */
    private array $tools;

    /**
    * @param string $firstName
    * @param string $lastName
    * @param int $salary
    * @param string[] $tools
    */
    public function __construct(string $firstName, string $lastName, int $salary, array $tools) {
        parent::__construct($firstName, $lastName, $salary);
        $this->tools = $tools;
    }

    /**
     * @return string
     */
    public function workDescription(): string {
        $toolList = implode(", ", $this->tools);
        return "Тестирует приложение с помощью инструментов: {$toolList}.";
    }

    /**
     * @return string
     */
    public function conductWebinar(): string {
        return "Проводит вебинары по тестированию и качеству ПО.";
    }
}


/**
 * Выводит информацию обо всех сотрудниках
 *
 * @param Employee[] $employees
 * @return void
 */
function performRollCall(array $employees): void {
    foreach ($employees as $emp) {
        echo $emp->getFullName() . ", позиция: " . $emp->getPosition() . ", зарплата: " . $emp->getSalary() . " попугаев\n";
        echo "  Особенности работы: " . $emp->workDescription() . "\n";

        if ($emp instanceof LeadInterface) {
            echo "  Может управлять: " . $emp->leadTeam() . "\n";
        }

        if ($emp instanceof ApplicationCreatorInterface) {
            echo "  Может заниматься разработкой приложения: " . $emp->developApplication() . "\n";
        }

        if ($emp instanceof WebinarSpeakerInterface) {
            echo "  Может проводить вебинары: " . $emp->conductWebinar() . "\n";
        }

        echo "\n";
    }

    echo "Общее количество сотрудников: " . Employee::$totalEmployees . ".\n";
    echo "Общая сумма зарплат: " . Employee::$totalSalary . " попугаев.\n";
}

//Инициализация
$employees = [
    new Director("Иван", "Иванов", 50, "Разработка"),
    new Manager("Елена", "Петрова", 35, 5),
    new Programmer("Артём", "Сидоров", 20, "PHP"),
    new Programmer("Мария", "Кузнецова", 22, "JavaScript"),
    new Tester("Ольга", "Морозова", 18, ["Selenium", "Postman"])
];


performRollCall($employees);

