<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('tank_auth');
		$this->load->model("modelo_inicio");
	}
	public function index()
	{	
		if (!$this->tank_auth->is_logged_in()) {
			redirect('inicio/principal');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('inicio', $data);
		}
	}
	function principal()
	{	
		if ($this->tank_auth->is_logged_in()) {		
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();							// logged in
			$this->load->view('principal', $data);
		}
		else
		{
			$this->load->view('inicio');
		}
		
	}
	function hosting()
	{
		if(!$this->tank_auth->is_logged_in())
		{
			redirect('inicio/principal');
		}
		$id=$this->tank_auth->get_user_id();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();						// logged in
		if(!isset($_GET["d"]))
		{
			redirect('inicio/principal');
		}
		else
		{
			if($_GET["d"]==0)
			{
				$directorios=$this->modelo_inicio->get_dir($id);
				$data["directorio"]=$directorios;
				$data["nivel"]=0;
				$data["debajo"]=0;
				$data["url"]="/";
				$data["navegar"]="/";
				$files=$this->modelo_inicio->get_archivos($_GET["d"],$id);
				$data["file"]=$files;
			}
			else
			{
				$check=$this->modelo_inicio->check_dir($id,$_GET["d"]);
				if($check)
				{
					$directorios=$this->modelo_inicio->get_dir_esp($id,$_GET["d"]);
					$data["directorio"]=$directorios;
					$info_dir=$this->modelo_inicio->info_dir($_GET["d"]);
					$data["nivel"]=($info_dir[0]->nivel)+1;
					$data["debajo"]=$_GET["d"];
					$debajo=$info_dir[0]->debajo_de;
					$name_dir="/".$info_dir[0]->nombre."/";
					$navegar="/<a href='#'>".$info_dir[0]->nombre."</a>/";
					for($i=$info_dir[0]->nivel;$i>0;$i--)
					{
						$info=$this->modelo_inicio->info_dir($debajo);
						$name_dir="/".$info[0]->nombre.$name_dir;
						$navegar="/<a href='?d=".$info[0]->id_carpeta."'>".$info[0]->nombre."</a>".$navegar;
						$debajo=$info[0]->debajo_de;
					}
					$files=$this->modelo_inicio->get_archivos($_GET["d"],$id);
					$data["file"]=$files;
					$data["url"]=$name_dir;
					$data["navegar"]=$navegar;
				}
				else
				{
					redirect('inicio/principal');
				}
			}
		}
		$this->load->view('hosting', $data);

	}
	function up_file()
	{
		if(!$this->tank_auth->is_logged_in())
		{
			redirect('inicio/principal');
		}
		$id=$this->tank_auth->get_user_id();

		//Checamos si el directorio del usuario existe, si no, se crea
		if($_POST["folder"]==0)
		{
			if(!is_dir(getcwd()."\media\\".$id))
			{
				mkdir(getcwd()."\media\\".$id, 0777);
			}
			$ruta="\media\\".$id.'\\';
		}
		else
		{
			$info_dir=$this->modelo_inicio->info_dir($_POST["folder"]);
			$debajo=$info_dir[0]->debajo_de;
			$name_dir="\\".$info_dir[0]->nombre."\\";
			for($i=$info_dir[0]->nivel;$i>0;$i--)
			{
				$info=$this->modelo_inicio->info_dir($debajo);
				$name_dir="\\".$info[0]->nombre.$name_dir;
				$debajo=$info[0]->debajo_de;
			}
			$ruta="\media\\".$id.$name_dir;
			if(!is_dir(getcwd()."\media\\".$id.$name_dir))
			{
				mkdir(getcwd()."\media\\".$id.$name_dir, 0777);
			}
		}
		$config['upload_path'] = getcwd().$ruta;
		$config['allowed_types'] = 'mp4|gif|jpg|png|ppt|pptx|doc|docx|xls|xlsx|pdf|txt';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$nombre=$data['upload_data']['file_name'];
			$this->modelo_inicio->add_file($id,$nombre,$ruta);
			redirect('inicio/hosting?d='.$_POST["folder"]);
		}
	}
	function algo()
	{
		echo getcwd()."\media\\";
		echo form_open_multipart('upload/do_upload');
	}
	function new_dir()
	{
		if(!$this->tank_auth->is_logged_in())
		{
			redirect('inicio/principal');
		}
		$id=$this->tank_auth->get_user_id();
		if($_POST["lvl"]==0)
		{
			if(!is_dir(getcwd()."\media\\".$id."\\".$_POST["dirname"]))
			{
				mkdir(getcwd()."\media\\".$id."\\".$_POST["dirname"], 0777);
				$this->modelo_inicio->new_dir($id);
				echo "Se ha creado la carpeta con exito";
			}
			else
			{
				echo "La carpeta ya existe";
			}
		}
		else
		{
			$debajo=$_POST["bajo"];
			$name_dir="\\";
			for($i=$_POST["lvl"];$i>0;$i--)
			{
				$info=$this->modelo_inicio->info_dir($debajo);
				$name_dir="\\".$info[0]->nombre.$name_dir;
				$debajo=$info[0]->debajo_de;
			}
			if(!is_dir(getcwd()."\media\\".$id.$name_dir.$_POST["dirname"]))
			{
				mkdir(getcwd()."\media\\".$id."\\".$name_dir.$_POST["dirname"], 0777);
				$this->modelo_inicio->new_dir($id);
				echo "Se ha creado la carpeta con exito";
			}
			else
			{
				echo "La carpeta ya existe";
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */