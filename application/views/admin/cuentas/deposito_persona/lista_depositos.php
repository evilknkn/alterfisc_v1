<!-- barra direccion-->
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ul class="breadcrumb">
        <li><a href="<?=base_url($this->session->userdata('base_perfil'))?>">Inicio</a></li>
        <li>Lista de depósitos</li>
    </ul>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
                <div class="page-header">
                    <h1>Lista de depósitos</h1>
                </div><!-- /   .page-header -->

                <div class="row">
                    <a href="<?=base_url()?>excel/exportaExcel/depositos_persona" class="btn btn-success"> <i class="icon-file"></i> Exportar a excel</a>
                    <br><br>
                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nombre de empresa</th>
                                <th>Banco</th>
                                <th>Total depósito</th>
                                <th>Total salida</th>
                                <th>Saldo</th>
                                <th class="tex-center">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_depto =0 ;
                            $total_salida =0 ;
                            $total_saldo = 0;
                            
                            foreach($empresas as $empresa): 

                            $depto  = montos($db_mov, $empresa->id_empresa, $empresa->id_banco, 'deposito');
                            $salida = montos($db_mov, $empresa->id_empresa, $empresa->id_banco, 'salida');

                            $saldo = $depto - $salida; 

                            $total_depto = $total_depto + $depto;
                            $total_salida = $total_salida + $salida;
                            $total_saldo = $total_saldo + $saldo;
                            ?>
                            <tr>
                                <td><?=$empresa->nombre_empresa?></td>
                                <td><?=$empresa->nombre_banco?></td>
                                <td>$<?=convierte_moneda($depto)?></td>
                                <td>$<?=convierte_moneda($salida)?></td>

                                <td>$<?=convierte_moneda($saldo)?></td>
                                <td class="tex-center">
                                    <a href="<?=base_url('cuentas/deposito_persona/detalle_cuenta/'.$empresa->id_empresa.'/'.$empresa->id_banco)?>">
                                        <i class="fa fa-search fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;
                            ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td class="text-right">Total </td>
                                <td class="">$<?=convierte_moneda($total_depto)?></td>
                                <td class="">$<?=convierte_moneda($total_salida)?></td>
                                <td class="">$<?=convierte_moneda($total_saldo)?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
<script src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript">
jQuery(function($) {
    var oTable1 = $('#sample-table-2').dataTable( {
        "pageLength": 50,
    "aoColumns": [
      { "bSortable": true },
        null, null, null, null,
      { "bSortable": false }
    ] } );
        
});
</script>