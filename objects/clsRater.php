<?php
class Rater
{
    private $conn;
    private $table_name = 'rater';

    public $id;
    public $fullname;
    public $position;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function save_rater()
    {
        $query = 'INSERT INTO '.$this->table_name.' SET fullname=?, position=?, project=?, status=1';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->conn->prepare($query);

        $ins->bindParam(1, $this->fullname);
        $ins->bindParam(2, $this->position);
        $ins->bindParam(3, $this->project);

        if($ins->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function update_rater()
    {
        $query = 'UPDATE '.$this->table_name.' SET fullname=?, position=?, project=? WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->fullname);
        $upd->bindParam(2, $this->position);
        $upd->bindParam(3, $this->project);
        $upd->bindParam(4, $this->id);

        if($upd->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function view_rater()
    {
        $query = 'SELECT * FROM '.$this->table_name.' WHERE status != 0 ORDER BY fullname ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    function view_sup()
    {
        $query = 'SELECT * FROM '.$this->table_name.' WHERE position = 1 AND status != 0 ORDER BY fullname ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    function view_department()
    {
        $query = 'SELECT * FROM department WHERE status != 0 ORDER BY department ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }
}
?>