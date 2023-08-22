<?php
    class PerformanceImprovement
    {
        private $conn;
        private $table_name="pip";

        public $pin1;
        public $at1;
        public $sn1;
        public $time1;
        public $pin2;
        public $at2;
        public $sn2;
        public $time2;
        public $pin3;
        public $at3;
        public $sn3;
        public $time3;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function save_pip()
        {
            $query = "INSERT INTO ".$this->table_name." SET pin1=?, at1=?, sn1=?, time1=?, pin2=?, at2=?, sn2=?, time2=?, pin3=?, at3=?, sn3=?, time3=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $ins = $this->conn->prepare($query);

            $ins->bindParam(1, $this->pin1);
            $ins->bindParam(2, $this->at1);
            $ins->bindParam(3, $this->sn1);
            $ins->bindParam(4, $this->time1);
            $ins->bindParam(5, $this->pin2);
            $ins->bindParam(6, $this->at2);
            $ins->bindParam(7, $this->sn2);
            $ins->bindParam(8, $this->time2);
            $ins->bindParam(9, $this->pin3);
            $ins->bindParam(10, $this->at3);
            $ins->bindParam(11, $this->sn3);
            $ins->bindParam(12, $this->time3);

            if($ins->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function upd_pip()
        {
            $query = "UPDATE ".$this->table_name." SET pin1=?, at1=?, sn1=?, time1=?, pin2=?, at2=?, sn2=?, time2=?, pin3=?, at3=?, sn3=?, time3=? WHERE pip_id=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $upd = $this->conn->prepare($query);

            $upd->bindParam(1, $this->pin1);
            $upd->bindParam(2, $this->at1);
            $upd->bindParam(3, $this->sn1);
            $upd->bindParam(4, $this->time1);
            $upd->bindParam(5, $this->pin2);
            $upd->bindParam(6, $this->at2);
            $upd->bindParam(7, $this->sn2);
            $upd->bindParam(8, $this->time2);
            $upd->bindParam(9, $this->pin3);
            $upd->bindParam(10, $this->at3);
            $upd->bindParam(11, $this->sn3);
            $upd->bindParam(12, $this->time3);
            $upd->bindParam(13, $this->pip_id);

            if($upd->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function get_pip_last_id()
        {
            $query = "SELECT max(pip_id) + 1 as 'pip_id' FROM pip";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sel = $this->conn->prepare($query);

            $sel->execute();
            return $sel;
        }

        public function save_supPIP()
        {
            $query = "INSERT INTO sup_pip SET pin1=?, at1=?, sn1=?, time1=?, pin2=?, at2=?, sn2=?, time2=?, pin3=?, at3=?, sn3=?, time3=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $ins = $this->conn->prepare($query);

            $ins->bindParam(1, $this->pin1);
            $ins->bindParam(2, $this->at1);
            $ins->bindParam(3, $this->sn1);
            $ins->bindParam(4, $this->time1);
            $ins->bindParam(5, $this->pin2);
            $ins->bindParam(6, $this->at2);
            $ins->bindParam(7, $this->sn2);
            $ins->bindParam(8, $this->time2);
            $ins->bindParam(9, $this->pin3);
            $ins->bindParam(10, $this->at3);
            $ins->bindParam(11, $this->sn3);
            $ins->bindParam(12, $this->time3);

            if($ins->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function upd_supPIP()
        {
            $query = "UPDATE sup_pip SET pin1=?, at1=?, sn1=?, time1=?, pin2=?, at2=?, sn2=?, time2=?, pin3=?, at3=?, sn3=?, time3=? WHERE pip_id=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $upd = $this->conn->prepare($query);

            $upd->bindParam(1, $this->pin1);
            $upd->bindParam(2, $this->at1);
            $upd->bindParam(3, $this->sn1);
            $upd->bindParam(4, $this->time1);
            $upd->bindParam(5, $this->pin2);
            $upd->bindParam(6, $this->at2);
            $upd->bindParam(7, $this->sn2);
            $upd->bindParam(8, $this->time2);
            $upd->bindParam(9, $this->pin3);
            $upd->bindParam(10, $this->at3);
            $upd->bindParam(11, $this->sn3);
            $upd->bindParam(12, $this->time3);
            $upd->bindParam(13, $this->pip_id);

            if($upd->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function get_supPIP_last_id()
        {
            $query = "SELECT max(pip_id) + 1 as 'pip_id' FROM sup_pip";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sel = $this->conn->prepare($query);

            $sel->execute();
            return $sel;
        }
    }
?>