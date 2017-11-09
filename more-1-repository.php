<?php
echo "<h1>Repository</h1>";

interface IStorage
{
    public function delete(int $id);
    public function retrieve(int $id);
    public function persist(array $data);
}

class MemoryStorage implements IStorage
{
    private $lastId;
    private $data;

    public function delete(int $id): void
    {
        if ( ! isset($this->data[ $id ])) {
            throw new \OutOfRangeException('No data found for Id #' . $id);
        }
        unset($this->data[ $id ]);
    }

    public function retrieve(int $id)
    {
        if ( ! isset($this->data[ $id ])) {
            throw new \OutOfRangeException('No data found for Id #' . $id);
        }

        return $this->data[ $id ];
    }

    public function persist(array $data): int
    {
        $this->lastId++;
        $data['id'] = $this->lastId;
        $this->data[ $this->lastId ] = $data;
        return $this->lastId;
    }
}

class DatabaseStorage implements IStorage
{
    public function delete(int $id) {}
    public function retrieve(int $id) {}
    public function persist(array $data) {}
}

class PostRepository
{
    private $storage;

    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    public function findById(int $id)
    {
        $data = $this->storage->retrieve($id);

        if (is_null($data)) {
            throw new \InvalidArgumentException(`Post with Id #${$id} does not exist.`);
        }

        return Post::fromState($data);
    }

    public function save(Post $post)
    {
        $id = $this->storage->persist([
            'title' => $post->getTitle(),
            'description' => $post->getDescription()
        ]);

        $post->setId($id);
    }
}

class Post
{
    private $id;
    private $title;
    private $description;

    public function __construct($id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public static function fromState(array $state): Post
    {
        return new self(
            $state['id'],
            $state['title'],
            $state['description']
        );
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}

$post = new Post(null, 'Post I', 'Post I description.');

$repository = new PostRepository(new MemoryStorage());

$repository->save($post);
echo 'User created.';
echo "<br>";

echo '($post->getId() == $repository->findById(1)->getId()) : ' . (($post->getId() == $repository->findById(1)->getId()) ? 'True' : 'False');
