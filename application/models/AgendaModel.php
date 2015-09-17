<?php
	class AgendaModel extends CI_Model {

		public $idAgendamento;

		//variáveis public para edição
		public $nomeMedicoEdicao;
		public $numTelefoneEdicao;
		public $idAgendamentoEdicao;

		//variáveis public para cadastro
		public $inputName;
		public $inputCpf;
		public $inputDate;
		public $inputTel;
		public $pesquisaMedico;
		public $inputCep;
		public $inputCidade;
		public $selectEstado;
		public $inputLogradouro;
		public $inputBairro;
		public $inputNumero;
		public $inputReferencia;
		public $inputDataAgenda;
		public $inputHoraAgendada;

		public function __construct(){
		 	parent::__construct();
        }
		public function setIdAgendamento($idAgendamento) {
			$this->idAgendamento = $idAgendamento;
		}
		public function setNomeMedicoEdicao($nomeMedicoEdicao) {
			$this->nomeMedicoEdicao = $nomeMedicoEdicao;
		}
		public function setNumTelefoneEdicao($numTelefoneEdicao) {
			$this->numTelefoneEdicao = $numTelefoneEdicao;
		}
		public function setIdAgendamentoEdicao($idAgendamentoEdicao) {
			$this->idAgendamentoEdicao = $idAgendamentoEdicao;
		}
		public function setInputDataAgenda($inputDataAgenda){
			$this->inputDataAgenda = $inputDataAgenda;
		}
		public function setInputHoraAgendada($inputHoraAgendada){
			$this->inputHoraAgendada = $inputHoraAgendada;
		}
		public function setInputName($inputName){
			$this->inputName = $inputName;
		}
		public function setinputCpf($inputCpf){
			$this->inputCpf = $inputCpf;
		}
		public function setInputDate($inputDate){
			$this->inputDate = $inputDate;
		}
		public function setInputTel($inputTel){
			$this->inputTel = $inputTel;
		}
		public function setPesquisaMedico($pesquisaMedico){
			$this->pesquisaMedico = $pesquisaMedico;
		}
		public function setInputCep($inputCep){
			$this->inputCep = $inputCep;
		}
		public function setInputCidade($inputCidade){
			$this->inputCidade = $inputCidade;
		}
		public function setSelectEstado($selectEstado){
			$this->selectEstado = $selectEstado;
		}
		public function setInputLogradouro($inputLogradouro){
			$this->inputLogradouro = $inputLogradouro;
		}
		public function setInputBairro($inputBairro){
			$this->inputBairro = $inputBairro;
		}
		public function setInputNumero($inputNumero){
			$this->inputNumero = $inputNumero;
		}
		public function setInputReferencia($inputReferencia){
			$this->inputReferencia = $inputReferencia;
		}

		public function getHoraAgenda(){

			$horaAgenda = array(
							'00' => '00:00', 
							'01' => '01:00', 
							'02' => '02:00', 
							'03' => '03:00', 
							'04' => '04:00', 
							'05' => '05:00', 
							'06' => '06:00', 
							'07' => '07:00', 
							'08' => '08:00', 
							'09' => '09:00', 
							'10' => '10:00', 
							'11' => '11:00', 
							'12' => '12:00', 
							'13' => '13:00', 
							'14' => '14:00', 
							'15' => '15:00', 
							'16' => '16:00', 
							'17' => '17:00', 
							'18' => '18:00', 
							'19' => '19:00', 
							'20' => '20:00', 
							'21' => '21:00', 
							'22' => '22:00', 
							'23' => '23:00'
						);
			return $horaAgenda;
		}

		public function getEstadosBr(){
			$estadosBr = array(
							'AC' =>	'AC',
							'AL' =>	'AL',
							'AP' =>	'AP',
							'AM' =>	'AM',
							'BA' =>	'BA',
							'CE' =>	'CE',
							'DF' =>	'DF',
							'ES' =>	'ES',
							'GO' =>	'GO',
							'MA' =>	'MA',
							'MT' =>	'MT',
							'MS' =>	'MS',
							'MG' =>	'MG',
							'PA' =>	'PA',
							'PB' =>	'PB',
							'PR' =>	'PR',
							'PE' =>	'PE',
							'PI' =>	'PI',
							'RJ' =>	'RJ',
							'RN' =>	'RN',
							'RS' =>	'RS',
							'RO' =>	'RO',
							'RR' =>	'RR',
							'SC' =>	'SC',
							'SP' =>	'SP',
							'SE' =>	'SE',
							'TO' =>	'TO',
						);
			return $estadosBr;
		}

		public function getAgenda($dataUrl = null){

			if(!$dataUrl){
				$dataUrl = 'CURDATE()';
			}else{
				$dataUrl = "'$dataUrl'";
			}

			$sql = "SELECT 
						T1.hora,T1.descricao,
						T2.id AS id_agendamento,T2.status,
						T2.data_agendamento,
						DATE_FORMAT(T2.hora_agendamento,'%H:%i') AS hora_agendamento,
						T3.nome AS nome_pacimente
					FROM 
						tbhoraagenda T1
						LEFT OUTER JOIN tbagendamento T2 ON T2.id_hora = T1.hora AND T2.data_agendamento = $dataUrl AND T2.status = 'A'
						LEFT OUTER JOIN tbpaciente T3 ON T3.id_agendamento = T2.id
						ORDER BY T1.hora
					";
			$query = $this->db->query($sql);
			return $query->result ();
		}

		public function getDiaSemana($diaSemana){

			$diaSemana = date( 'N', strtotime( $diaSemana ) );
			switch ($diaSemana) {
				case 1:
					$diaSemana = 'Segunda';
					break;
				case 2:
					$diaSemana = 'Terça';
					break;
				case 3:
					$diaSemana = 'Quarta';
					break;
				case 4:
					$diaSemana = 'Quinta';
					break;
				case 5:
					$diaSemana = 'Sexta';
					break;
				case 6:
					$diaSemana = 'Sábado';
					break;
				case 7:
					$diaSemana = 'Domingo';
					break;
			}
			return $diaSemana;
		}

		public function geraDataUrl($dataUrl = null, $dias = null){

			if(!$dias){
				$dataUrl = date('Y-m-d');
			}else{
				$dataUrl 	= date('Y-m-d', strtotime($dias." days",strtotime($dataUrl)));
			}
			return $dataUrl = $dataUrl;
		}

		public function getDiaMes($diaMes){
			$diaMes = date( 'd M, Y', strtotime( $diaMes ) );
			return $diaMes;
		}

		public function getDadosClienteAlteracao(){

			$sql = 'SELECT 
						T2.id_agendamento,
						T2.nome_medico,
						T2.nome,
						T2.data_nascimento,
						T2.cpf,
						T2.num_telefone,
						T2.cep,
						T2.estado,
						T2.cidade,
						T2.logradouro,
						T2.numero_logradouro,
						T2.bairro,
						T2.referencia
					FROM 
						tbagendamento T1
						INNER JOIN tbpaciente T2 ON T2.id_agendamento = T1.id
					WHERE
						T1.id = '.$this->idAgendamento;
			$query = $this->db->query($sql);
			$dados = $query->row ();

			if (is_object($dados)) {
				return $dados;
			} else {
				return false;
			}
		}

		public function setCadastroPaciente(){


			$insert = "INSERT INTO tbagendamento
						            (id_hora,
						             data_agendamento,
						             hora_agendamento
						        	)
						VALUES ('".$this->inputHoraAgendada."',
						        '".$this->inputDataAgenda."',
						        CURTIME()
						        )
			";
			$this->db->query($insert);
		
			if ($this->db->affected_rows () > 0) {
				$idAgendamento =  $this->db->insert_id ();

				$sql = "INSERT INTO tbpaciente
						            (id_agendamento,
						             nome_medico,
						             nome,
						             data_nascimento,
						             cpf,
						             num_telefone,
						             cep,
						             estado,
						             cidade,
						             logradouro,
						             numero_logradouro,
						             bairro,
						             referencia)
						VALUES ('".$idAgendamento."',
						        '".$this->pesquisaMedico."',
						        '".$this->inputName."',
						        '".$this->inputDate."',
						        '".$this->inputCpf."',
						        '".$this->inputTel."',
						        '".$this->inputCep."',
						        '".$this->selectEstado."',
						        '".$this->inputCidade."',
						        '".$this->inputLogradouro."',
						        '".$this->inputNumero."',
						        '".$this->inputBairro."',
						        '".$this->inputReferencia."');
				";
				if($this->db->query($sql)){
					echo '{"success":true, "msg":"Agendamento cadastrado com sucesso!"}';
					exit;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		public function editarDadosPaciente(){

			$sql = 'UPDATE
							tbpaciente
						SET
							nome_medico = "'.$this->nomeMedicoEdicao.'",
							num_telefone = "'.$this->numTelefoneEdicao.'"
						WHERE
							id_agendamento = '.$this->idAgendamentoEdicao
					;
			if($this->db->query($sql)){
				echo '{"success":true, "msg":"Paciente editado com sucesso!"}';
				exit;
			}else{
				return false;
			}
		}

		public function cancelarAgendamentoPacimente(){

			$sql = "UPDATE
							tbagendamento
						SET
							status = 'C'
						WHERE
							id = ".$this->idAgendamentoEdicao
					;
			if($this->db->query($sql)){
				echo '{"success":true, "msg":"Paciente cancelado com sucesso!"}';
				exit;
			}else{
				return false;
			}

		}
	}
?>