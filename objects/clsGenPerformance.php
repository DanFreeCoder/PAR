<?php
    class GenPerformance
    {
        private $conn;
        private $table_name="gen_performance";

        public $gp1a_rate;
        public $gp1a_comment;
        public $gp1b_rate;
        public $gp1b_comment;
        public $gp1c_rate;
        public $gp1c_comment;
        public $gp2a_rate;
        public $gp2a_comment;
        public $gp2b_rate;
        public $gp2b_comment;
        public $gp2c_rate;
        public $gp2c_comment;
        public $gp3a_rate;
        public $gp3a_comment;
        public $gp3b_rate;
        public $gp3b_comment;
        public $gp3c_rate;
        public $gp3c_comment;
        public $gp4a_rate;
        public $gp4a_comment;
        public $gp4b_rate;
        public $gp4b_comment;
        public $gp4c_rate;
        public $gp4c_comment;
        public $gp5a_rate;
        public $gp5a_comment;
        public $gp5b_rate;
        public $gp5b_comment;
        public $gp5c_rate;
        public $gp5c_comment;
        public $gp6a_rate;
        public $gp6a_comment;
        public $gp6b_rate;
        public $gp6b_comment;
        public $gp6c_rate;
        public $gp6c_comment;
        public $gp7a_rate;
        public $gp7a_comment;
        public $gp7b_rate;
        public $gp7b_comment;
        public $gp7c_rate;
        public $gp7c_comment;
        public $gp8a_rate;
        public $gp8a_comment;
        public $gp8b_rate;
        public $gp8b_comment;
        public $gp8c_rate;
        public $gp8c_comment;
        public $gp9a_rate;
        public $gp9a_comment;
        public $gp9b_rate;
        public $gp9b_comment;
        public $gp9c_rate;
        public $gp9c_comment;
        public $gp10a_rate;
        public $gp10a_comment;
        public $gp10b_rate;
        public $gp10b_comment;
        public $gp10c_rate;
        public $gp10c_comment;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function save_gp()
        {
            $query = "INSERT INTO ".$this->table_name." SET gp1a_rate=?, gp1a_comment=?, gp1b_rate=?, gp1b_comment=?, gp1c_rate=?, gp1c_comment=?, gp2a_rate=?, gp2a_comment=?, gp2b_rate=?, gp2b_comment=?, gp2c_rate=?, gp2c_comment=?, gp3a_rate=?, gp3a_comment=?, gp3b_rate=?, gp3b_comment=?, gp3c_rate=?, gp3c_comment=?, gp4a_rate=?, gp4a_comment=?, gp4b_rate=?, gp4b_comment=?, gp4c_rate=?, gp4c_comment=?, gp5a_rate=?, gp5a_comment=?, gp5b_rate=?, gp5b_comment=?, gp5c_rate=?, gp5c_comment=?, gp6a_rate=?, gp6a_comment=?, gp6b_rate=?, gp6b_comment=?, gp6c_rate=?, gp6c_comment=?, gp7a_rate=?, gp7a_comment=?, gp7b_rate=?, gp7b_comment=?, gp7c_rate=?, gp7c_comment=?, gp8a_rate=?, gp8a_comment=?, gp8b_rate=?, gp8b_comment=?, gp8c_rate=?, gp8c_comment=?, gp9a_rate=?, gp9a_comment=?, gp9b_rate=?, gp9b_comment=?, gp9c_rate=?, gp9c_comment=?, gp10a_rate=?, gp10a_comment=?, gp10b_rate=?, gp10b_comment=?, gp10c_rate=?, gp10c_comment=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $ins = $this->conn->prepare($query);

            $ins->bindParam(1, $this->gp1a_rate);
            $ins->bindParam(2, $this->gp1a_comment);
            $ins->bindParam(3, $this->gp1b_rate);
            $ins->bindParam(4, $this->gp1b_comment);
            $ins->bindParam(5, $this->gp1c_rate);
            $ins->bindParam(6, $this->gp1c_comment);
            $ins->bindParam(7, $this->gp2a_rate);
            $ins->bindParam(8, $this->gp2a_comment);
            $ins->bindParam(9, $this->gp2b_rate);
            $ins->bindParam(10, $this->gp2b_comment);
            $ins->bindParam(11, $this->gp2c_rate);
            $ins->bindParam(12, $this->gp2c_comment);
            $ins->bindParam(13, $this->gp3a_rate);
            $ins->bindParam(14, $this->gp3a_comment);
            $ins->bindParam(15, $this->gp3b_rate);
            $ins->bindParam(16, $this->gp3b_comment);
            $ins->bindParam(17, $this->gp3c_rate);
            $ins->bindParam(18, $this->gp3c_comment);
            $ins->bindParam(19, $this->gp4a_rate);
            $ins->bindParam(20, $this->gp4a_comment);
            $ins->bindParam(21, $this->gp4b_rate);
            $ins->bindParam(22, $this->gp4b_comment);
            $ins->bindParam(23, $this->gp4c_rate);
            $ins->bindParam(24, $this->gp4c_comment);
            $ins->bindParam(25, $this->gp5a_rate);
            $ins->bindParam(26, $this->gp5a_comment);
            $ins->bindParam(27, $this->gp5b_rate);
            $ins->bindParam(28, $this->gp5b_comment);
            $ins->bindParam(29, $this->gp5c_rate);
            $ins->bindParam(30, $this->gp5c_comment);
            $ins->bindParam(31, $this->gp6a_rate);
            $ins->bindParam(32, $this->gp6a_comment);
            $ins->bindParam(33, $this->gp6b_rate);
            $ins->bindParam(34, $this->gp6b_comment);
            $ins->bindParam(35, $this->gp6c_rate);
            $ins->bindParam(36, $this->gp6c_comment);
            $ins->bindParam(37, $this->gp7a_rate);           
            $ins->bindParam(38, $this->gp7a_comment);
            $ins->bindParam(39, $this->gp7b_rate);
            $ins->bindParam(40, $this->gp7b_comment);
            $ins->bindParam(41, $this->gp7c_rate);
            $ins->bindParam(42, $this->gp7c_comment);
            $ins->bindParam(43, $this->gp8a_rate);
            $ins->bindParam(44, $this->gp8a_comment);
            $ins->bindParam(45, $this->gp8b_rate);
            $ins->bindParam(46, $this->gp8b_comment);
            $ins->bindParam(47, $this->gp8c_rate);
            $ins->bindParam(48, $this->gp8c_comment);
            $ins->bindParam(49, $this->gp9a_rate);
            $ins->bindParam(50, $this->gp9a_comment);
            $ins->bindParam(51, $this->gp9b_rate);
            $ins->bindParam(52, $this->gp9b_comment);
            $ins->bindParam(53, $this->gp9c_rate);
            $ins->bindParam(54, $this->gp9c_comment);
            $ins->bindParam(55, $this->gp10a_rate);
            $ins->bindParam(56, $this->gp10a_comment);
            $ins->bindParam(57, $this->gp10b_rate);
            $ins->bindParam(58, $this->gp10b_comment);
            $ins->bindParam(59, $this->gp10c_rate);
            $ins->bindParam(60, $this->gp10c_comment);

            if($ins->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function upd_gp()
        {
            $query = "UPDATE ".$this->table_name." SET gp1a_rate=?, gp1a_comment=?, gp1b_rate=?, gp1b_comment=?, gp1c_rate=?, gp1c_comment=?, gp2a_rate=?, gp2a_comment=?, gp2b_rate=?, gp2b_comment=?, gp2c_rate=?, gp2c_comment=?, gp3a_rate=?, gp3a_comment=?, gp3b_rate=?, gp3b_comment=?, gp3c_rate=?, gp3c_comment=?, gp4a_rate=?, gp4a_comment=?, gp4b_rate=?, gp4b_comment=?, gp4c_rate=?, gp4c_comment=?, gp5a_rate=?, gp5a_comment=?, gp5b_rate=?, gp5b_comment=?, gp5c_rate=?, gp5c_comment=?, gp6a_rate=?, gp6a_comment=?, gp6b_rate=?, gp6b_comment=?, gp6c_rate=?, gp6c_comment=?, gp7a_rate=?, gp7a_comment=?, gp7b_rate=?, gp7b_comment=?, gp7c_rate=?, gp7c_comment=?, gp8a_rate=?, gp8a_comment=?, gp8b_rate=?, gp8b_comment=?, gp8c_rate=?, gp8c_comment=?, gp9a_rate=?, gp9a_comment=?, gp9b_rate=?, gp9b_comment=?, gp9c_rate=?, gp9c_comment=?, gp10a_rate=?, gp10a_comment=?, gp10b_rate=?, gp10b_comment=?, gp10c_rate=?, gp10c_comment=? WHERE gp_id=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $upd = $this->conn->prepare($query);

            $upd->bindParam(1, $this->gp1a_rate);
            $upd->bindParam(2, $this->gp1a_comment);
            $upd->bindParam(3, $this->gp1b_rate);
            $upd->bindParam(4, $this->gp1b_comment);
            $upd->bindParam(5, $this->gp1c_rate);
            $upd->bindParam(6, $this->gp1c_comment);
            $upd->bindParam(7, $this->gp2a_rate);
            $upd->bindParam(8, $this->gp2a_comment);
            $upd->bindParam(9, $this->gp2b_rate);
            $upd->bindParam(10, $this->gp2b_comment);
            $upd->bindParam(11, $this->gp2c_rate);
            $upd->bindParam(12, $this->gp2c_comment);
            $upd->bindParam(13, $this->gp3a_rate);
            $upd->bindParam(14, $this->gp3a_comment);
            $upd->bindParam(15, $this->gp3b_rate);
            $upd->bindParam(16, $this->gp3b_comment);
            $upd->bindParam(17, $this->gp3c_rate);
            $upd->bindParam(18, $this->gp3c_comment);
            $upd->bindParam(19, $this->gp4a_rate);
            $upd->bindParam(20, $this->gp4a_comment);
            $upd->bindParam(21, $this->gp4b_rate);
            $upd->bindParam(22, $this->gp4b_comment);
            $upd->bindParam(23, $this->gp4c_rate);
            $upd->bindParam(24, $this->gp4c_comment);
            $upd->bindParam(25, $this->gp5a_rate);
            $upd->bindParam(26, $this->gp5a_comment);
            $upd->bindParam(27, $this->gp5b_rate);
            $upd->bindParam(28, $this->gp5b_comment);
            $upd->bindParam(29, $this->gp5c_rate);
            $upd->bindParam(30, $this->gp5c_comment);
            $upd->bindParam(31, $this->gp6a_rate);
            $upd->bindParam(32, $this->gp6a_comment);
            $upd->bindParam(33, $this->gp6b_rate);
            $upd->bindParam(34, $this->gp6b_comment);
            $upd->bindParam(35, $this->gp6c_rate);
            $upd->bindParam(36, $this->gp6c_comment);
            $upd->bindParam(37, $this->gp7a_rate);           
            $upd->bindParam(38, $this->gp7a_comment);
            $upd->bindParam(39, $this->gp7b_rate);
            $upd->bindParam(40, $this->gp7b_comment);
            $upd->bindParam(41, $this->gp7c_rate);
            $upd->bindParam(42, $this->gp7c_comment);
            $upd->bindParam(43, $this->gp8a_rate);
            $upd->bindParam(44, $this->gp8a_comment);
            $upd->bindParam(45, $this->gp8b_rate);
            $upd->bindParam(46, $this->gp8b_comment);
            $upd->bindParam(47, $this->gp8c_rate);
            $upd->bindParam(48, $this->gp8c_comment);
            $upd->bindParam(49, $this->gp9a_rate);
            $upd->bindParam(50, $this->gp9a_comment);
            $upd->bindParam(51, $this->gp9b_rate);
            $upd->bindParam(52, $this->gp9b_comment);
            $upd->bindParam(53, $this->gp9c_rate);
            $upd->bindParam(54, $this->gp9c_comment);
            $upd->bindParam(55, $this->gp10a_rate);
            $upd->bindParam(56, $this->gp10a_comment);
            $upd->bindParam(57, $this->gp10b_rate);
            $upd->bindParam(58, $this->gp10b_comment);
            $upd->bindParam(59, $this->gp10c_rate);
            $upd->bindParam(60, $this->gp10c_comment);
            $upd->bindParam(61, $this->gp_id);

            if($upd->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function get_gp_last_id()
        {
            $query = "SELECT max(gp_id) + 1 as 'gp_id' FROM gen_performance";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sel = $this->conn->prepare($query);

            $sel->execute();
            return $sel;
        }

        public function save_supGP()
        {
            $query = "INSERT INTO sup_gp SET gp1a_rate=?, gp1a_comment=?, gp1b_rate=?, gp1b_comment=?, gp1c_rate=?, gp1c_comment=?, gp2a_rate=?, gp2a_comment=?, gp2b_rate=?, gp2b_comment=?, gp2c_rate=?, gp2c_comment=?, gp3a_rate=?, gp3a_comment=?, gp3b_rate=?, gp3b_comment=?, gp3c_rate=?, gp3c_comment=?, gp4a_rate=?, gp4a_comment=?, gp4b_rate=?, gp4b_comment=?, gp4c_rate=?, gp4c_comment=?, gp5a_rate=?, gp5a_comment=?, gp5b_rate=?, gp5b_comment=?, gp5c_rate=?, gp5c_comment=?, gp6a_rate=?, gp6a_comment=?, gp6b_rate=?, gp6b_comment=?, gp6c_rate=?, gp6c_comment=?, gp7a_rate=?, gp7a_comment=?, gp7b_rate=?, gp7b_comment=?, gp7c_rate=?, gp7c_comment=?, gp8a_rate=?, gp8a_comment=?, gp8b_rate=?, gp8b_comment=?, gp8c_rate=?, gp8c_comment=?, gp9a_rate=?, gp9a_comment=?, gp9b_rate=?, gp9b_comment=?, gp9c_rate=?, gp9c_comment=?, gp10a_rate=?, gp10a_comment=?, gp10b_rate=?, gp10b_comment=?, gp10c_rate=?, gp10c_comment=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $ins = $this->conn->prepare($query);

            $ins->bindParam(1, $this->gp1a_rate);
            $ins->bindParam(2, $this->gp1a_comment);
            $ins->bindParam(3, $this->gp1b_rate);
            $ins->bindParam(4, $this->gp1b_comment);
            $ins->bindParam(5, $this->gp1c_rate);
            $ins->bindParam(6, $this->gp1c_comment);
            $ins->bindParam(7, $this->gp2a_rate);
            $ins->bindParam(8, $this->gp2a_comment);
            $ins->bindParam(9, $this->gp2b_rate);
            $ins->bindParam(10, $this->gp2b_comment);
            $ins->bindParam(11, $this->gp2c_rate);
            $ins->bindParam(12, $this->gp2c_comment);
            $ins->bindParam(13, $this->gp3a_rate);
            $ins->bindParam(14, $this->gp3a_comment);
            $ins->bindParam(15, $this->gp3b_rate);
            $ins->bindParam(16, $this->gp3b_comment);
            $ins->bindParam(17, $this->gp3c_rate);
            $ins->bindParam(18, $this->gp3c_comment);
            $ins->bindParam(19, $this->gp4a_rate);
            $ins->bindParam(20, $this->gp4a_comment);
            $ins->bindParam(21, $this->gp4b_rate);
            $ins->bindParam(22, $this->gp4b_comment);
            $ins->bindParam(23, $this->gp4c_rate);
            $ins->bindParam(24, $this->gp4c_comment);
            $ins->bindParam(25, $this->gp5a_rate);
            $ins->bindParam(26, $this->gp5a_comment);
            $ins->bindParam(27, $this->gp5b_rate);
            $ins->bindParam(28, $this->gp5b_comment);
            $ins->bindParam(29, $this->gp5c_rate);
            $ins->bindParam(30, $this->gp5c_comment);
            $ins->bindParam(31, $this->gp6a_rate);
            $ins->bindParam(32, $this->gp6a_comment);
            $ins->bindParam(33, $this->gp6b_rate);
            $ins->bindParam(34, $this->gp6b_comment);
            $ins->bindParam(35, $this->gp6c_rate);
            $ins->bindParam(36, $this->gp6c_comment);
            $ins->bindParam(37, $this->gp7a_rate);           
            $ins->bindParam(38, $this->gp7a_comment);
            $ins->bindParam(39, $this->gp7b_rate);
            $ins->bindParam(40, $this->gp7b_comment);
            $ins->bindParam(41, $this->gp7c_rate);
            $ins->bindParam(42, $this->gp7c_comment);
            $ins->bindParam(43, $this->gp8a_rate);
            $ins->bindParam(44, $this->gp8a_comment);
            $ins->bindParam(45, $this->gp8b_rate);
            $ins->bindParam(46, $this->gp8b_comment);
            $ins->bindParam(47, $this->gp8c_rate);
            $ins->bindParam(48, $this->gp8c_comment);
            $ins->bindParam(49, $this->gp9a_rate);
            $ins->bindParam(50, $this->gp9a_comment);
            $ins->bindParam(51, $this->gp9b_rate);
            $ins->bindParam(52, $this->gp9b_comment);
            $ins->bindParam(53, $this->gp9c_rate);
            $ins->bindParam(54, $this->gp9c_comment);
            $ins->bindParam(55, $this->gp10a_rate);
            $ins->bindParam(56, $this->gp10a_comment);
            $ins->bindParam(57, $this->gp10b_rate);
            $ins->bindParam(58, $this->gp10b_comment);
            $ins->bindParam(59, $this->gp10c_rate);
            $ins->bindParam(60, $this->gp10c_comment);

            if($ins->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function upd_supGP()
        {
            $query = "UPDATE sup_gp SET gp1a_rate=?, gp1a_comment=?, gp1b_rate=?, gp1b_comment=?, gp1c_rate=?, gp1c_comment=?, gp2a_rate=?, gp2a_comment=?, gp2b_rate=?, gp2b_comment=?, gp2c_rate=?, gp2c_comment=?, gp3a_rate=?, gp3a_comment=?, gp3b_rate=?, gp3b_comment=?, gp3c_rate=?, gp3c_comment=?, gp4a_rate=?, gp4a_comment=?, gp4b_rate=?, gp4b_comment=?, gp4c_rate=?, gp4c_comment=?, gp5a_rate=?, gp5a_comment=?, gp5b_rate=?, gp5b_comment=?, gp5c_rate=?, gp5c_comment=?, gp6a_rate=?, gp6a_comment=?, gp6b_rate=?, gp6b_comment=?, gp6c_rate=?, gp6c_comment=?, gp7a_rate=?, gp7a_comment=?, gp7b_rate=?, gp7b_comment=?, gp7c_rate=?, gp7c_comment=?, gp8a_rate=?, gp8a_comment=?, gp8b_rate=?, gp8b_comment=?, gp8c_rate=?, gp8c_comment=?, gp9a_rate=?, gp9a_comment=?, gp9b_rate=?, gp9b_comment=?, gp9c_rate=?, gp9c_comment=?, gp10a_rate=?, gp10a_comment=?, gp10b_rate=?, gp10b_comment=?, gp10c_rate=?, gp10c_comment=? WHERE gp_id=?";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $upd = $this->conn->prepare($query);

            $upd->bindParam(1, $this->gp1a_rate);
            $upd->bindParam(2, $this->gp1a_comment);
            $upd->bindParam(3, $this->gp1b_rate);
            $upd->bindParam(4, $this->gp1b_comment);
            $upd->bindParam(5, $this->gp1c_rate);
            $upd->bindParam(6, $this->gp1c_comment);
            $upd->bindParam(7, $this->gp2a_rate);
            $upd->bindParam(8, $this->gp2a_comment);
            $upd->bindParam(9, $this->gp2b_rate);
            $upd->bindParam(10, $this->gp2b_comment);
            $upd->bindParam(11, $this->gp2c_rate);
            $upd->bindParam(12, $this->gp2c_comment);
            $upd->bindParam(13, $this->gp3a_rate);
            $upd->bindParam(14, $this->gp3a_comment);
            $upd->bindParam(15, $this->gp3b_rate);
            $upd->bindParam(16, $this->gp3b_comment);
            $upd->bindParam(17, $this->gp3c_rate);
            $upd->bindParam(18, $this->gp3c_comment);
            $upd->bindParam(19, $this->gp4a_rate);
            $upd->bindParam(20, $this->gp4a_comment);
            $upd->bindParam(21, $this->gp4b_rate);
            $upd->bindParam(22, $this->gp4b_comment);
            $upd->bindParam(23, $this->gp4c_rate);
            $upd->bindParam(24, $this->gp4c_comment);
            $upd->bindParam(25, $this->gp5a_rate);
            $upd->bindParam(26, $this->gp5a_comment);
            $upd->bindParam(27, $this->gp5b_rate);
            $upd->bindParam(28, $this->gp5b_comment);
            $upd->bindParam(29, $this->gp5c_rate);
            $upd->bindParam(30, $this->gp5c_comment);
            $upd->bindParam(31, $this->gp6a_rate);
            $upd->bindParam(32, $this->gp6a_comment);
            $upd->bindParam(33, $this->gp6b_rate);
            $upd->bindParam(34, $this->gp6b_comment);
            $upd->bindParam(35, $this->gp6c_rate);
            $upd->bindParam(36, $this->gp6c_comment);
            $upd->bindParam(37, $this->gp7a_rate);           
            $upd->bindParam(38, $this->gp7a_comment);
            $upd->bindParam(39, $this->gp7b_rate);
            $upd->bindParam(40, $this->gp7b_comment);
            $upd->bindParam(41, $this->gp7c_rate);
            $upd->bindParam(42, $this->gp7c_comment);
            $upd->bindParam(43, $this->gp8a_rate);
            $upd->bindParam(44, $this->gp8a_comment);
            $upd->bindParam(45, $this->gp8b_rate);
            $upd->bindParam(46, $this->gp8b_comment);
            $upd->bindParam(47, $this->gp8c_rate);
            $upd->bindParam(48, $this->gp8c_comment);
            $upd->bindParam(49, $this->gp9a_rate);
            $upd->bindParam(50, $this->gp9a_comment);
            $upd->bindParam(51, $this->gp9b_rate);
            $upd->bindParam(52, $this->gp9b_comment);
            $upd->bindParam(53, $this->gp9c_rate);
            $upd->bindParam(54, $this->gp9c_comment);
            $upd->bindParam(55, $this->gp10a_rate);
            $upd->bindParam(56, $this->gp10a_comment);
            $upd->bindParam(57, $this->gp10b_rate);
            $upd->bindParam(58, $this->gp10b_comment);
            $upd->bindParam(59, $this->gp10c_rate);
            $upd->bindParam(60, $this->gp10c_comment);
            $upd->bindParam(61, $this->gp_id);

            if($upd->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function get_supGP_last_id()
        {
            $query = "SELECT max(gp_id) + 1 as 'gp_id' FROM sup_gp";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sel = $this->conn->prepare($query);

            $sel->execute();
            return $sel;
        }
    }
?>