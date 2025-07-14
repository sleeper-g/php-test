<?php
declare(strict_types=1);

class Person
{
    private string $name;
    private string $email;
    private string $login;

    public function __construct(string $name, string $email, string $login)
    {
        $this->name = $name;
        $this->email = $email;
        $this->login = $login;
    }

    public function __get(string $property)
    {
        return $this->$property ?? null;
    }

    public function __set(string $property, $value): void
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function __sleep(): array
    {
        echo "Сериализация объекта\n";
        return ['name', 'email', 'login'];
    }

    public function __wakeup(): void
    {
        echo "Объект восстановлен из строки\n";
    }

    public function __toString(): string
    {
        return "Person: {$this->name}, {$this->email}, {$this->login}";
    }
}

class PeopleList implements Iterator
{
    private array $people = [];
    private int $position = 0;

    public function __construct(array $people = [])
    {
        $this->people = $people;
    }

    public function addPerson(Person $person): void
    {
        $this->people[] = $person;
    }

    public function current(): mixed
    {
        return $this->people[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->people[$this->position]);
    }
}

// Работа с объектом Person
$person = new Person("Иван Иванов", "ivan@example.com", "ivan123");
$serialized = serialize($person);
echo "Сериализованный объект:\n$serialized\n";

// Замена логина
$modified = str_replace("ivan123", "petya45", $serialized);
echo "Модифицированная строка:\n$modified\n";

// Десериализация
$unserialized = unserialize($modified);
echo "Объект после десериализации:\n";
echo $unserialized . "\n";

// Работа с PeopleList
$person1 = new Person("Анна", "anna@example.com", "anna001");
$person2 = new Person("Борис", "boris@example.com", "boris007");

$peopleList = new PeopleList();
$peopleList->addPerson($person1);
$peopleList->addPerson($person2);

echo "\nСписок людей:\n";
foreach ($peopleList as $p) {
    echo $p . "\n";
}

