<ol class="breadcrumb hidden-xs">
    <li><a href="<?=base_url($this->session->userdata('base_perfil'))?>">Inicio</a></li>
   	<li>Lista de depósitos</li>
    <li>Movimientos internos</li>
</ol>

<div class="block-area" id="responsiveTable">
    <h3 class="block-title">Movimientos internos <?=$nombre_empresa?></h3>
    <?php if($this->session->flashdata('success')):?>
    <div class="text-center col-sm-12 col-xs-12">
        <div class="alert alert-success text-success text-center col-xs-6 col-sm-6"> <?php echo $this->session->flashdata('success');?></div>
    </div>
    <?php endif;?>

    <div class="clearfix"></div>

    <div class="text-center">
             <?php if($this->session->userdata('consulta') == 'inactive'):?>
             <a href="<?=base_url('cuentas/movimientos_internos/add_mov_interno/'.$id_empresa.'/'.$id_banco)?>" class="btn">Agregar movimiento</a>
            <a class="btn" href="<?=base_url('cuentas/depositos/detalle_cuenta/'.$id_empresa.'/'.$id_banco)?>" style="margin-left:15px"> 
            <?php else:?>
            <a class="btn" href="<?=base_url($this->session->userdata('base_perfil'))?>">
            <?php endif;?>
                <i class="fa fa-undo"></i> Regresar</a>
        </div>
    <br>
    <div class="table-responsive overflow">
    	
        <table class="table tile">
            <thead>
                <tr>
                    <th>Nombre de empresa</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Folio entrada</th>
                    <th>Folio salida</th>
                     <?php if($this->session->userdata('consulta')=='active'):?>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Borrar</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php if(count($movimientos)>0):?>
                <?php foreach($movimientos as $movimiento):?>
            	   <tr>
                        <td><?=nombre_empresa($db, $movimiento->empresa_destino)?></td>
                        <td><?=formato_fecha_ddmmaaaa($movimiento->fecha_mov)?></td>
                        <td>$<?=convierte_moneda($movimiento->monto)?></td>
                        <td><?=$movimiento->folio_entrada?></td>
                        <td><?=$movimiento->folio_salida?></td>
                        <?php if($this->session->userdata('consulta')=='active'):?>
                        <td class="text-center">
                            <a href="<?=base_url('cuentas/movimientos_internos/editar_movimiento/'.$id_empresa.'/'.$id_banco.'/'.$movimiento->id_movimiento)?>"> 
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="<?=base_url('cuentas/mov_delete/movimiento_interno/'.$id_empresa.'/'.$id_banco.'/'.$movimiento->id_movimiento)?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        <?php endif;?>
                   </tr>
                <?php endforeach; ?>
                <?php else:?>
                    <tr>
                        <td colspan="7" class="text-center"> -- No hay datos disponibles -- </td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>

        <div class="text-center">
             <?php if($this->session->userdata('consulta')=='active'):?>
            <a class="btn" href="<?=base_url('cuentas/depositos/detalle_cuenta/'.$id_empresa.'/'.$id_banco)?>"> 
            <?php else:?>
            <a class="btn" href="<?=base_url($this->session->userdata('base_perfil'))?>">
            <?php endif;?>
                <i class="fa fa-undo"></i> Regresar</a>
        </div>
    </div>
</div>