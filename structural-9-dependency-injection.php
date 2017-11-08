<?php
echo "<h1>Dependency Injection</h1>";

class DatabaseConfiguration
{
    private $host;
    private $port;
    private $username;
    private $password;

    public function __construct(string $host, int $port, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}

class DatabaseConnection
{
    private $dbConfig;

    public function __construct(DatabaseConfiguration $dbConfig)
    {
        $this->dbConfig = $dbConfig;
    }

    public function getDsn()
    {
        return sprintf(
            '%s:%s@%s:%d',
            $this->dbConfig->getUsername(),
            $this->dbConfig->getPassword(),
            $this->dbConfig->getHost(),
            $this->dbConfig->getPort()
        );
    }
}

$dbConfig = new DatabaseConfiguration('localhost', '3300', 'db_user', '123456');

$dbConnection = new DatabaseConnection($dbConfig);

echo $dbConnection->getDsn();
