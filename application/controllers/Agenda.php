<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	/*public function index(){

		//inicializando base_url
		$this->load->helper('url');

		$this->load->model('AgendaModel');
		$agenda = $this->AgendaModel->getAgenda();
		echo "<pre> teste"; print_r($agenda); exit;
		$data['agenda'] = $agenda;

		$this->load->view('home/index', $data);
	}
	*/

	public function cadastro($dataAgenda,$getHoraAgendada){

		//inicializando base_url
		$this->load->helper('url');

		$this->load->model('AgendaModel');
		$estadosBr = $this->AgendaModel->getEstadosBr();

		$data['dataAgenda'] 		= $dataAgenda;
		$data['getHoraAgendada']	= $getHoraAgendada;
		$data['estadosBr'] 			= $estadosBr;

		// echo "<pre>"; print_r($data); exit;

		$this->load->view('agendamento/CadastroPaciente',$data);
	}

	public function salvarCadastro(){

		$inputDataAgenda 	= $this->input->post('inputDataAgenda');
		$inputHoraAgendada 	= $this->input->post('inputHoraAgendada');
		$inputName 			= $this->input->post('inputName');
		$inputCpf 			= $this->input->post("inputCpf");
		$inputDate 			= $this->input->post("inputDate");
		$inputTel 			= $this->input->post("inputTel");
		$inputMedico 		= $this->input->post("inputMedico");
		$inputCep 			= $this->input->post("inputCep");
		$inputCidade 		= $this->input->post("inputCidade");
		$selectEstado 		= $this->input->post("selectEstado");
		$inputLogradouro 	= $this->input->post("inputLogradouro");
		$inputBairro 		= $this->input->post("inputBairro");
		$inputNumero 		= $this->input->post("inputNumero");
		$inputReferencia 	= $this->input->post("inputReferencia");

		$this->load->model('AgendaModel');

		$this->AgendaModel->setInputDataAgenda($inputDataAgenda);
		$this->AgendaModel->setInputHoraAgendada($inputHoraAgendada);
		$this->AgendaModel->setInputName($inputName);
		$this->AgendaModel->setinputCpf($inputCpf);
		$this->AgendaModel->setInputDate($inputDate);
		$this->AgendaModel->setInputTel($inputTel);
		$this->AgendaModel->setPesquisaMedico($inputMedico);
		$this->AgendaModel->setInputCep($inputCep);
		$this->AgendaModel->setInputCidade($inputCidade);
		$this->AgendaModel->setSelectEstado($selectEstado);
		$this->AgendaModel->setInputLogradouro($inputLogradouro);
		$this->AgendaModel->setInputBairro($inputBairro);
		$this->AgendaModel->setInputNumero($inputNumero);
		$this->AgendaModel->setInputReferencia($inputReferencia);

		echo json_encode ($this->AgendaModel->setCadastroPaciente());
	}

	public function editar(){

		//recebendo o idAgendamento para edição do cadastro
		$idAgendamento = $this->uri->segment(3);

		//inicializando base_url
		$this->load->helper('url');

		$this->load->model('AgendaModel');

		$this->AgendaModel->setIdAgendamento($idAgendamento);
		$dadosClienteAlteracao = $this->AgendaModel->getDadosClienteAlteracao();

		$data['dadosClienteAlteracao'] = $dadosClienteAlteracao;
		$this->load->view('agendamento/EditarPaciente',$data);
	}

	public function salvarEdicao(){
		
		$numTel = $this->input->post('numTel');
		$nomeMedico = $this->input->post('nomeMedico');
		$idAgendamentoEdicao = $this->input->post('idAgendamento');

		$this->load->model('AgendaModel');

		$this->AgendaModel->setNomeMedicoEdicao($nomeMedico);
		$this->AgendaModel->setNumTelefoneEdicao($numTel);
		$this->AgendaModel->setIdAgendamentoEdicao($idAgendamentoEdicao);

		echo json_encode ($this->AgendaModel->editarDadosPaciente());
	}

	public function cancelarAgendamento(){

		$idAgendamentoEdicao = $this->input->post('idAgendamento');
		$this->load->model('AgendaModel');
		$this->AgendaModel->setIdAgendamentoEdicao($idAgendamentoEdicao);
		echo json_encode ($this->AgendaModel->cancelarAgendamentoPacimente());

	}
}
