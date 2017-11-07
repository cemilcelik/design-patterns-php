<?php
echo "<h1>Mediator</h1>";

interface ChatRoomMediator
{
    public function showMessage(User $user, string $message);
}

class ChatRoom implements ChatRoomMediator
{
    public function showMessage(User $user, string $message)
    {
        $sender = $user->getName();
        $time = date("Y-m-d H:i:s");

        echo $time . ' [ ' . $sender . ' ] : ' . $message;
        echo "<br>";
    }
}

class User
{
    private $mediator;
    private $name;

    public function __construct(string $name, ChatRoom $mediator)
    {
        $this->name = $name;
        $this->mediator = $mediator;
    }

    public function send($message)
    {
        $this->mediator->showMessage($this, $message);
    }

    public function getName(): string
    {
        return $this->name;
    }
}

$mediator = new ChatRoom();

$johnDoe = new User('John Doe', $mediator);
$janeDoe = new User('Jane Doe', $mediator);

$johnDoe->send('Hi there!');
$janeDoe->send('Hey');
