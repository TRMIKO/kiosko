<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class modelo_inicio extends CI_Model
{	
	function new_dir($id_usr)
	{
		$this->db->query("INSERT into carpeta (nombre,id_usuario,nivel,debajo_de) 
			values ('".$_POST["dirname"]."',".$id_usr.",".$_POST["lvl"].",".$_POST["bajo"].")");
	}
	function get_dir($id_usr)
	{
		$q=$this->db->query("SELECT * from carpeta where nivel=0 and debajo_de=0 and id_usuario=".$id_usr);
		return $q->result();
	}
	function check_dir($id_usr,$dir)
	{
		$q=$this->db->query("SELECT * from carpeta where id_carpeta=".$dir." and id_usuario=".$id_usr);
		$res=$q->result();
		if(isset($res[0]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_dir_esp($id_usr,$dir)
	{
		$q=$this->db->query("SELECT * from carpeta where id_carpeta=".$dir);
		$res=$q->result();
		$nivel=$res[0]->nivel+1;
		$q2=$this->db->query("SELECT * from carpeta where nivel=".$nivel." and debajo_de=".$dir." and id_usuario=".$id_usr);
		return $q2->result();
	}
	function info_dir($dir)
	{
		$q=$this->db->query("SELECT * from carpeta where id_carpeta=".$dir);
		return $q->result();
	}
	function add_file($id_usr,$nombre,$ruta)
	{
		$filename=strrev($nombre);
		$explode=explode(".",$filename);
		$nombre_s=strrev($explode[1]);
		$extencion=strrev($explode[0]);
		$ext=strtolower($extencion);
		$dato_file=array(
				"url"				=> 	$ruta.$nombre,
				"nombre_completo"	=>	$nombre,
				"nombre"			=>	$nombre_s,
				"extension"			=>	$ext,
				"estatus"			=>	"ACT",
				"id_usuario"		=>	$id_usr,
				"id_carpeta"		=>	$_POST["folder"]
			);
		$this->db->insert("archivo",$dato_file);
	}
	function get_archivos($dir,$id_usr)
	{
		$q=$this->db->query("SELECT * from archivo where id_carpeta=".$dir." and id_usuario=".$id_usr);
		return $q->result();
	}
}