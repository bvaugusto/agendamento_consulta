<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){

		//inicializando base_url
		$this->load->helper('url');

		//definindo o title da página
		$title = "Sistema de Agendamento";
		$data['url_title'] = url_title($title,' ');

		$this->load->model('AgendaModel');

		if($this->uri->segment(3)){
			$dataUrl = $this->uri->segment(3);
		}else{
			$dataUrl 	= $this->AgendaModel->geraDataUrl();
		}

		$getAgenda 	= $this->AgendaModel->getAgenda($dataUrl);
		$diaSemana 	= $this->AgendaModel->getDiaSemana($dataUrl);
		$diaMes 	= $this->AgendaModel->getDiaMes($dataUrl);

		$data['agenda'] 	= $getAgenda;
		$data['dataUrl'] 	= $dataUrl;
		$data['diaSemana']	= $diaSemana;
		$data['diaMes']		= $diaMes;

		$this->load->view('home/index', $data);
	}
}
