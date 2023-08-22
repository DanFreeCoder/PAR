<?php
class ParDetails
{
    private $conn;
    private $table_name = "par_details";

    public $emp_name;
    public $position;
    public $department;
    public $project;
    public $emp_status;
    public $assessment;
    public $review_from;
    public $review_to;
    public $date_hire;
    public $rater;
    public $emp_email;
    public $kra_total;
    public $gp_total;
    public $kra_average;
    public $gp_average;
    public $oap_total;
    public $oap_scale;
    public $accomplishment;
    public $prof_dev;
    public $prof_others;
    public $emp_comment;
    public $date_submit;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function save_details()
    {
        $query = "INSERT INTO " . $this->table_name . " SET kra_id=?, gp_id=?, pip_id=?, sup_id=0, emp_id=?, emp_name=?, position=?, department=?, project=?, emp_status=?, assessment=?, review_from=?, review_to=?, date_hire=?, rater=?, rater_name=?, emp_email=?, kra_total=?, gp_total=?, kra_average=?, gp_average=?, oap_total=?, oap_scale=?, accomplishment=?, prof_dev=?, prof_others=?, emp_comment=?, date_submit=?, par_status=?";
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->conn->prepare($query);

        $ins->bindParam(1, $this->kra_id);
        $ins->bindParam(2, $this->gp_id);
        $ins->bindParam(3, $this->pip_id);
        $ins->bindParam(4, $this->emp_id);
        $ins->bindParam(5, $this->emp_name);
        $ins->bindParam(6, $this->position);
        $ins->bindParam(7, $this->department);
        $ins->bindParam(8, $this->project);
        $ins->bindParam(9, $this->emp_status);
        $ins->bindParam(10, $this->assessment);
        $ins->bindParam(11, $this->review_from);
        $ins->bindParam(12, $this->review_to);
        $ins->bindParam(13, $this->date_hire);
        $ins->bindParam(14, $this->rater);
        $ins->bindParam(15, $this->rater_name);
        $ins->bindParam(16, $this->emp_email);
        $ins->bindParam(17, $this->kra_total);
        $ins->bindParam(18, $this->gp_total);
        $ins->bindParam(19, $this->kra_average);
        $ins->bindParam(20, $this->gp_average);
        $ins->bindParam(21, $this->oap_total);
        $ins->bindParam(22, $this->oap_scale);
        $ins->bindParam(23, $this->accomplishment);
        $ins->bindParam(24, $this->prof_dev);
        $ins->bindParam(25, $this->prof_others);
        $ins->bindParam(26, $this->emp_comment);
        $ins->bindParam(27, $this->date_submit);
        $ins->bindParam(28, $this->status);
        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function view_par()
    {
        $query = 'SELECT par_details.id, par_details.sup_id, par_details.emp_name, par_details.date_submit, par_details.par_status, par_details.rater_name, CONCAT(users.firstname, " ", users.lastname) as "reviewer", department.department as "dept-name" FROM par_details, users, department WHERE par_details.rater_name = users.id AND par_details.department = department.id AND par_details.par_status = 1  AND par_details.par_status != 0';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    public function view_par_byID()
    {
        $query = 'SELECT * FROM par_details, pip, kra_kpi, gen_performance WHERE par_details.kra_id = kra_kpi.kra_id AND par_details.gp_id = gen_performance.gp_id AND par_details.pip_id = pip.pip_id AND par_details.id = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    public function view_uneval_par_approver1()
    {
        $query = 'SELECT par_details.id, par_details.emp_name, par_details.department, par_details.date_submit, par_details.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM par_details, department, users WHERE par_details.department = department.id AND par_details.rater_name = users.id AND par_details.rater_name = ? AND par_details.par_status = 1 ORDER BY par_details.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->rater_name);

        $sel->execute();
        return $sel;
    }
    public function view_uneval_par_approver1_forHR()
    {
        $query = 'SELECT par_details.id, par_details.emp_name, par_details.department, par_details.date_submit, par_details.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM par_details, department, users WHERE par_details.department = department.id AND par_details.rater_name = users.id AND par_details.par_status = 1 AND users.role = 1 ORDER BY par_details.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    public function view_eval_par()
    {
        $query = 'SELECT sup_par.id as "sup_par_id", sup_par.par_id as "par_id", sup_par.emp_name, sup_par.department, sup_par.date_evaluated, sup_par.eval_by, sup_par.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "fullname" FROM sup_par, department, users WHERE sup_par.department=department.id AND sup_par.eval_by=users.id AND sup_par.par_status != 0';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    public function view_eval_par_approver1()
    {
        $query = 'SELECT sup_par.id as "sup_par_id", sup_par.par_id as "par_id", sup_par.emp_name, sup_par.department, sup_par.date_evaluated, sup_par.eval_by, sup_par.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "fullname" FROM sup_par, department, users WHERE sup_par.department=department.id AND sup_par.eval_by=users.id AND sup_par.eval_by = ? AND sup_par.department = ? AND (find_in_set(2, sup_par.par_status) || find_in_set(3, sup_par.par_status) || find_in_set(4, sup_par.par_status))';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->eval_by);
        $sel->bindParam(2, $this->department);

        $sel->execute();
        return $sel;
    }

    public function view_uneval_par_approver2()
    {
        $query = 'SELECT par_details.id, par_details.emp_name, par_details.department, par_details.date_submit, par_details.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM par_details, department, users WHERE par_details.department = department.id AND par_details.rater_name = users.id AND par_details.rater_name = ? AND par_details.department = ? AND par_details.par_status = 1 ORDER BY par_details.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->rater_name);
        $sel->bindParam(2, $this->department);

        $sel->execute();
        return $sel;
    }
    public function view_uneval_par_approver2_forHR()
    {
        $query = 'SELECT par_details.id, par_details.emp_name, par_details.department, par_details.date_submit, par_details.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM par_details, department, users WHERE par_details.department = department.id AND par_details.rater_name = users.id AND par_details.par_status = 1 AND users.role = 2 ORDER BY par_details.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    public function view_eval_par_approver2()
    {
        $query = 'SELECT sup_par.id as "sup_par_id", sup_par.par_id as "par_id", sup_par.emp_name, sup_par.department, sup_par.date_evaluated, sup_par.eval_by, sup_par.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "fullname" FROM sup_par, department, users WHERE sup_par.department=department.id AND sup_par.eval_by=users.id AND sup_par.department = ? AND sup_par.project = ? AND (find_in_set(2, sup_par.par_status) || find_in_set(3, sup_par.par_status) || find_in_set(4, sup_par.par_status) || find_in_set(?, sup_par.eval_by)) AND sup_par.eval_by != 2 AND sup_par.par_status != 0';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->department);
        $sel->bindParam(2, $this->project);
        $sel->bindParam(3, $this->eval_by);

        $sel->execute();
        return $sel;
    }

    public function view_uneval_par_manager()
    {
        $query = 'SELECT par_details.id, par_details.emp_name, par_details.department, par_details.date_submit, par_details.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM par_details, department, users WHERE par_details.department = department.id AND par_details.rater_name = users.id AND par_details.rater_name = ? AND par_details.par_status = 1 ORDER BY par_details.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->rater_name);
        //$sel->bindParam(2, $this->department);

        $sel->execute();
        return $sel;
    }
    public function view_uneval_par_manager_forHR()
    {
        $query = 'SELECT par_details.id, par_details.emp_name, par_details.department, par_details.date_submit, par_details.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM par_details, department, users WHERE par_details.department = department.id AND par_details.rater_name = users.id AND par_details.par_status = 1 AND users.role = 3 ORDER BY par_details.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);


        $sel->execute();
        return $sel;
    }

    public function view_eval_par_manager()
    {
        $query = 'SELECT sup_par.id as "sup_par_id", sup_par.par_id as "par_id", sup_par.emp_name, sup_par.department, sup_par.date_evaluated, sup_par.eval_by, department.department as "dept-name", sup_par.par_status, CONCAT(users.firstname, " ", users.lastname) as "fullname" FROM sup_par, department, users WHERE sup_par.department=department.id AND sup_par.eval_by=users.id AND sup_par.department = ? AND (find_in_set(2, sup_par.par_status) || find_in_set(3, sup_par.par_status)) AND sup_par.par_status != 0';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        //$sel->bindParam(1, $this->eval_by);
        $sel->bindParam(1, $this->department);

        $sel->execute();
        return $sel;
    }

    public function view_eval_approved_manager()
    {
        $query = 'SELECT sup_par.id as "sup_par_id", sup_par.par_id as "par_id", sup_par.emp_name, sup_par.department, sup_par.date_evaluated, sup_par.eval_by, department.department as "dept-name", sup_par.par_status, CONCAT(users.firstname, " ", users.lastname) as "fullname" FROM sup_par, department, users WHERE sup_par.department=department.id AND sup_par.eval_by=users.id AND sup_par.department = ? AND sup_par.par_status = 4 AND sup_par.eval_by != 2 ORDER BY sup_par.date_evaluated DESC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->department);

        $sel->execute();
        return $sel;
    }
    public function view_eval_approved_manager_forHR()
    {
        $query = 'SELECT sup_par.id as "sup_par_id", sup_par.par_id as "par_id", sup_par.emp_name, sup_par.department, sup_par.date_evaluated, sup_par.eval_by, department.department as "dept-name", sup_par.par_status, CONCAT(users.firstname, " ", users.lastname) as "fullname" FROM sup_par, department, users WHERE sup_par.department=department.id AND sup_par.eval_by= users.id AND sup_par.par_status = 4 ORDER BY sup_par.date_evaluated DESC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    public function get_last_id()
    {
        $query = "SELECT max(id) as 'par_id' FROM par_details";
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    public function save_supPAR()
    {
        $query = "INSERT INTO sup_par SET par_id=?, kra_id=?, gp_id=?, pip_id=?, emp_name=?, position=?, department=?, project=?, emp_status=?, assessment=?, review_from=?, review_to=?, date_hire=?, rater=?, rater_name=?, emp_email=?, kra_total=?, gp_total=?, kra_average=?, gp_average=?, oap_total=?, oap_scale=?, accomplishment=?, prof_dev=?, prof_others=?, emp_comment=?, recommendation=?, gross=?, remarks=?, date_submit=?, date_evaluated=?, eval_by=?, par_status=?";
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->conn->prepare($query);

        $ins->bindParam(1, $this->par_id);
        $ins->bindParam(2, $this->kra_id);
        $ins->bindParam(3, $this->gp_id);
        $ins->bindParam(4, $this->pip_id);
        $ins->bindParam(5, $this->emp_name);
        $ins->bindParam(6, $this->position);
        $ins->bindParam(7, $this->department);
        $ins->bindParam(8, $this->project);
        $ins->bindParam(9, $this->emp_status);
        $ins->bindParam(10, $this->assessment);
        $ins->bindParam(11, $this->review_from);
        $ins->bindParam(12, $this->review_to);
        $ins->bindParam(13, $this->date_hire);
        $ins->bindParam(14, $this->rater);
        $ins->bindParam(15, $this->rater_name);
        $ins->bindParam(16, $this->emp_email);
        $ins->bindParam(17, $this->kra_total);
        $ins->bindParam(18, $this->gp_total);
        $ins->bindParam(19, $this->kra_average);
        $ins->bindParam(20, $this->gp_average);
        $ins->bindParam(21, $this->oap_total);
        $ins->bindParam(22, $this->oap_scale);
        $ins->bindParam(23, $this->accomplishment);
        $ins->bindParam(24, $this->prof_dev);
        $ins->bindParam(25, $this->prof_others);
        $ins->bindParam(26, $this->emp_comment);
        $ins->bindParam(27, $this->recommendation);
        $ins->bindParam(28, $this->gross);
        $ins->bindParam(29, $this->remarks);
        $ins->bindParam(30, $this->date_submit);
        $ins->bindParam(31, $this->date_evaluated);
        $ins->bindParam(32, $this->eval_by);
        $ins->bindParam(33, $this->par_status);

        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function upd_supPAR()
    {
        $query = "UPDATE sup_par SET rater_name=?, kra_total=?, gp_total=?, kra_average=?, gp_average=?, oap_total=?, oap_scale=?, accomplishment=?, prof_dev=?, prof_others=?, emp_comment=?, recommendation=?, gross=?, remarks=?, date_submit=?, date_evaluated=?, eval_by=?, par_status=? WHERE id = ?";
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->rater_name);
        $upd->bindParam(2, $this->kra_total);
        $upd->bindParam(3, $this->gp_total);
        $upd->bindParam(4, $this->kra_average);
        $upd->bindParam(5, $this->gp_average);
        $upd->bindParam(6, $this->oap_total);
        $upd->bindParam(7, $this->oap_scale);
        $upd->bindParam(8, $this->accomplishment);
        $upd->bindParam(9, $this->prof_dev);
        $upd->bindParam(10, $this->prof_others);
        $upd->bindParam(11, $this->emp_comment);
        $upd->bindParam(12, $this->recommendation);
        $upd->bindParam(13, $this->gross);
        $upd->bindParam(14, $this->remarks);
        $upd->bindParam(15, $this->date_submit);
        $upd->bindParam(16, $this->date_evaluated);
        $upd->bindParam(17, $this->eval_by);
        $upd->bindParam(18, $this->par_status);
        $upd->bindParam(19, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function upd_stat()
    {
        $query = 'UPDATE ' . $this->table_name . ' SET sup_id=?, par_status = 2 WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->sup_id);
        $upd->bindParam(2, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function upd_sup_stat()
    {
        $query = 'UPDATE sup_par SET rater_name=?, par_status = 3 WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->rater_name);
        $upd->bindParam(2, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function get_par_status()
    {
        $query = 'SELECT sup_id, par_status FROM ' . $this->table_name . ' WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    function check_sup_par_exist()
    {
        $query = 'SELECT COUNT(id) as "count" FROM sup_par WHERE id=? AND par_status != 0';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    function get_evaluated_par()
    {
        $query = 'SELECT sup_par.id as "sup-id", sup_par.par_id as "details_id", sup_par.emp_name, sup_par.position, sup_par.department, sup_par.project, sup_par.emp_status, sup_par.assessment, sup_par.review_from, sup_par.review_to, sup_par.date_hire, sup_par.rater, sup_par.rater_name as "rater_id", sup_par.emp_email, sup_par.kra_total, sup_par.gp_total, sup_par.kra_average, sup_par.gp_average, sup_par.oap_total, sup_par.oap_scale, sup_par.accomplishment, sup_par.prof_dev, sup_par.prof_others, sup_par.emp_comment, sup_par.recommendation, sup_par.gross, sup_par.remarks, sup_par.par_status, sup_par.declined, units.unit_name, sup_kra.kra_id, sup_kra.kra1, sup_kra.kpi1, sup_kra.rate1, sup_kra.comments1, sup_kra.sup_com1, sup_kra.kra2, sup_kra.kpi2, sup_kra.rate2, sup_kra.comments2, sup_kra.sup_com2, sup_kra.kra3, sup_kra.kpi3, sup_kra.rate3, sup_kra.comments3, sup_kra.sup_com3, sup_kra.kra4, sup_kra.kpi4, sup_kra.rate4, sup_kra.comments4, sup_kra.sup_com4, sup_kra.kra5, sup_kra.kpi5, sup_kra.rate5, sup_kra.comments5, sup_kra.sup_com5, sup_kra.kra6, sup_kra.kpi6, sup_kra.rate6, sup_kra.comments6, sup_kra.sup_com6, sup_gp.gp_id, sup_gp.gp1a_rate, sup_gp.gp1a_comment, sup_gp.gp1b_rate, sup_gp.gp1b_comment, sup_gp.gp1c_rate, sup_gp.gp1c_comment, sup_gp.gp2a_rate, sup_gp.gp2a_comment, sup_gp.gp2b_rate, sup_gp.gp2b_comment, sup_gp.gp2c_rate, sup_gp.gp2c_comment, sup_gp.gp3a_rate, sup_gp.gp3a_comment, sup_gp.gp3b_rate, sup_gp.gp3b_comment, sup_gp.gp3c_rate, sup_gp.gp3c_comment, sup_gp.gp4a_rate, sup_gp.gp4a_comment, sup_gp.gp4b_rate, sup_gp.gp4b_comment, sup_gp.gp4c_rate, sup_gp.gp4c_comment, sup_gp.gp5a_rate, sup_gp.gp5a_comment, sup_gp.gp5b_rate, sup_gp.gp5b_comment, sup_gp.gp5c_rate, sup_gp.gp5c_comment, sup_gp.gp6a_rate, sup_gp.gp6a_comment, sup_gp.gp6b_rate, sup_gp.gp6b_comment, sup_gp.gp6c_rate, sup_gp.gp6c_comment, sup_gp.gp7a_rate, sup_gp.gp7a_comment, sup_gp.gp7b_rate, sup_gp.gp7b_comment, sup_gp.gp7c_rate, sup_gp.gp7c_comment, sup_gp.gp8a_rate, sup_gp.gp8a_comment, sup_gp.gp8b_rate, sup_gp.gp8b_comment, sup_gp.gp8c_rate, sup_gp.gp8c_comment, sup_gp.gp9a_rate, sup_gp.gp9a_comment, sup_gp.gp9b_rate, sup_gp.gp9b_comment, sup_gp.gp9c_rate, sup_gp.gp9c_comment, sup_gp.gp10a_rate, sup_gp.gp10a_comment, sup_gp.gp10b_rate, sup_gp.gp10b_comment, sup_gp.gp10c_rate, sup_gp.gp10c_comment, sup_pip.pip_id, sup_pip.pin1, sup_pip.at1, sup_pip.sn1, sup_pip.time1, sup_pip.pin2, sup_pip.at2, sup_pip.sn2, sup_pip.time2, sup_pip.pin3, sup_pip.at3, sup_pip.sn3, sup_pip.time3, users.id, CONCAT(users.firstname, " ", users.lastname) as "rater_fullname", department.department as "dept-name" FROM sup_par, sup_kra, sup_gp, sup_pip, users, department, units WHERE sup_par.kra_id = sup_kra.kra_id AND sup_par.gp_id = sup_gp.gp_id AND sup_par.pip_id = sup_pip.pip_id AND sup_par.rater_name = users.id AND sup_par.department = department.id AND sup_par.project = units.id AND sup_par.par_status != 0 AND sup_par.par_status != 1 AND sup_par.par_id = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->par_id);

        $sel->execute();
        return $sel;
    }

    function get_evaluated_par_details()
    {
        $query = 'SELECT sup_par.id as "sup-id", sup_par.par_id as "details_id", sup_par.kra_id, sup_par.gp_id, sup_par.pip_id, sup_par.emp_name, sup_par.position, sup_par.department, sup_par.project, sup_par.emp_status, sup_par.assessment, sup_par.review_from, sup_par.review_to, sup_par.date_hire, sup_par.rater, sup_par.rater_name as "rater_id", sup_par.emp_email, sup_par.kra_total, sup_par.gp_total, sup_par.kra_average, sup_par.gp_average, sup_par.oap_total, sup_par.oap_scale, sup_par.accomplishment, sup_par.prof_dev, sup_par.prof_others, sup_par.emp_comment, sup_par.recommendation, sup_par.gross, sup_par.remarks, sup_par.par_status, sup_kra.kra_id, sup_kra.kra1, sup_kra.kpi1, sup_kra.rate1, sup_kra.comments1, sup_kra.sup_com1, sup_kra.kra2, sup_kra.kpi2, sup_kra.rate2, sup_kra.comments2, sup_kra.sup_com2, sup_kra.kra3, sup_kra.kpi3, sup_kra.rate3, sup_kra.comments3, sup_kra.sup_com3, sup_kra.kra4, sup_kra.kpi4, sup_kra.rate4, sup_kra.comments4, sup_kra.sup_com4, sup_kra.kra5, sup_kra.kpi5, sup_kra.rate5, sup_kra.comments5, sup_kra.sup_com5, sup_kra.kra6, sup_kra.kpi6, sup_kra.rate6, sup_kra.comments6, sup_kra.sup_com6, sup_gp.gp_id, sup_gp.gp1a_rate, sup_gp.gp1a_comment, sup_gp.gp1b_rate, sup_gp.gp1b_comment, sup_gp.gp1c_rate, sup_gp.gp1c_comment, sup_gp.gp2a_rate, sup_gp.gp2a_comment, sup_gp.gp2b_rate, sup_gp.gp2b_comment, sup_gp.gp2c_rate, sup_gp.gp2c_comment, sup_gp.gp3a_rate, sup_gp.gp3a_comment, sup_gp.gp3b_rate, sup_gp.gp3b_comment, sup_gp.gp3c_rate, sup_gp.gp3c_comment, sup_gp.gp4a_rate, sup_gp.gp4a_comment, sup_gp.gp4b_rate, sup_gp.gp4b_comment, sup_gp.gp4c_rate, sup_gp.gp4c_comment, sup_gp.gp5a_rate, sup_gp.gp5a_comment, sup_gp.gp5b_rate, sup_gp.gp5b_comment, sup_gp.gp5c_rate, sup_gp.gp5c_comment, sup_gp.gp6a_rate, sup_gp.gp6a_comment, sup_gp.gp6b_rate, sup_gp.gp6b_comment, sup_gp.gp6c_rate, sup_gp.gp6c_comment, sup_gp.gp7a_rate, sup_gp.gp7a_comment, sup_gp.gp7b_rate, sup_gp.gp7b_comment, sup_gp.gp7c_rate, sup_gp.gp7c_comment, sup_gp.gp8a_rate, sup_gp.gp8a_comment, sup_gp.gp8b_rate, sup_gp.gp8b_comment, sup_gp.gp8c_rate, sup_gp.gp8c_comment, sup_gp.gp9a_rate, sup_gp.gp9a_comment, sup_gp.gp9b_rate, sup_gp.gp9b_comment, sup_gp.gp9c_rate, sup_gp.gp9c_comment, sup_gp.gp10a_rate, sup_gp.gp10a_comment, sup_gp.gp10b_rate, sup_gp.gp10b_comment, sup_gp.gp10c_rate, sup_gp.gp10c_comment, sup_pip.pip_id, sup_pip.pin1, sup_pip.at1, sup_pip.sn1, sup_pip.time1, sup_pip.pin2, sup_pip.at2, sup_pip.sn2, sup_pip.time2, sup_pip.pin3, sup_pip.at3, sup_pip.sn3, sup_pip.time3, users.id, CONCAT(users.firstname, " ", users.lastname) as "rater_fullname", department.department as "dept-name" FROM sup_par, sup_kra, sup_gp, sup_pip, users, department WHERE sup_par.kra_id = sup_kra.kra_id AND sup_par.gp_id = sup_gp.gp_id AND sup_par.pip_id = sup_pip.pip_id AND sup_par.rater_name = users.id AND sup_par.department = department.id AND sup_par.par_status != 0 AND sup_par.par_status != 1 AND sup_par.par_id = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->par_id);

        $sel->execute();
        return $sel;
    }
    function get_draft_par_details()
    {
        $query = 'SELECT sup_par.id as "sup-id", sup_par.par_id as "details_id", sup_par.kra_id, sup_par.gp_id, sup_par.pip_id, sup_par.emp_name, sup_par.position, sup_par.department, sup_par.project, sup_par.emp_status, sup_par.assessment, sup_par.review_from, sup_par.review_to, sup_par.date_hire, sup_par.rater, sup_par.rater_name as "rater_id", sup_par.emp_email, sup_par.kra_total, sup_par.gp_total, sup_par.kra_average, sup_par.gp_average, sup_par.oap_total, sup_par.oap_scale, sup_par.accomplishment, sup_par.prof_dev, sup_par.prof_others, sup_par.emp_comment, sup_par.recommendation, sup_par.gross, sup_par.remarks, sup_par.par_status, sup_kra.kra_id, sup_kra.kra1, sup_kra.kpi1, sup_kra.rate1, sup_kra.comments1, sup_kra.sup_com1, sup_kra.kra2, sup_kra.kpi2, sup_kra.rate2, sup_kra.comments2, sup_kra.sup_com2, sup_kra.kra3, sup_kra.kpi3, sup_kra.rate3, sup_kra.comments3, sup_kra.sup_com3, sup_kra.kra4, sup_kra.kpi4, sup_kra.rate4, sup_kra.comments4, sup_kra.sup_com4, sup_kra.kra5, sup_kra.kpi5, sup_kra.rate5, sup_kra.comments5, sup_kra.sup_com5, sup_kra.kra6, sup_kra.kpi6, sup_kra.rate6, sup_kra.comments6, sup_kra.sup_com6, sup_gp.gp_id, sup_gp.gp1a_rate, sup_gp.gp1a_comment, sup_gp.gp1b_rate, sup_gp.gp1b_comment, sup_gp.gp1c_rate, sup_gp.gp1c_comment, sup_gp.gp2a_rate, sup_gp.gp2a_comment, sup_gp.gp2b_rate, sup_gp.gp2b_comment, sup_gp.gp2c_rate, sup_gp.gp2c_comment, sup_gp.gp3a_rate, sup_gp.gp3a_comment, sup_gp.gp3b_rate, sup_gp.gp3b_comment, sup_gp.gp3c_rate, sup_gp.gp3c_comment, sup_gp.gp4a_rate, sup_gp.gp4a_comment, sup_gp.gp4b_rate, sup_gp.gp4b_comment, sup_gp.gp4c_rate, sup_gp.gp4c_comment, sup_gp.gp5a_rate, sup_gp.gp5a_comment, sup_gp.gp5b_rate, sup_gp.gp5b_comment, sup_gp.gp5c_rate, sup_gp.gp5c_comment, sup_gp.gp6a_rate, sup_gp.gp6a_comment, sup_gp.gp6b_rate, sup_gp.gp6b_comment, sup_gp.gp6c_rate, sup_gp.gp6c_comment, sup_gp.gp7a_rate, sup_gp.gp7a_comment, sup_gp.gp7b_rate, sup_gp.gp7b_comment, sup_gp.gp7c_rate, sup_gp.gp7c_comment, sup_gp.gp8a_rate, sup_gp.gp8a_comment, sup_gp.gp8b_rate, sup_gp.gp8b_comment, sup_gp.gp8c_rate, sup_gp.gp8c_comment, sup_gp.gp9a_rate, sup_gp.gp9a_comment, sup_gp.gp9b_rate, sup_gp.gp9b_comment, sup_gp.gp9c_rate, sup_gp.gp9c_comment, sup_gp.gp10a_rate, sup_gp.gp10a_comment, sup_gp.gp10b_rate, sup_gp.gp10b_comment, sup_gp.gp10c_rate, sup_gp.gp10c_comment, sup_pip.pip_id, sup_pip.pin1, sup_pip.at1, sup_pip.sn1, sup_pip.time1, sup_pip.pin2, sup_pip.at2, sup_pip.sn2, sup_pip.time2, sup_pip.pin3, sup_pip.at3, sup_pip.sn3, sup_pip.time3, users.id, CONCAT(users.firstname, " ", users.lastname) as "rater_fullname", department.department as "dept-name" FROM sup_par, sup_kra, sup_gp, sup_pip, users, department WHERE sup_par.kra_id = sup_kra.kra_id AND sup_par.gp_id = sup_gp.gp_id AND sup_par.pip_id = sup_pip.pip_id AND sup_par.rater_name = users.id AND sup_par.department = department.id AND sup_par.par_status != 0 AND sup_par.par_status = 1 AND sup_par.par_id = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->par_id);

        $sel->execute();
        return $sel;
    }

    function get_evaluated_par_for_print()
    {
        $query = 'SELECT sup_par.id as "sup-id", sup_par.par_id as "details_id", sup_par.emp_name, sup_par.position, sup_par.department, sup_par.project, sup_par.emp_status, sup_par.assessment, sup_par.review_from, sup_par.review_to, sup_par.date_hire, sup_par.rater, sup_par.rater_name as "rater_id", sup_par.emp_email, sup_par.kra_total, sup_par.gp_total, sup_par.kra_average, sup_par.gp_average, sup_par.oap_total, sup_par.oap_scale, sup_par.accomplishment, sup_par.prof_dev, sup_par.prof_others, sup_par.emp_comment, sup_par.recommendation, sup_par.gross, sup_par.remarks, sup_par.par_status, sup_kra.kra_id, sup_kra.kra1, sup_kra.kpi1, sup_kra.rate1, sup_kra.comments1, sup_kra.kra2, sup_kra.kpi2, sup_kra.rate2, sup_kra.comments2, sup_kra.kra3, sup_kra.kpi3, sup_kra.rate3, sup_kra.comments3, sup_kra.kra4, sup_kra.kpi4, sup_kra.rate4, sup_kra.comments4, sup_kra.kra5, sup_kra.kpi5, sup_kra.rate5, sup_kra.comments5, sup_gp.gp_id, sup_gp.gp1a_rate, sup_gp.gp1a_comment, sup_gp.gp1b_rate, sup_gp.gp1b_comment, sup_gp.gp1c_rate, sup_gp.gp1c_comment, sup_gp.gp2a_rate, sup_gp.gp2a_comment, sup_gp.gp2b_rate, sup_gp.gp2b_comment, sup_gp.gp2c_rate, sup_gp.gp2c_comment, sup_gp.gp3a_rate, sup_gp.gp3a_comment, sup_gp.gp3b_rate, sup_gp.gp3b_comment, sup_gp.gp3c_rate, sup_gp.gp3c_comment, sup_gp.gp4a_rate, sup_gp.gp4a_comment, sup_gp.gp4b_rate, sup_gp.gp4b_comment, sup_gp.gp4c_rate, sup_gp.gp4c_comment, sup_gp.gp5a_rate, sup_gp.gp5a_comment, sup_gp.gp5b_rate, sup_gp.gp5b_comment, sup_gp.gp5c_rate, sup_gp.gp5c_comment, sup_gp.gp6a_rate, sup_gp.gp6a_comment, sup_gp.gp6b_rate, sup_gp.gp6b_comment, sup_gp.gp6c_rate, sup_gp.gp6c_comment, sup_gp.gp7a_rate, sup_gp.gp7a_comment, sup_gp.gp7b_rate, sup_gp.gp7b_comment, sup_gp.gp7c_rate, sup_gp.gp7c_comment, sup_gp.gp8a_rate, sup_gp.gp8a_comment, sup_gp.gp8b_rate, sup_gp.gp8b_comment, sup_gp.gp8c_rate, sup_gp.gp8c_comment, sup_gp.gp9a_rate, sup_gp.gp9a_comment, sup_gp.gp9b_rate, sup_gp.gp9b_comment, sup_gp.gp9c_rate, sup_gp.gp9c_comment, sup_gp.gp10a_rate, sup_gp.gp10a_comment, sup_gp.gp10b_rate, sup_gp.gp10b_comment, sup_gp.gp10c_rate, sup_gp.gp10c_comment, sup_pip.pip_id, sup_pip.pin1, sup_pip.at1, sup_pip.sn1, sup_pip.time1, sup_pip.pin2, sup_pip.at2, sup_pip.sn2, sup_pip.time2, sup_pip.pin3, sup_pip.at3, sup_pip.sn3, sup_pip.time3, users.id, CONCAT(users.firstname, " ", users.lastname) as "rater_fullname", department.department as "dept-name" FROM sup_par, sup_kra, sup_gp, sup_pip, users, department WHERE sup_par.kra_id = sup_kra.kra_id AND sup_par.gp_id = sup_gp.gp_id AND sup_par.pip_id = sup_pip.pip_id AND sup_par.rater_name = users.id AND sup_par.department = department.id AND sup_par.par_status != 0 AND sup_par.par_status != 1 AND sup_par.par_id = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    function get_drafted_par()
    {
        $query = 'SELECT par_details.id as "par_id", par_details.kra_id, par_details.gp_id, par_details.pip_id, par_details.emp_id, par_details.emp_name, par_details.position, par_details.department, par_details.project, par_details.emp_status, par_details.assessment, par_details.review_from, par_details.review_to, par_details.date_hire, par_details.rater, par_details.rater_name as "rater_id", par_details.emp_email, par_details.kra_total, par_details.gp_total, par_details.kra_average, par_details.gp_average, par_details.oap_total, par_details.oap_scale, par_details.accomplishment, par_details.prof_dev, par_details.prof_others, par_details.emp_comment, par_details.recommendation, par_details.gross, kra_kpi.kra1, kra_kpi.kpi1, kra_kpi.rate1, kra_kpi.comments1, kra_kpi.kra2, kra_kpi.kpi2, kra_kpi.rate2, kra_kpi.comments2, kra_kpi.kra3, kra_kpi.kpi3, kra_kpi.rate3, kra_kpi.comments3, kra_kpi.kra4, kra_kpi.kpi4, kra_kpi.rate4, kra_kpi.comments4, kra_kpi.kra5, kra_kpi.kpi5, kra_kpi.rate5, kra_kpi.comments5, kra_kpi.kra6, kra_kpi.kpi6, kra_kpi.rate6, kra_kpi.comments6, gen_performance.gp1a_rate, gen_performance.gp1a_comment, gen_performance.gp1b_rate, gen_performance.gp1b_comment, gen_performance.gp1c_rate, gen_performance.gp1c_comment, gen_performance.gp2a_rate, gen_performance.gp2a_comment, gen_performance.gp2b_rate, gen_performance.gp2b_comment, gen_performance.gp2c_rate, gen_performance.gp2c_comment, gen_performance.gp3a_rate, gen_performance.gp3a_comment, gen_performance.gp3b_rate, gen_performance.gp3b_comment, gen_performance.gp3c_rate, gen_performance.gp3c_comment, gen_performance.gp4a_rate, gen_performance.gp4a_comment, gen_performance.gp4b_rate, gen_performance.gp4b_comment, gen_performance.gp4c_rate, gen_performance.gp4c_comment, gen_performance.gp5a_rate, gen_performance.gp5a_comment, gen_performance.gp5b_rate, gen_performance.gp5b_comment, gen_performance.gp5c_rate, gen_performance.gp5c_comment, gen_performance.gp6a_rate, gen_performance.gp6a_comment, gen_performance.gp6b_rate, gen_performance.gp6b_comment, gen_performance.gp6c_rate, gen_performance.gp6c_comment, gen_performance.gp7a_rate, gen_performance.gp7a_comment, gen_performance.gp7b_rate, gen_performance.gp7b_comment, gen_performance.gp7c_rate, gen_performance.gp7c_comment, gen_performance.gp8a_rate, gen_performance.gp8a_comment, gen_performance.gp8b_rate, gen_performance.gp8b_comment, gen_performance.gp8c_rate, gen_performance.gp8c_comment, gen_performance.gp9a_rate, gen_performance.gp9a_comment, gen_performance.gp9b_rate, gen_performance.gp9b_comment, gen_performance.gp9c_rate, gen_performance.gp9c_comment, gen_performance.gp10a_rate, gen_performance.gp10a_comment, gen_performance.gp10b_rate, gen_performance.gp10b_comment, gen_performance.gp10c_rate, gen_performance.gp10c_comment, pip.pin1, pip.at1, pip.sn1, pip.time1, pip.pin2, pip.at2, pip.sn2, pip.time2, pip.pin3, pip.at3, pip.sn3, pip.time3, department.department as "dept-name" FROM par_Details, kra_kpi, gen_performance, pip, users, department WHERE par_details.kra_id = kra_kpi.kra_id AND par_details.gp_id = gen_performance.gp_id AND par_details.pip_id = pip.pip_id AND par_details.department = department.id AND par_details.id = ? AND par_details.par_status != 0';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    function get_unevaluated_par()
    {
        $query = 'SELECT par_details.id as "par_id", par_details.kra_id, par_details.gp_id, par_details.pip_id, par_details.emp_id, par_details.emp_name, par_details.position, par_details.department, par_details.project, par_details.emp_status, par_details.assessment, par_details.review_from, par_details.review_to, par_details.date_hire, par_details.rater, par_details.rater_name as "rater_id", par_details.emp_email, par_details.kra_total, par_details.gp_total, par_details.kra_average, par_details.gp_average, par_details.oap_total, par_details.oap_scale, par_details.accomplishment, par_details.prof_dev, par_details.prof_others, par_details.emp_comment, par_details.recommendation, par_details.gross, kra_kpi.kra1, kra_kpi.kpi1, kra_kpi.rate1, kra_kpi.comments1, kra_kpi.kra2, kra_kpi.kpi2, kra_kpi.rate2, kra_kpi.comments2, kra_kpi.kra3, kra_kpi.kpi3, kra_kpi.rate3, kra_kpi.comments3, kra_kpi.kra4, kra_kpi.kpi4, kra_kpi.rate4, kra_kpi.comments4, kra_kpi.kra5, kra_kpi.kpi5, kra_kpi.rate5, kra_kpi.comments5, kra_kpi.kra6, kra_kpi.kpi6, kra_kpi.rate6, kra_kpi.comments6, gen_performance.gp1a_rate, gen_performance.gp1a_comment, gen_performance.gp1b_rate, gen_performance.gp1b_comment, gen_performance.gp1c_rate, gen_performance.gp1c_comment, gen_performance.gp2a_rate, gen_performance.gp2a_comment, gen_performance.gp2b_rate, gen_performance.gp2b_comment, gen_performance.gp2c_rate, gen_performance.gp2c_comment, gen_performance.gp3a_rate, gen_performance.gp3a_comment, gen_performance.gp3b_rate, gen_performance.gp3b_comment, gen_performance.gp3c_rate, gen_performance.gp3c_comment, gen_performance.gp4a_rate, gen_performance.gp4a_comment, gen_performance.gp4b_rate, gen_performance.gp4b_comment, gen_performance.gp4c_rate, gen_performance.gp4c_comment, gen_performance.gp5a_rate, gen_performance.gp5a_comment, gen_performance.gp5b_rate, gen_performance.gp5b_comment, gen_performance.gp5c_rate, gen_performance.gp5c_comment, gen_performance.gp6a_rate, gen_performance.gp6a_comment, gen_performance.gp6b_rate, gen_performance.gp6b_comment, gen_performance.gp6c_rate, gen_performance.gp6c_comment, gen_performance.gp7a_rate, gen_performance.gp7a_comment, gen_performance.gp7b_rate, gen_performance.gp7b_comment, gen_performance.gp7c_rate, gen_performance.gp7c_comment, gen_performance.gp8a_rate, gen_performance.gp8a_comment, gen_performance.gp8b_rate, gen_performance.gp8b_comment, gen_performance.gp8c_rate, gen_performance.gp8c_comment, gen_performance.gp9a_rate, gen_performance.gp9a_comment, gen_performance.gp9b_rate, gen_performance.gp9b_comment, gen_performance.gp9c_rate, gen_performance.gp9c_comment, gen_performance.gp10a_rate, gen_performance.gp10a_comment, gen_performance.gp10b_rate, gen_performance.gp10b_comment, gen_performance.gp10c_rate, gen_performance.gp10c_comment, pip.pin1, pip.at1, pip.sn1, pip.time1, pip.pin2, pip.at2, pip.sn2, pip.time2, pip.pin3, pip.at3, pip.sn3, pip.time3, users.id, CONCAT(users.firstname, " ", users.lastname) as "rater_name", department.department as "dept-name" FROM par_Details, kra_kpi, gen_performance, pip, users, department WHERE par_details.kra_id = kra_kpi.kra_id AND par_details.gp_id = gen_performance.gp_id AND par_details.pip_id = pip.pip_id AND par_details.rater_name = users.id AND par_details.department = department.id AND par_details.id = ? AND par_details.par_status != 0';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    function get_report_evaluated()
    {
        $query = 'SELECT sup_par.id as "sup-id", sup_par.par_id as "details_id", sup_par.emp_name, sup_par.position, sup_par.department, sup_par.project, sup_par.emp_status, sup_par.assessment, sup_par.review_from, sup_par.review_to, sup_par.date_hire, sup_par.rater, sup_par.rater_name as "rater_id", sup_par.emp_email, sup_par.kra_total, sup_par.gp_total, sup_par.kra_average, sup_par.gp_average, sup_par.oap_total, sup_par.oap_scale, sup_par.accomplishment, sup_par.prof_dev, sup_par.prof_others, sup_par.emp_comment, sup_par.recommendation, sup_par.gross, sup_par.remarks, sup_par.par_status, sup_kra.kra_id, sup_kra.kra1, sup_kra.kpi1, sup_kra.rate1, sup_kra.comments1, sup_kra.sup_com1, sup_kra.kra2, sup_kra.kpi2, sup_kra.rate2, sup_kra.comments2, sup_kra.sup_com2, sup_kra.kra3, sup_kra.kpi3, sup_kra.rate3, sup_kra.comments3, sup_kra.sup_com3, sup_kra.kra4, sup_kra.kpi4, sup_kra.rate4, sup_kra.comments4, sup_kra.sup_com4, sup_kra.kra5, sup_kra.kpi5, sup_kra.rate5, sup_kra.comments5, sup_kra.sup_com5, sup_kra.kra6, sup_kra.kpi6, sup_kra.rate6, sup_kra.comments6, sup_kra.sup_com6, sup_gp.gp_id, sup_gp.gp1a_rate, sup_gp.gp1a_comment, sup_gp.gp1b_rate, sup_gp.gp1b_comment, sup_gp.gp1c_rate, sup_gp.gp1c_comment, sup_gp.gp2a_rate, sup_gp.gp2a_comment, sup_gp.gp2b_rate, sup_gp.gp2b_comment, sup_gp.gp2c_rate, sup_gp.gp2c_comment, sup_gp.gp3a_rate, sup_gp.gp3a_comment, sup_gp.gp3b_rate, sup_gp.gp3b_comment, sup_gp.gp3c_rate, sup_gp.gp3c_comment, sup_gp.gp4a_rate, sup_gp.gp4a_comment, sup_gp.gp4b_rate, sup_gp.gp4b_comment, sup_gp.gp4c_rate, sup_gp.gp4c_comment, sup_gp.gp5a_rate, sup_gp.gp5a_comment, sup_gp.gp5b_rate, sup_gp.gp5b_comment, sup_gp.gp5c_rate, sup_gp.gp5c_comment, sup_gp.gp6a_rate, sup_gp.gp6a_comment, sup_gp.gp6b_rate, sup_gp.gp6b_comment, sup_gp.gp6c_rate, sup_gp.gp6c_comment, sup_gp.gp7a_rate, sup_gp.gp7a_comment, sup_gp.gp7b_rate, sup_gp.gp7b_comment, sup_gp.gp7c_rate, sup_gp.gp7c_comment, sup_gp.gp8a_rate, sup_gp.gp8a_comment, sup_gp.gp8b_rate, sup_gp.gp8b_comment, sup_gp.gp8c_rate, sup_gp.gp8c_comment, sup_gp.gp9a_rate, sup_gp.gp9a_comment, sup_gp.gp9b_rate, sup_gp.gp9b_comment, sup_gp.gp9c_rate, sup_gp.gp9c_comment, sup_gp.gp10a_rate, sup_gp.gp10a_comment, sup_gp.gp10b_rate, sup_gp.gp10b_comment, sup_gp.gp10c_rate, sup_gp.gp10c_comment, sup_pip.pip_id, sup_pip.pin1, sup_pip.at1, sup_pip.sn1, sup_pip.time1, sup_pip.pin2, sup_pip.at2, sup_pip.sn2, sup_pip.time2, sup_pip.pin3, sup_pip.at3, sup_pip.sn3, sup_pip.time3, users.id, CONCAT(users.firstname, " ", users.lastname) as "rater_fullname", department.department as "dept-name" FROM sup_par, sup_kra, sup_gp, sup_pip, users, department WHERE sup_par.kra_id = sup_kra.kra_id AND sup_par.gp_id = sup_gp.gp_id AND sup_par.pip_id = sup_pip.pip_id AND sup_par.rater_name = users.id AND sup_par.department = department.id AND (find_in_set(2, sup_par.par_status) || find_in_set(3, sup_par.par_status)) AND CONCAT(YEAR(sup_par.date_evaluated)) = ? AND sup_par.assessment = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->date_evaluated);
        $sel->bindParam(2, $this->assessment);

        $sel->execute();
        //$sel->execute(array($from, $to));
        return $sel;
    }

    function get_report_approved()
    {
        $query = 'SELECT sup_par.id as "sup-id", sup_par.par_id as "details_id", sup_par.emp_name, sup_par.position, sup_par.department, sup_par.project, sup_par.emp_status, sup_par.assessment, sup_par.review_from, sup_par.review_to, sup_par.date_hire, sup_par.rater, sup_par.rater_name as "rater_id", sup_par.emp_email, sup_par.kra_total, sup_par.gp_total, sup_par.kra_average, sup_par.gp_average, sup_par.oap_total, sup_par.oap_scale, sup_par.accomplishment, sup_par.prof_dev, sup_par.prof_others, sup_par.emp_comment, sup_par.recommendation, sup_par.gross, sup_par.remarks, sup_par.par_status, sup_kra.kra_id, sup_kra.kra1, sup_kra.kpi1, sup_kra.rate1, sup_kra.comments1, sup_kra.sup_com1, sup_kra.kra2, sup_kra.kpi2, sup_kra.rate2, sup_kra.comments2, sup_kra.sup_com2, sup_kra.kra3, sup_kra.kpi3, sup_kra.rate3, sup_kra.comments3, sup_kra.sup_com3, sup_kra.kra4, sup_kra.kpi4, sup_kra.rate4, sup_kra.comments4, sup_kra.sup_com4, sup_kra.kra5, sup_kra.kpi5, sup_kra.rate5, sup_kra.comments5, sup_kra.sup_com5, sup_kra.kra6, sup_kra.kpi6, sup_kra.rate6, sup_kra.comments6, sup_kra.sup_com6, sup_gp.gp_id, sup_gp.gp1a_rate, sup_gp.gp1a_comment, sup_gp.gp1b_rate, sup_gp.gp1b_comment, sup_gp.gp1c_rate, sup_gp.gp1c_comment, sup_gp.gp2a_rate, sup_gp.gp2a_comment, sup_gp.gp2b_rate, sup_gp.gp2b_comment, sup_gp.gp2c_rate, sup_gp.gp2c_comment, sup_gp.gp3a_rate, sup_gp.gp3a_comment, sup_gp.gp3b_rate, sup_gp.gp3b_comment, sup_gp.gp3c_rate, sup_gp.gp3c_comment, sup_gp.gp4a_rate, sup_gp.gp4a_comment, sup_gp.gp4b_rate, sup_gp.gp4b_comment, sup_gp.gp4c_rate, sup_gp.gp4c_comment, sup_gp.gp5a_rate, sup_gp.gp5a_comment, sup_gp.gp5b_rate, sup_gp.gp5b_comment, sup_gp.gp5c_rate, sup_gp.gp5c_comment, sup_gp.gp6a_rate, sup_gp.gp6a_comment, sup_gp.gp6b_rate, sup_gp.gp6b_comment, sup_gp.gp6c_rate, sup_gp.gp6c_comment, sup_gp.gp7a_rate, sup_gp.gp7a_comment, sup_gp.gp7b_rate, sup_gp.gp7b_comment, sup_gp.gp7c_rate, sup_gp.gp7c_comment, sup_gp.gp8a_rate, sup_gp.gp8a_comment, sup_gp.gp8b_rate, sup_gp.gp8b_comment, sup_gp.gp8c_rate, sup_gp.gp8c_comment, sup_gp.gp9a_rate, sup_gp.gp9a_comment, sup_gp.gp9b_rate, sup_gp.gp9b_comment, sup_gp.gp9c_rate, sup_gp.gp9c_comment, sup_gp.gp10a_rate, sup_gp.gp10a_comment, sup_gp.gp10b_rate, sup_gp.gp10b_comment, sup_gp.gp10c_rate, sup_gp.gp10c_comment, sup_pip.pip_id, sup_pip.pin1, sup_pip.at1, sup_pip.sn1, sup_pip.time1, sup_pip.pin2, sup_pip.at2, sup_pip.sn2, sup_pip.time2, sup_pip.pin3, sup_pip.at3, sup_pip.sn3, sup_pip.time3, department.department as "dept-name", sup_par.date_evaluated, units.id, units.unit_name FROM sup_par, sup_kra, sup_gp, sup_pip, units, department WHERE sup_par.kra_id = sup_kra.kra_id AND sup_par.gp_id = sup_gp.gp_id AND sup_par.pip_id = sup_pip.pip_id AND sup_par.project = units.id AND sup_par.department = department.id AND sup_par.par_status = 4 AND sup_par.assessment = ? AND CONCAT(YEAR(date_evaluated)) = ? ORDER BY sup_par.date_evaluated ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->assessment);
        $sel->bindParam(2, $this->date_evaluated);

        $sel->execute();
        //$sel->execute(array($from, $to));
        return $sel;
    }

    function get_report_uneval()
    {
        $query = 'SELECT par_details.id as "par_id", par_details.emp_name, par_details.position, par_details.department, par_details.project, par_details.emp_status, par_details.assessment, par_details.review_from, par_details.review_to, par_details.date_hire, par_details.rater, par_details.rater_name as "rater_id", par_details.emp_email, par_details.kra_total, par_details.gp_total, par_details.kra_average, par_details.gp_average, par_details.oap_total, par_details.oap_scale, par_details.accomplishment, par_details.prof_dev, par_details.prof_others, par_details.emp_comment, par_details.recommendation, par_details.gross, kra_kpi.kra1, kra_kpi.kpi1, kra_kpi.rate1, kra_kpi.comments1, kra_kpi.kra2, kra_kpi.kpi2, kra_kpi.rate2, kra_kpi.comments2, kra_kpi.kra3, kra_kpi.kpi3, kra_kpi.rate3, kra_kpi.comments3, kra_kpi.kra4, kra_kpi.kpi4, kra_kpi.rate4, kra_kpi.comments4, kra_kpi.kra5, kra_kpi.kpi5, kra_kpi.rate5, kra_kpi.comments5, kra_kpi.kra6, kra_kpi.kpi6, kra_kpi.rate6, kra_kpi.comments6, gen_performance.gp1a_rate, gen_performance.gp1a_comment, gen_performance.gp1b_rate, gen_performance.gp1b_comment, gen_performance.gp1c_rate, gen_performance.gp1c_comment, gen_performance.gp2a_rate, gen_performance.gp2a_comment, gen_performance.gp2b_rate, gen_performance.gp2b_comment, gen_performance.gp2c_rate, gen_performance.gp2c_comment, gen_performance.gp3a_rate, gen_performance.gp3a_comment, gen_performance.gp3b_rate, gen_performance.gp3b_comment, gen_performance.gp3c_rate, gen_performance.gp3c_comment, gen_performance.gp4a_rate, gen_performance.gp4a_comment, gen_performance.gp4b_rate, gen_performance.gp4b_comment, gen_performance.gp4c_rate, gen_performance.gp4c_comment, gen_performance.gp5a_rate, gen_performance.gp5a_comment, gen_performance.gp5b_rate, gen_performance.gp5b_comment, gen_performance.gp5c_rate, gen_performance.gp5c_comment, gen_performance.gp6a_rate, gen_performance.gp6a_comment, gen_performance.gp6b_rate, gen_performance.gp6b_comment, gen_performance.gp6c_rate, gen_performance.gp6c_comment, gen_performance.gp7a_rate, gen_performance.gp7a_comment, gen_performance.gp7b_rate, gen_performance.gp7b_comment, gen_performance.gp7c_rate, gen_performance.gp7c_comment, gen_performance.gp8a_rate, gen_performance.gp8a_comment, gen_performance.gp8b_rate, gen_performance.gp8b_comment, gen_performance.gp8c_rate, gen_performance.gp8c_comment, gen_performance.gp9a_rate, gen_performance.gp9a_comment, gen_performance.gp9b_rate, gen_performance.gp9b_comment, gen_performance.gp9c_rate, gen_performance.gp9c_comment, gen_performance.gp10a_rate, gen_performance.gp10a_comment, gen_performance.gp10b_rate, gen_performance.gp10b_comment, gen_performance.gp10c_rate, gen_performance.gp10c_comment, pip.pin1, pip.at1, pip.sn1, pip.time1, pip.pin2, pip.at2, pip.sn2, pip.time2, pip.pin3, pip.at3, pip.sn3, pip.time3, users.id, CONCAT(users.firstname, " ", users.lastname) as "rater_name", department.department as "dept-name" FROM par_Details, kra_kpi, gen_performance, pip, users, department WHERE par_details.kra_id = kra_kpi.kra_id AND par_details.gp_id = gen_performance.gp_id AND par_details.pip_id = pip.pip_id AND par_details.rater_name = users.id AND par_details.department = department.id AND par_details.par_status = 1 AND CONCAT(YEAR(par_details.date_submit)) = ? AND par_details.assessment = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->date_submit);
        $sel->bindParam(2, $this->assessment);

        $sel->execute();
        //$sel->execute(array($from, $to));
        return $sel;
    }

    //count the prof dev result from employee
    public function count_dev()
    {
        $query = 'SELECT t.prof_dev, COUNT(p.id) counter FROM sup_par t INNER JOIN tblprof_dev p ON find_in_set(t.prof_dev, p.name) WHERE t.par_status = 4 group by t.prof_dev';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }
    public function get_par_last_id()
    {
        $query = "SELECT max(id) + 1 as 'par_id' FROM par_details";
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    public function get_sup_last_id()
    {
        $query = "SELECT max(id) + 1 as 'sup_id' FROM sup_par";
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->execute();
        return $sel;
    }

    public function get_emp_department()
    {
        $query = 'SELECT * FROM department WHERE id = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    public function update_PAR_manager()
    {
        $query = 'UPDATE sup_par SET recommendation=?, gross=? WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->recommendation);
        $upd->bindParam(2, $this->gross);
        $upd->bindParam(3, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function accept_par_app2()
    {
        $query = 'UPDATE sup_par SET oap_scale=?, accomplishment=?, recommendation=?, gross=?, remarks=?, par_status=3 WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->oap_scale);
        $upd->bindParam(2, $this->accomplishment);
        $upd->bindParam(3, $this->recommendation);
        $upd->bindParam(4, $this->gross);
        $upd->bindParam(5, $this->remarks);
        $upd->bindParam(6, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function accept_par()
    {
        $query = 'UPDATE sup_par SET recommendation=?, gross=?, remarks=?, par_status=4 WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->recommendation);
        $upd->bindParam(2, $this->gross);
        $upd->bindParam(3, $this->remarks);
        $upd->bindParam(4, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function approve_par()
    {
        $query = 'UPDATE sup_par SET par_status=? WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->status);
        $upd->bindParam(2, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function upd_hr_recommend()
    {
        $query = 'UPDATE sup_par SET recommendation=?, gross=?, remarks=?, declined=? WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->recommendation);
        $upd->bindParam(2, $this->gross);
        $upd->bindParam(3, $this->remarks);
        $upd->bindParam(4, $this->declined);
        $upd->bindParam(5, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function declined_PAR()
    {
        $query = 'UPDATE sup_par SET reason=?, par_status=5 WHERE id=?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->conn->prepare($query);

        $upd->bindParam(1, $this->reason);
        $upd->bindParam(2, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_reviewer()
    {
        $query = 'SELECT * FROM sup_par WHERE id = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    public function view_draft_par()
    {
        $query = 'SELECT par_details.id, par_details.emp_name, par_details.department, par_details.date_submit, par_details.par_status, department.department as "dept-name", par_details.rater_name FROM par_details, department WHERE par_details.department = department.id AND par_details.par_status = 4 AND par_details.emp_id = ? ORDER BY par_details.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->emp_id);

        $sel->execute();
        return $sel;
    }

    public function view_draft_reviewed_par()
    {
        $query = 'SELECT sup_par.id, sup_par.par_id, sup_par.emp_name, sup_par.department, sup_par.date_submit, sup_par.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM sup_par, department, users WHERE sup_par.department = department.id AND sup_par.rater_name = users.id AND sup_par.par_status = 1 OR users.role = 5 AND sup_par.eval_by = ? ORDER BY sup_par.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->eval_by);

        $sel->execute();
        return $sel;
    }
    public function view_draft_reviewed_par_app1_for_HR()
    {
        $query = 'SELECT sup_par.id, sup_par.par_id, sup_par.emp_name, sup_par.department, sup_par.date_submit, sup_par.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM sup_par, department, users WHERE sup_par.department = department.id AND sup_par.rater_name = users.id AND users.role = 1 AND sup_par.par_status = 1 ORDER BY sup_par.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);


        $sel->execute();
        return $sel;
    }
    public function view_draft_reviewed_par_app2_for_HR()
    {
        $query = 'SELECT sup_par.id, sup_par.par_id, sup_par.emp_name, sup_par.department, sup_par.date_submit, sup_par.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM sup_par, department, users WHERE sup_par.department = department.id AND sup_par.rater_name = users.id AND users.role = 2 AND sup_par.par_status = 1 ORDER BY sup_par.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);


        $sel->execute();
        return $sel;
    }
    public function view_draft_reviewed_par_app3_for_HR()
    {
        $query = 'SELECT sup_par.id, sup_par.par_id, sup_par.emp_name, sup_par.department, sup_par.date_submit, sup_par.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM sup_par, department, users WHERE sup_par.department = department.id AND sup_par.rater_name = users.id AND users.role = 3 AND sup_par.par_status = 1 ORDER BY sup_par.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);


        $sel->execute();
        return $sel;
    }

    public function view_user_par()
    {
        $query = 'SELECT par_details.id, par_details.emp_name, par_details.department, par_details.date_submit, par_details.par_status, department.department as "dept-name", CONCAT(users.firstname, " ", users.lastname) as "reviewer" FROM par_details, department, users WHERE par_details.department = department.id AND par_details.rater_name = users.id AND (find_in_set(1, par_details.par_status) || find_in_set(2, par_details.par_status) || find_in_set(3, par_details.par_status)) AND par_details.emp_id = ? ORDER BY par_details.date_submit ASC';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->emp_id);

        $sel->execute();
        return $sel;
    }

    public function upd_draft_par()
    {
        $query = "UPDATE " . $this->table_name . " SET kra_id=?, gp_id=?, pip_id=?, sup_id=0, emp_id=?, emp_name=?, position=?, department=?, project=?, emp_status=?, assessment=?, review_from=?, review_to=?, date_hire=?, rater=?, rater_name=?, emp_email=?, kra_total=?, gp_total=?, kra_average=?, gp_average=?, oap_total=?, oap_scale=?, accomplishment=?, prof_dev=?, prof_others=?, emp_comment=?, date_submit=?, par_status=? WHERE id=?";
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->conn->prepare($query);

        $ins->bindParam(1, $this->kra_id);
        $ins->bindParam(2, $this->gp_id);
        $ins->bindParam(3, $this->pip_id);
        $ins->bindParam(4, $this->emp_id);
        $ins->bindParam(5, $this->emp_name);
        $ins->bindParam(6, $this->position);
        $ins->bindParam(7, $this->department);
        $ins->bindParam(8, $this->project);
        $ins->bindParam(9, $this->emp_status);
        $ins->bindParam(10, $this->assessment);
        $ins->bindParam(11, $this->review_from);
        $ins->bindParam(12, $this->review_to);
        $ins->bindParam(13, $this->date_hire);
        $ins->bindParam(14, $this->rater);
        $ins->bindParam(15, $this->rater_name);
        $ins->bindParam(16, $this->emp_email);
        $ins->bindParam(17, $this->kra_total);
        $ins->bindParam(18, $this->gp_total);
        $ins->bindParam(19, $this->kra_average);
        $ins->bindParam(20, $this->gp_average);
        $ins->bindParam(21, $this->oap_total);
        $ins->bindParam(22, $this->oap_scale);
        $ins->bindParam(23, $this->accomplishment);
        $ins->bindParam(24, $this->prof_dev);
        $ins->bindParam(25, $this->prof_others);
        $ins->bindParam(26, $this->emp_comment);
        $ins->bindParam(27, $this->date_submit);
        $ins->bindParam(28, $this->status);
        $ins->bindParam(29, $this->id);

        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_par_ids()
    {
        $query = 'SELECT par_id, kra_id, gp_id, pip_id, par_status FROM sup_par WHERE id = ?';
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->conn->prepare($query);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }
}
