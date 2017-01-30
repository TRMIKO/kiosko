<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Model
{	
	function get_last_id()
	{
		$q=$this->db->query("SELECT id from users order by id desc limit 1");
		return $q->result();
	}
	function perfil_r($id)
	{
		$this->db->query("INSERT into user_profiles (user_id, nombre, apellido) values (".$id.",'".$_POST["nombre"]."','".$_POST["apellido"]."')");
		$this->db->query("UPDATE users set activated=1 where id=".$id);
	}
	
}