<?php 
class Pendiente_retorno extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('USERNAME') == '' ){
			
            $regresar = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://' ) . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
            redirect( base_url() . 'login/index?r='.urlencode($regresar) );
        }
       
    }
    
	public function index()
	{	
		$this->load->model('cuentas/retorno_model');
		$this->load->helper('funciones_externas');

		$data = array(	'menu' 	=>  'menu/menu_admin',
						'body'	=>	'admin/cuentas/pendiente_retorno/lista_empresas');
		
		$data['empresas'] = $this->retorno_model->lista_empresas(array('ace.tipo_usuario' => 1));
		$data['db'] = $this->retorno_model;

		$this->load->view('layer/layerout',$data);
	}

	public function detalle_retorno($id_empresa, $id_banco)
	{
		$this->load->model('cuentas/retorno_model');
		$this->load->helper('funciones_externas');

		$data = array(	'menu' 	=>  'menu/menu_admin',
						'body'	=>	'admin/cuentas/pendiente_retorno/desgloce_pendiente_retorno');

		$data['db'] = $this->retorno_model;
		$data['id_empresa']	= $id_empresa;
		$data['id_banco'] 	= $id_banco;
		
		$filtro = array('adc.id_empresa' => $id_empresa, 'adc.id_banco' => $id_banco, 'adc.tipo_movimiento' => 'deposito');
		$data['depositos'] = $this->retorno_model->detalle_retorno($filtro);
		$this->load->view('layer/layerout',$data);
	}

	public function pendiente_retorno_general()
	{
		$this->load->model('cuentas/retorno_model');
		$this->load->helper('funciones_externas');

		if($this->input->post('id_empresa'))
		{
			$id_empresa = $this->input->post('id_empresa');
		}


		$data = array(	'menu' 	=>  'menu/menu_admin',
						'body'	=>	'admin/cuentas/pendiente_retorno/retorno_pendiente_general');

		$data['catalogo_empresas'] = $this->retorno_model->all_empresas();
		if(isset($id_empresa) and $id_empresa >0):
			$data['empresas'] = $this->retorno_model->empresa_general_filtro($id_empresa);
		else:
			$data['empresas'] = $this->retorno_model->empresas_general();
		endif;
		$data['db'] = $this->retorno_model;

		$this->load->view('layer/layerout', $data);
	}



}