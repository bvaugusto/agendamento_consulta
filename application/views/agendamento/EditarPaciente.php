<div class="modal-dialog">
	<div class="modal-content">
		<form class="form-horizontal" data-toggle="validator" role="form" id="CadastroPacienteForm" method="post">
			<div class="modal-body">
				<div class="form-group">
					<label for="inputName" class="col-sm-4 control-label">Nome do paciente</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="inputName" id="inputName" readonly="readonly" value="<?=$dadosClienteAlteracao->nome?>">
						<input type="hidden" name="idAgendamento" id="idAgendamento" value="<?=$dadosClienteAlteracao->id_agendamento?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputCpf" class="col-sm-4 control-label">CPF</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" name="inputCpf" id="inputCpf" readonly="readonly" value="<?=$dadosClienteAlteracao->cpf?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputDate" class="col-sm-4 control-label">Data de nascimento</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" name="inputDate" id="inputDate" readonly="readonly" value="<?=$dadosClienteAlteracao->data_nascimento?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputTel" class="col-sm-4 control-label">Telefone*</label>
					<div class="col-sm-4">
						<input type="tel" class="form-control" name="inputTel" id="inputTel" value="<?=$dadosClienteAlteracao->num_telefone?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputMedico" class="col-sm-4 control-label">Médico responsável*</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="inputMedico" id="inputMedico" value="<?=$dadosClienteAlteracao->nome_medico?>" required />
					</div>
				</div>
				<div class="form-group">
					<label for="inputCep" class="col-sm-4 control-label">Cep</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" name="inputCep" id="inputCep" readonly="readonly" value="<?=$dadosClienteAlteracao->cep?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputCidade" class="col-sm-4 control-label">Cidade</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="inputCidade" id="inputCidade" readonly="readonly" value="<?=$dadosClienteAlteracao->cidade?>">
					</div>
					<label for="selectEstado" class="col-sm-1 control-label">Estado</label>
					<div class="col-sm-2">
						<!-- <input type="text" class="form-control" name="selectEstado" id="selectEstado" > -->
						<select class="form-control" name="selectEstado" readonly="readonly">
							<option  value="<?=$dadosClienteAlteracao->data_nascimento?>"><?=$dadosClienteAlteracao->estado?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputLogradouro" class="col-sm-4 control-label">Logradouro</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="inputLogradouro" id="inputLogradouro" readonly="readonly" value="<?=$dadosClienteAlteracao->logradouro?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputBairro" class="col-sm-4 control-label">Bairro</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="inputBairro" id="inputBairro" readonly="readonly" value="<?=$dadosClienteAlteracao->bairro?>">
					</div>
					<label for="inputNumero" class="col-sm-1 control-label">Número</label>
					<div class="col-sm-2">
						<input type="number" class="form-control" name="inputNumero" id="inputNumero" readonly="readonly" value="<?=$dadosClienteAlteracao->numero_logradouro?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputReferencia" class="col-sm-4 control-label">Referência</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="inputReferencia" id="inputReferencia" readonly="readonly" value="<?=$dadosClienteAlteracao->referencia?>">
					</div>
				</div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" id="CancelarAgendamento">Cancelar</button>
				<button type="button" class="btn btn-success" id="ConfirmarCadastro">Confirmar</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">

	$(document).ready(function() {

		//alimentando as variáveis javascript com os valores de base_url,site_url 
		console.log('base_url '+base_url);
		console.log('site_url '+site_url);

		$('#ConfirmarCadastro').click(function(event) {
			var numTel 			= $("#inputTel").val();
			var nomeMedico 		= $("#inputMedico").val();
			var idAgendamento 	= $("#idAgendamento").val();

			$.post(site_url+'/agenda/salvarEdicao', {
				numTel: numTel,
				nomeMedico: nomeMedico,
				numTel: numTel,
				idAgendamento: idAgendamento
			}, 
				function(retorno) {
					if(retorno.success){
						$.fancybox.close();
						$.blockUI({ message: retorno.msg });
						setTimeout(function(){
							// header('location:'+base_url);
							document.location.href = base_url;
							$.unblockUI();
						}, 2000);
					}else{
						$.blockUI({ message: 'Falha ao editar agendamento!' });
						setTimeout(function(){
							document.location.href = base_url;
							$.unblockUI();
						}, 2000);
					}
			},'json');
		});

		$('#CancelarAgendamento').click(function(event) {

			var idAgendamento 	= $("#idAgendamento").val();

			$.post(site_url+'/agenda/cancelarAgendamento', {
				idAgendamento: idAgendamento
			}, 
				function(retorno) {
					if(retorno.success){
						$.fancybox.close();
						$.blockUI({ message: retorno.msg });
						setTimeout(function(){
							document.location.href = base_url;
							$.unblockUI();
						}, 2000);
					}else{
						$.fancybox.close();
						$.blockUI({ message: 'Falha ao cancelar agendamento!' });
						setTimeout(function(){
							document.location.href = base_url;
							$.unblockUI();
						}, 2000);
					}
			},'json');
		});
	});	
</script>