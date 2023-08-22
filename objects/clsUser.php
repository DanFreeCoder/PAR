<?php
class Users
{
	private $conn;
	private $table_name = "users";

	public $firstname;
	public $lastname;
	public $username;
	public $password;
	public $access;
	public $status;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function forgot_password_email()
	{
		$sql = "SELECT id, email FROM users WHERE email = ? AND status != 0";
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($sql);

		$sel->bindParam(1, $this->email);

		$sel->execute();
		return $sel;
	}



	public function get_username()
	{
		$sql = "SELECT username FROM users WHERE id = ? AND status != 0";
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($sql);

		$sel->bindParam(1, $this->id);

		$sel->execute();
		return $sel;
	}

	public function addUser()
	{
		$query = 'INSERT INTO ' . $this->table_name . ' SET firstname=?, lastname=?, position=?, project=?, date_hire=?, dept=?, unit=?, email=?, username=?, user_pass=?, access=?, role=?, logcount=?, status=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$add = $this->conn->prepare($query);

		$add->bindParam(1, $this->firstname);
		$add->bindParam(2, $this->lastname);
		$add->bindParam(3, $this->position);
		$add->bindParam(4, $this->project);
		$add->bindParam(5, $this->date_hire);
		$add->bindParam(6, $this->dept);
		$add->bindParam(7, $this->unit);
		$add->bindParam(8, $this->email);
		$add->bindParam(9, $this->username);
		$add->bindParam(10, $this->user_pass);
		$add->bindParam(11, $this->access);
		$add->bindParam(12, $this->role);
		$add->bindParam(13, $this->logcount);
		$add->bindParam(14, $this->status);

		if ($add->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function addUser_emp()
	{
		$query = 'INSERT INTO ' . $this->table_name . ' SET firstname=?, lastname=?, position=?, project=?, date_hire=?, dept=?, email=?, username=?, user_pass=?, logcount=0, access=6, role=0, status=1';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$add = $this->conn->prepare($query);

		$add->bindParam(1, $this->firstname);
		$add->bindParam(2, $this->lastname);
		$add->bindParam(3, $this->position);
		$add->bindParam(4, $this->project);
		$add->bindParam(5, $this->date_hire);
		$add->bindParam(6, $this->dept);
		$add->bindParam(7, $this->email);
		$add->bindParam(8, $this->username);
		$add->bindParam(9, $this->user_pass);

		if ($add->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function view_all_approver()
	{
		$query = 'SELECT id, CONCAT(firstname, " ", lastname) as "fullname", access, role, username FROM ' . $this->table_name . ' WHERE status != 0 AND (find_in_set(1, role) || find_in_set(2, role) || find_in_set(3, role) || find_in_set(4, role)) ORDER BY role ASC';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->execute();
		return $sel;
	}

	function view_all_staff()
	{
		$query = 'SELECT id, CONCAT(firstname, " ", lastname) as "fullname", access, username FROM ' . $this->table_name . ' WHERE status != 0 AND access = 6 ORDER BY firstname';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->execute();
		return $sel;
	}

	function view_all_user()
	{
		$query = 'SELECT id, CONCAT(firstname, " ", lastname) as "fullname", access, username FROM ' . $this->table_name . ' WHERE status != 0 ORDER BY access';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->execute();
		return $sel;
	}

	function get_user_by_id()
	{
		$query = 'SELECT id, firstname, lastname, position, project, date_hire, dept, unit, username, email, access, role, CONCAT(firstname, " ", lastname) as "fullname" FROM ' . $this->table_name . ' WHERE id = ?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->id);

		$sel->execute();
		return $sel;
	}

	public function updateUser()
	{
		$query = 'UPDATE ' . $this->table_name . ' SET firstname=?, lastname=?, position=?, date_hire=?, dept=?, unit=?, email=?, username=?, user_pass=?, access=?, role=?, logcount=1 WHERE id=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$upd = $this->conn->prepare($query);

		$upd->bindParam(1, $this->firstname);
		$upd->bindParam(2, $this->lastname);
		$upd->bindParam(3, $this->position);
		$upd->bindParam(4, $this->date_hire);
		$upd->bindParam(5, $this->dept);
		$upd->bindParam(6, $this->unit);
		$upd->bindParam(7, $this->email);
		$upd->bindParam(8, $this->username);
		$upd->bindParam(9, $this->user_pass);
		$upd->bindParam(10, $this->access);
		$upd->bindParam(11, $this->role);
		$upd->bindParam(12, $this->id);

		if ($upd->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function updateDetails()
	{
		$query = 'UPDATE ' . $this->table_name . ' SET firstname=?, lastname=?, position=?, date_hire=?, dept=?, unit=?, email=?, username=?, access=?, role=? WHERE id=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$upd = $this->conn->prepare($query);

		$upd->bindParam(1, $this->firstname);
		$upd->bindParam(2, $this->lastname);
		$upd->bindParam(3, $this->position);
		$upd->bindParam(4, $this->date_hire);
		$upd->bindParam(5, $this->dept);
		$upd->bindParam(6, $this->project);
		$upd->bindParam(7, $this->email);
		$upd->bindParam(8, $this->username);
		$upd->bindParam(9, $this->access);
		$upd->bindParam(10, $this->role);
		$upd->bindParam(11, $this->id);

		if ($upd->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function updateUserDetails()
	{
		$query = 'UPDATE ' . $this->table_name . ' SET firstname=?, lastname=?, position=?, project=?, date_hire=?, dept=?, unit=?, email=?, username=?, access=? WHERE id=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$upd = $this->conn->prepare($query);

		$upd->bindParam(1, $this->firstname);
		$upd->bindParam(2, $this->lastname);
		$upd->bindParam(3, $this->position);
		$upd->bindParam(4, $this->project);
		$upd->bindParam(5, $this->date_hire);
		$upd->bindParam(6, $this->dept);
		$upd->bindParam(7, $this->unit);
		$upd->bindParam(8, $this->email);
		$upd->bindParam(9, $this->username);
		$upd->bindParam(10, $this->access);
		$upd->bindParam(11, $this->id);

		if ($upd->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function upd_user_password()
	{
		$query = 'UPDATE ' . $this->table_name . ' SET firstname=?, lastname=?, position=?, unit=?, email=?, date_hire=?, username=?, user_pass=?, logcount=1 WHERE id=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$upd = $this->conn->prepare($query);

		$upd->bindParam(1, $this->firstname);
		$upd->bindParam(2, $this->lastname);
		$upd->bindParam(3, $this->position);
		$upd->bindParam(4, $this->unit);
		$upd->bindParam(5, $this->email);
		$upd->bindParam(6, $this->date_hire);
		$upd->bindParam(7, $this->username);
		$upd->bindParam(8, $this->user_pass);
		$upd->bindParam(9, $this->id);

		if ($upd->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function upd_user_pw() //1st login
	{
		$query = 'UPDATE ' . $this->table_name . ' SET user_pass=?, logcount = 1 WHERE id=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$upd = $this->conn->prepare($query);

		$upd->bindParam(1, $this->user_pass);
		$upd->bindParam(2, $this->id);

		if ($upd->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function reset_user()
	{
		$query = 'UPDATE ' . $this->table_name . ' SET user_pass=?, logcount = ? WHERE id=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$upd = $this->conn->prepare($query);

		$upd->bindParam(1, $this->user_pass);
		$upd->bindParam(2, $this->logcount);
		$upd->bindParam(3, $this->id);

		if ($upd->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function remove_user()
	{
		$query = 'UPDATE ' . $this->table_name . ' SET status=0 WHERE id=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$upd = $this->conn->prepare($query);

		$upd->bindParam(1, $this->id);

		if ($upd->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function login()
	{
		$query = "SELECT users.id as 'user-id', CONCAT(users.firstname, ' ', users.lastname) AS fullname, users.firstname, users.lastname, users.position, users.project, users.date_hire, users.unit, users.email, users.username, users.access, users.logcount, users.role, users.dept, users.status, department.id, department.department FROM users, department WHERE users.username = ?  AND users.user_pass = ? AND users.dept = department.id AND users.status != 0";
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->username);
		$sel->bindParam(2, $this->user_pass);

		$sel->execute();
		return $sel;
	}

	public function logout()
	{
		session_start();
		if (session_destroy()) {
			return true;
			unset($_SESSION['username']);
		} else {
			return false;
		}
	}

	function view_sup()
	{
		$query = 'SELECT id, CONCAT(firstname, " ", lastname) as "fullname" FROM users WHERE access = 2 AND dept = ? AND status != 0 ORDER BY firstname ASC';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->dept);

		$sel->execute();
		return $sel;
	}

	function view_manager()
	{
		$query = 'SELECT id, CONCAT(firstname, " ", lastname) as "fullname" FROM users WHERE access = 3 AND status != 0 ORDER BY firstname ASC';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		//$sel->bindParam(1, $this->dept);
		//$sel->bindParam(2, $this->access);

		$sel->execute();
		return $sel;
	}

	function view_sr_manager()
	{
		$query = 'SELECT id, dept, CONCAT(firstname, " ", lastname) as "fullname" FROM users WHERE access = 4 AND status != 0 ORDER BY firstname ASC';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		//$sel->bindParam(1, $this->dept);
		//$sel->bindParam(1, $this->access);

		$sel->execute();
		return $sel;
	}

	function view_hr_admin()
	{
		$query = 'SELECT id, dept, CONCAT(firstname, " ", lastname) as "fullname" FROM users WHERE access = 5 AND status != 0 ORDER BY firstname ASC';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->execute();
		return $sel;
	}

	function get_hr_admin()
	{
		$query = 'SELECT * FROM users WHERE access = 5 AND status != 0 ORDER BY firstname ASC';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->execute();
		return $sel;
	}
	public function send_email_to_user()
	{
		$query = 'SELECT email, CONCAT(firstname, lastname) as userfullname FROM users WHERE email = ? AND status != 0';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);
		$sel->bindParam(1, $this->email);
		$sel->execute();
		return $sel;
	}


	public function view_user_dept()
	{
		$query = 'SELECT dept FROM ' . $this->table_name . ' WHERE id = ?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->id);

		$sel->execute();
		return $sel;
	}

	public function check_approver2()
	{
		$query = 'SELECT count(role) as "count" FROM ' . $this->table_name . ' WHERE role=2 AND dept=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->dept);

		$sel->execute();
		return $sel;
	}

	public function check_approver3()
	{
		$query = 'SELECT count(role) as "count", email, firstname, lastname FROM ' . $this->table_name . ' WHERE role=3 AND dept=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->dept);

		$sel->execute();
		return $sel;
	}

	public function get_approver2_email()
	{
		$query = 'SELECT * FROM ' . $this->table_name . ' WHERE role=2 AND dept=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->dept);

		$sel->execute();
		return $sel;
	}

	public function get_approver3_email()
	{
		$query = 'SELECT * FROM ' . $this->table_name . ' WHERE role=3 AND dept=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->dept);

		$sel->execute();
		return $sel;
	}

	public function check_user_exist()
	{
		$query = 'SELECT firstname, lastname, email FROM users WHERE (FIND_IN_SET(?, firstname) && FIND_IN_SET(?, lastname) && FIND_IN_SET(?, email) && FIND_IN_SET(1, status))';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->firstname);
		$sel->bindParam(2, $this->lastname);
		$sel->bindParam(3, $this->email);

		$sel->execute();
		return $sel;
	}

	public function count_unit()
	{
		$query = 'SELECT COUNT(*) as "counts" FROM units WHERE dept_id=?';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->dept_id);

		$sel->execute();
		return $sel;
	}

	public function view_unit()
	{
		$query = 'SELECT * FROM units WHERE dept_id = ? AND status != 0';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->dept_id);

		$sel->execute();
		return $sel;
	}

	public function view_common_unit()
	{
		$query = 'SELECT * FROM units WHERE dept_id = 0 AND status != 0';
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->dept_id);

		$sel->execute();
		return $sel;
	}

	//Author: Danilo
	public function approved_PAR_tbl_emp()
	{
		$query = "SELECT sup_par.id, sup_par.par_id, sup_par.emp_name, department.department as 'dept_name', sup_par.date_evaluated as 'date_approved', CONCAT(users.firstname, ' ', users.lastname) as 'approved_by' FROM sup_par, department, users WHERE sup_par.department = department.id AND sup_par.eval_by = users.id AND sup_par.emp_name = ?";
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sel = $this->conn->prepare($query);

		$sel->bindParam(1, $this->emp_name);

		$sel->execute();
		return $sel;
	}
}
