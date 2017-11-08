<?php
echo "<h1>Data Mapper</h1>";

interface Adapter
{
    public function findById(int $id);
}

class StorageAdapter implements Adapter
{
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function findById(int $id)
    {
        if (isset($this->data[ $id ])) {
            return $this->data[ $id ];
        }

        return null;
    }
}

class DBAdapter implements Adapter
{
    public function findById(int $id)
    {
        # code...
    }
}

class DataMapper
{
    private $storage;

    public function __construct(Adapter $storage)
    {
        $this->storage = $storage;
    }

    public function findById(int $id)
    {
        $result = $this->storage->findById($id);

        if ($result === null) {
            throw new \InvalidArgumentException(`User #${id} not found!`);
        }

        return $this->mapRowToUser($result);
    }

    public function mapRowToUser(array $result): User
    {
        return User::fromState($result);
    }
}

class User
{
    private $username;
    private $email;

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }

    public static function fromState(array $state)
    {
        return new self($state['username'], $state['email']);
    }
}

$data = [
    1 => ['username' => 'john_doe', 'email' => 'john_doe@domain.com'],
    2 => ['username' => 'jane_doe', 'email' => 'jane_doe@domain.com']
];

$storage = new StorageAdapter($data);

$mapper = new DataMapper($storage);

$user = $mapper->findById(1);

echo "\$user is an istance of User class : " . (($user instanceof User) ? 'True' : 'False');
echo "<br><br>";