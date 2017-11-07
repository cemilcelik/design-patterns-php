<?php
echo "<h1>Memento</h1>";

class EditorMemento
{
    private $content;

    public function __construct(string $message)
    {
        $this->content = $message;
    }

    public function getContent()
    {
        return $this->content;
    }
}

class Editor
{
    private $content;
    private $editorMemento;

    public function type(string $message)
    {
        $this->content .= ' ' . $message;
    }

    public function save()
    {
        return new EditorMemento($this->content);
    }

    public function restore(EditorMemento $editorMemento)
    {
        $this->content = $editorMemento->getContent();
    }

    public function getContent(): string
    {
        return $this->content;
    }
}

$editor = new Editor();

$editor->type('This is the first sentence.');
$editor->type('This is second.');

$saved = $editor->save();

$editor->type('And this is third.');

echo $editor->getContent();
echo "<br>";

$editor->restore($saved);

echo $editor->getContent();
echo "<br>";
