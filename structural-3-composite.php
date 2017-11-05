<?php
echo "<h1>Composite</h1>";

class Organization
{
    private $employees = array();
    private $netSalary;

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function getNetSalaries(): float
    {
        foreach ($this->employees as $employee) {
            $this->netSalary += $employee->salary;
        }

        return $this->netSalary;
    }
}

interface Employee
{
    public function __construct(string $name, float $salary);
}

class Developer implements Employee
{
    private $name;
    public $salary;

    public function __construct(string $name, float $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }
}

class Designer implements Employee
{
    private $name;
    public $salary;

    public function __construct(string $name, float $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }
}

$johnDoe = new Developer('John Doe', 5000);
$janeDoe = new Designer('Jane Doe', 3000);

$organization = new Organization();
$organization->addEmployee($johnDoe);
$organization->addEmployee($janeDoe);

echo 'Net Salaries : ' . $organization->getNetSalaries();
