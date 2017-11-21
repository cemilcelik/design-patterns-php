<?php
echo "<h1>Delegation</h1>";

class TeamLead
{
    public function __construct(JuniorDeveloper $junior)
    {
        $this->junior = $junior;
    }

    public function writeCode()
    {
        return $this->junior->writeBadCode();
    }
}

class JuniorDeveloper
{
    public function writeBadCode()
    {
        return "Some junior developer generate code...";
    }
}

$junior = new JuniorDeveloper();
$teamLead = new TeamLead($junior);

echo $junior->writeBadCode();
echo "<br>";

echo $teamLead->writeCode();
echo "<br>";

echo '($junior->writeBadCode() == $teamLead->writeCode()) : ' . (($junior->writeBadCode() == $teamLead->writeCode()) ? 'True' : 'False');
