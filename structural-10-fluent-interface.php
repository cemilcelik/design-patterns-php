<?php
echo "<h1>Fluent Interface</h1>";

class Sql
{
    private $query = '';
    private $select = [];
    private $from = [];
    private $where = [];

    public function select(array $select): Sql
    {
        $this->select = $select;

        return $this;
    }
    
    public function from(string $table, string $alias): Sql
    {
        $this->from[] = "${table} AS ${alias}";

        return $this;
    }

    public function where($where): Sql
    {
        $this->where[] = $where;

        return $this;
    }

    public function __toString()
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s',
            implode(', ', $this->select),
            implode(', ', $this->from),
            implode(' AND ', $this->where)
        );
    }
}

$query = 
    (new Sql())
    ->select(['m.name', 'm.email'])
    ->from('member', 'm')
    ->where('age >= ?')
    ->where('gender = ?');

echo $query;