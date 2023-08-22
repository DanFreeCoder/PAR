<?php
    class Kra_Kpi
    {
        private $conn;
        private $table_name="kra_kpi";

        public $kra1;
        public $kpi1;
        public $rate1;
        public $comments1;
        public $kra2;
        public $kpi2;
        public $rate2;
        public $comments2;
        public $kra3;
        public $kpi3;
        public $rate3;
        public $comments3;
        public $kra4;
        public $kpi4;
        public $rate4;
        public $comments4;
        public $kra5;
        public $kpi5;
        public $rate5;
        public $comments5;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function save_kra()
        {
            $query = "INSERT INTO ".$this->table_name." SET kra1=?, kpi1=?, rate1=?, comments1=?, kra2=?, kpi2=?, rate2=?, comments2=?, kra3=?, kpi3=?, rate3=?, comments3=?, kra4=?, kpi4=?, rate4=?, comments4=?, kra5=?, kpi5=?, rate5=?, comments5=?, kra6=?, kpi6=?, rate6=?, comments6=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $ins = $this->conn->prepare($query);

            $ins->bindParam(1, $this->kra1);
            $ins->bindParam(2, $this->kpi1);
            $ins->bindParam(3, $this->rate1);
            $ins->bindParam(4, $this->comments1);
            $ins->bindParam(5, $this->kra2);
            $ins->bindParam(6, $this->kpi2);
            $ins->bindParam(7, $this->rate2);
            $ins->bindParam(8, $this->comments2);
            $ins->bindParam(9, $this->kra3);
            $ins->bindParam(10, $this->kpi3);
            $ins->bindParam(11, $this->rate3);
            $ins->bindParam(12, $this->comments3);
            $ins->bindParam(13, $this->kra4);
            $ins->bindParam(14, $this->kpi4);
            $ins->bindParam(15, $this->rate4);
            $ins->bindParam(16, $this->comments4);
            $ins->bindParam(17, $this->kra5);
            $ins->bindParam(18, $this->kpi5);
            $ins->bindParam(19, $this->rate5);
            $ins->bindParam(20, $this->comments5);
            $ins->bindParam(21, $this->kra6);
            $ins->bindParam(22, $this->kpi6);
            $ins->bindParam(23, $this->rate6);
            $ins->bindParam(24, $this->comments6);

            if($ins->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function upd_kra()
        {
            $query = "UPDATE ".$this->table_name." SET kra1=?, kpi1=?, rate1=?, comments1=?, kra2=?, kpi2=?, rate2=?, comments2=?, kra3=?, kpi3=?, rate3=?, comments3=?, kra4=?, kpi4=?, rate4=?, comments4=?, kra5=?, kpi5=?, rate5=?, comments5=?, kra6=?, kpi6=?, rate6=?, comments6=? WHERE kra_id=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $ins = $this->conn->prepare($query);

            $ins->bindParam(1, $this->kra1);
            $ins->bindParam(2, $this->kpi1);
            $ins->bindParam(3, $this->rate1);
            $ins->bindParam(4, $this->comments1);
            $ins->bindParam(5, $this->kra2);
            $ins->bindParam(6, $this->kpi2);
            $ins->bindParam(7, $this->rate2);
            $ins->bindParam(8, $this->comments2);
            $ins->bindParam(9, $this->kra3);
            $ins->bindParam(10, $this->kpi3);
            $ins->bindParam(11, $this->rate3);
            $ins->bindParam(12, $this->comments3);
            $ins->bindParam(13, $this->kra4);
            $ins->bindParam(14, $this->kpi4);
            $ins->bindParam(15, $this->rate4);
            $ins->bindParam(16, $this->comments4);
            $ins->bindParam(17, $this->kra5);
            $ins->bindParam(18, $this->kpi5);
            $ins->bindParam(19, $this->rate5);
            $ins->bindParam(20, $this->comments5);
            $ins->bindParam(21, $this->kra6);
            $ins->bindParam(22, $this->kpi6);
            $ins->bindParam(23, $this->rate6);
            $ins->bindParam(24, $this->comments6);
            $ins->bindParam(25, $this->kra_id);

            if($ins->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function get_kra_last_id()
        {
            $query = "SELECT max(kra_id) + 1 as 'kra_id' FROM kra_kpi";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sel = $this->conn->prepare($query);

            $sel->execute();
            return $sel;
        }

        public function save_supKRA()
        {
            $query = "INSERT INTO sup_kra SET kra1=?, kpi1=?, rate1=?, comments1=?, sup_com1=?, kra2=?, kpi2=?, rate2=?, comments2=?, sup_com2=?, kra3=?, kpi3=?, rate3=?, comments3=?, sup_com3=?, kra4=?, kpi4=?, rate4=?, comments4=?, sup_com4=?, kra5=?, kpi5=?, rate5=?, comments5=?, sup_com5=?, kra6=?, kpi6=?, rate6=?, comments6=?, sup_com6=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $ins = $this->conn->prepare($query);

            $ins->bindParam(1, $this->kra1);
            $ins->bindParam(2, $this->kpi1);
            $ins->bindParam(3, $this->rate1);
            $ins->bindParam(4, $this->comments1);
            $ins->bindParam(5, $this->sup_com1);
            $ins->bindParam(6, $this->kra2);
            $ins->bindParam(7, $this->kpi2);
            $ins->bindParam(8, $this->rate2);
            $ins->bindParam(9, $this->comments2);
            $ins->bindParam(10, $this->sup_com2);
            $ins->bindParam(11, $this->kra3);
            $ins->bindParam(12, $this->kpi3);
            $ins->bindParam(13, $this->rate3);
            $ins->bindParam(14, $this->comments3);
            $ins->bindParam(15, $this->sup_com3);
            $ins->bindParam(16, $this->kra4);
            $ins->bindParam(17, $this->kpi4);
            $ins->bindParam(18, $this->rate4);
            $ins->bindParam(19, $this->comments4);
            $ins->bindParam(20, $this->sup_com4);
            $ins->bindParam(21, $this->kra5);
            $ins->bindParam(22, $this->kpi5);
            $ins->bindParam(23, $this->rate5);
            $ins->bindParam(24, $this->comments5);
            $ins->bindParam(25, $this->sup_com5);
            $ins->bindParam(26, $this->kra6);
            $ins->bindParam(27, $this->kpi6);
            $ins->bindParam(28, $this->rate6);
            $ins->bindParam(29, $this->comments6);
            $ins->bindParam(30, $this->sup_com6);

            if($ins->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function upd_supKRA()
        {
            $query = "UPDATE sup_kra SET kra1=?, kpi1=?, rate1=?, comments1=?, sup_com1=?, kra2=?, kpi2=?, rate2=?, comments2=?, sup_com2=?, kra3=?, kpi3=?, rate3=?, comments3=?, sup_com3=?, kra4=?, kpi4=?, rate4=?, comments4=?, sup_com4=?, kra5=?, kpi5=?, rate5=?, comments5=?, sup_com5=?, kra6=?, kpi6=?, rate6=?, comments6=?, sup_com6=? WHERE kra_id=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $upd = $this->conn->prepare($query);

            $upd->bindParam(1, $this->kra1);
            $upd->bindParam(2, $this->kpi1);
            $upd->bindParam(3, $this->rate1);
            $upd->bindParam(4, $this->comments1);
            $upd->bindParam(5, $this->sup_com1);
            $upd->bindParam(6, $this->kra2);
            $upd->bindParam(7, $this->kpi2);
            $upd->bindParam(8, $this->rate2);
            $upd->bindParam(9, $this->comments2);
            $upd->bindParam(10, $this->sup_com2);
            $upd->bindParam(11, $this->kra3);
            $upd->bindParam(12, $this->kpi3);
            $upd->bindParam(13, $this->rate3);
            $upd->bindParam(14, $this->comments3);
            $upd->bindParam(15, $this->sup_com3);
            $upd->bindParam(16, $this->kra4);
            $upd->bindParam(17, $this->kpi4);
            $upd->bindParam(18, $this->rate4);
            $upd->bindParam(19, $this->comments4);
            $upd->bindParam(20, $this->sup_com4);
            $upd->bindParam(21, $this->kra5);
            $upd->bindParam(22, $this->kpi5);
            $upd->bindParam(23, $this->rate5);
            $upd->bindParam(24, $this->comments5);
            $upd->bindParam(25, $this->sup_com5);
            $upd->bindParam(26, $this->kra6);
            $upd->bindParam(27, $this->kpi6);
            $upd->bindParam(28, $this->rate6);
            $upd->bindParam(29, $this->comments6);
            $upd->bindParam(30, $this->sup_com6);
            $upd->bindParam(31, $this->kra_id);

            if($upd->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function get_supKRA_last_id()
        {
            $query = "SELECT max(kra_id) + 1 as 'kra_id' FROM sup_kra";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sel = $this->conn->prepare($query);

            $sel->execute();
            return $sel;
        }
    }
?>