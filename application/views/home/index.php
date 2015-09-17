<?php
	$this->load->view('page/header');

	$beforeUrl = array('home','index',$this->AgendaModel->geraDataUrl($dataUrl,-1));
	$afterUrl  = array('home','index',$this->AgendaModel->geraDataUrl($dataUrl,+1));

?>
<style type="text/css">
	body > .container {padding: 70px 15px 0 0;}
</style>
<div class="container">
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<caption>
				<a href="<?=base_url($beforeUrl)?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
				<span><?=$diaSemana?>, <?=$diaMes?></span>
				<a href="<?=base_url($afterUrl)?>"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
			</caption>
			<thead>
				<tr>
					<th class="col-md-2">Hora</th>
					<th class="col-md-10">Paciente</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($agenda as $key => $horaAgenda){
						$segmentos = array('agenda', 'cadastro', $dataUrl, $horaAgenda->hora);
						if(!isset($horaAgenda->data_agendamento)){
				?>
							<tr>
								<td><a href="<?=base_url($segmentos)?>" data-fancybox-type="ajax" id="horaMarcada" title="Novo Agendamento"><?=$horaAgenda->descricao?></a></td>
								<td></td>
							</tr>
				<?php 	}else{ 
							$segmentos = array('agenda', 'editar', $horaAgenda->id_agendamento);
				?>
							<tr>
								<td><?=$horaAgenda->descricao?></td>
								<td><a href="<?=base_url($segmentos)?>" data-fancybox-type="ajax" id="horaMarcada" title="Editar Agendamento"><span class="glyphicon glyphicon-time" aria-hidden="true"></span><?=$horaAgenda->nome_pacimente?></a></td>
							</tr>
				<?php
						}
					} 
				?>
			</tbody>
		</table>
	</div>
</div>
<?php $this->load->view('page/footer');?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#horaMarcada").fancybox();
	});
</script>