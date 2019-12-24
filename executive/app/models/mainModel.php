<?php
include 'system/Model.php';
class mainModel extends Model
{
	public function loginVerify($login, $password)
    {
      $sql = "SELECT * FROM administration WHERE adminEmail = '$login' AND adminPassword = '$password'";
			return $this->db->fetch($sql);
    }

    public function test(){
        $sql = "SELECT * FROM businessInfo";
        return $this->db->fetch($sql);
    }
    public function setPrimaryDB(){
        return $this->db->selectDB();
    }

    public function setSecondaryDB(){
        return $this->db->selectDB($_SESSION['data']['businessDBName']);
    }
}
