<?php
	// echo "<pre>"; print_r($dataAgenda);
		//echo "<pre>"; print_r($getHoraAgendada);
		// echo "<pre>"; print_r($estadosBr);
?>
<div class="modal-dialog">
	<div class="modal-content">
		<form class="form-horizontal" data-toggle="validator" role="form" id="CadastroPacienteForm" name="CadastroPacienteForm" method="post">
			<div class="modal-body">
				<div class="form-group">
					<label for="inputName" class="col-sm-4 control-label">Nome do paciente*</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="inputName" id="inputName" required>
						<input type="hidden" name="inputDataAgenda" id="inputDataAgenda" value="<?=$dataAgenda?>">
						<input type="hidden" name="inputHoraAgendada" id="inputHoraAgendada" value="<?=$getHoraAgendada?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputCpf" class="col-sm-4 control-label">CPF</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" name="inputCpf" id="inputCpf" >
					</div>
				</div>
				<div class="form-group">
					<label for="inputDate" class="col-sm-4 control-label">Data de nascimento*</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" name="inputDate" id="inputDate" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputTel" class="col-sm-4 control-label">Telefone*</label>
					<div class="col-sm-4">
						<input type="tel" class="form-control" name="inputTel" id="inputTel" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputMedico" class="col-sm-4 control-label">Médico responsável*</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="inputMedico" id="inputMedico" required/>
					</div>
				</div>
				<div class="form-group">
					<label for="inputCep" class="col-sm-4 control-label">Cep</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" name="inputCep" id="inputCep" >
					</div>
				</div>
				<div class="form-group">
					<label for="inputCidade" class="col-sm-4 control-label">Cidade</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="inputCidade" id="inputCidade" >
					</div>
					<label for="selectEstado" class="col-sm-1 control-label">Estado</label>
					<div class="col-sm-2">
						<!-- <input type="text" class="form-control" name="selectEstado" id="selectEstado" > -->
						<select class="form-control" name="selectEstado" id="selectEstado">
							<option value=""></option>
							<?php foreach ($estadosBr as $key => $valueEstadosBr) { ?>
									<option value="<?=$key?>"><?=$valueEstadosBr?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputLogradouro" class="col-sm-4 control-label">Logradouro</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="inputLogradouro" id="inputLogradouro" >
					</div>
				</div>
				<div class="form-group">
					<label for="inputBairro" class="col-sm-4 control-label">Bairro</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="inputBairro" id="inputBairro" >
					</div>
					<label for="inputNumero" class="col-sm-1 control-label">Número</label>
					<div class="col-sm-2">
						<input type="number" class="form-control" name="inputNumero" id="inputNumero" >
					</div>
				</div>
				<div class="form-group">
					<label for="inputReferencia" class="col-sm-4 control-label">Referência</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="inputReferencia" id="inputReferencia" >
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<span id="alertMessage" style="display:none;">Favor verificar os campos acima</span>
				<button type="submit" class="btn btn-success" id="ConfirmarCadastro">Confirmar</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
	$(document).ready(function() {


		//$('#CadastroPacienteForm').validator('validate');

		$('#ConfirmarCadastro').on('click', function (e) {

			var inputDataAgenda 	= $("#inputDataAgenda").val();
			var inputHoraAgendada 	= $("#inputHoraAgendada").val();
			var inputName 			= $("#inputName").val();
			var inputCpf 			= $("#inputCpf").val();
			var inputDate 			= $("#inputDate").val();
			var inputTel 			= $("#inputTel").val();
			var inputMedico 		= $("#inputMedico").val();
			var inputCep 			= $("#inputCep").val();
			var inputCidade 		= $("#inputCidade").val();
			var selectEstado 		= $("#selectEstado").val();
			var inputLogradouro 	= $("#inputLogradouro").val();
			var inputBairro 		= $("#inputBairro").val();
			var inputNumero 		= $("#inputNumero").val();
			var inputReferencia 	= $("#inputReferencia").val();

			$('form[name="CadastroPacienteForm"]').find('input,select,textarea').not('[type=submit]').jqBootstrapValidation({

			 		submitSuccess: function ($form, event) {
			 					$.post(site_url+'/agenda/salvarCadastro', {
									inputDataAgenda 	: inputDataAgenda,
									inputHoraAgendada 	: inputHoraAgendada,
									inputName 			: inputName,
									inputCpf 			: inputCpf,
									inputDate 			: inputDate,
									inputTel 			: inputTel,
									inputMedico 		: inputMedico,
									inputCep 			: inputCep,
									inputCidade 		: inputCidade,
									selectEstado 		: selectEstado,
									inputLogradouro 	: inputLogradouro,
									inputBairro 		: inputBairro,
									inputNumero 		: inputNumero,
									inputReferencia 	: inputReferencia
					    		}, function (retorno){
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

			 			 // will not trigger the default submission in favor of the ajax function
      					event.preventDefault();
			 		}
			 });
		});
	});	
</script>