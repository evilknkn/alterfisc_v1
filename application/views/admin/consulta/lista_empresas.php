<ol class="breadcrumb hidden-xs">
    <li><a href="<?=base_url($this->session->userdata('base_perfil'))?>">Inicio</a></li>
   	<li>Lista de depósitos</li>
</ol>
<div class="block-area" id="responsiveTable">
    <h3 class="block-title">Lista de depósitos</h3>
    <?php if($this->session->flashdata('success')):?>
    <div class="text-center col-sm-12 col-xs-12">
        <div class="alert alert-success text-success text-center col-xs-6 col-sm-6"> <?php echo $this->session->flashdata('success');?></div>
    </div>
    <?php endif;?>

    <div class="table-responsive overflow">
    	
        <table class="table tile">
            <thead>
                <tr>
                    <th>Nombre de empresa</th>
                    <th>Banco</th>
                   <!--  <th>Total depósito</th>
                    <th>Total salida</th>
                    <th>Saldo</th> -->
                    <th class="tex-center">Detalle</th>
                </tr>
            </thead>
            <tbody>
            	<?php 
				foreach($empresas as $empresa): ?>
            	<tr>
            		<td><?=$empresa->nombre_empresa?></td>
            		<td><?=$empresa->nombre_banco?></td>
            		<td class="tex-center">
            			<a href="<?=base_url('cuentas/movimientos_internos/lista/'.$empresa->id_empresa.'/'.$empresa->id_banco)?>">
            				<i class="fa fa-search fa-lg"></i>
            			</a>
            		</td>
            	</tr>
            	<?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>