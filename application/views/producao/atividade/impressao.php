<meta charset="utf-8">
<style>
    table{ 
        width: 800px;
        font-size: 11px;
        border-collapse: collapse;
    }
    table td{ 
        padding: 5px;
        vertical-align: top;
        font-size: 14px;
    }
    table, tr, td {
        border: none;
    } 
    .table table{ 
        width: 800px;
        font-size: 11px;
    }
    .table tr{ 
        padding: 5px;
        border: 1px solid #C9c9c9;
        vertical-align: top;
        font-size: 14px;
    }
    .table-b tr{ 
        padding: 5px;
        border-bottom: 1px solid #C9c9c9; 
        font-size: 14px;
    }
</style>
<table border="0" cellspacing="0" cellpadding="0" >
    <tr>                                        
        <td width="40%" style="padding: 10px 10px">
            <img src="<?= base_url('assets/images/logo.jpg') ?>" width="30%" /> 
        </td>
        <td width="60%" style="padding: 20px 10px; text-align: right">
            <h4>
                <?= $titulo ?><br>
                <?= $row->nm_atividade ?><br>
            </h4>
            <br>
            <h2>Nº <?= $row->id ?></h2>
        </td> 
    </tr> 
</table>
<h5>DADOS DA ATIVIDADE</h5>
<table class="table" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td><strong>Processo:</strong><br><?= $row->nm_processo ?></td> 
        <td style="width:50%"><strong>Atividade:</strong><br><?= $row->nm_atividade ?></td> 
    </tr> 
</table>
<table class="table" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td><strong>Quantidade:</strong><br><?= $row->qt_produto ?> Kg</td> 
        <td style="width:50%"><strong>Maquina:</strong><br><?= ($row->nm_maquina == '' ? '--' : $row->nm_maquina ) ?></td> 
    </tr> 
</table>
<table class="table" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td><strong>Inicio:</strong> <br>
            <?= date('d/m/Y', strtotime($row->dt_inicio)).' - '.$row->hr_inicio ?>  
        </td>
        <td style="width:50%"><strong>Fechamento:</strong> 
            <br>
            <?= (($row->dt_termino == '') ? '--/--/----' : date('d/m/Y', strtotime($row->dt_termino))) ?> - 
            <?= (($row->hr_termino == '') ? '--:--:--' : $row->hr_termino) ?>
        </td>
    </tr> 
</table>
<h5>CUSTOS DA ATIVIDADE - AJUDANTES</h5>

<table class="table" border="0" cellpadding="0" cellspacing="0"> 
    <tr> 
        <td><strong>Descrição</strong></td>
        <td style="width:20%; text-align: right"><strong>Valor Unit.</strong></td>  
        <td style="width:20%; text-align: right"><strong>Quantidade</strong></td> 
        <td style="width:20%; text-align: right"><strong>R$ Total</strong></td> 
    </tr> 
    <? $total = 0; foreach($itens as $r) { if($r->fl_custo == 'A') { ?>
    <tr>
        <td>
            <?php
            if ($r->fl_custo == 'A')
                echo $r->nm_ajudante . '<br><small>Ajudante</small>';
            else
                echo $r->nm_insumo . '<br><small>Insumo</small>';
            ?>
        </td>
        <td style="text-align: right">
            R$ <?= number_format($r->vl_unitario, 2, ',', '.') ?>
        </td>
        <td style="text-align: right"><?= number_format($r->qt_insumo, 3, ',', '.')  ?></td>
        <td style="text-align: right">R$ <?= number_format($r->vl_total, 2, ',', '.') ?></td>
        
    </tr>
    <? $total += $r->vl_total; } } ?>  
</table>

<h5>CUSTOS DA ATIVIDADE - INSUMOS</h5>

<table class="table" border="0" cellpadding="0" cellspacing="0"> 
    <tr> 
        <td><strong>Descrição</strong></td>
        <td style="width:20%; text-align: right"><strong>Valor Unit.</strong></td>  
        <td style="width:20%; text-align: right"><strong>Quantidade</strong></td> 
        <td style="width:20%; text-align: right"><strong>R$ Total</strong></td> 
    </tr> 
    <? $total = 0; foreach($itens as $r) { if($r->fl_custo == 'I') { ?>
    <tr>
        <td>
            <?php
            if ($r->fl_custo == 'A')
                echo $r->nm_ajudante . '<br><small>Ajudante</small>';
            else
                echo $r->nm_insumo . '<br><small>Insumo</small>';
            ?>
        </td>
        <td style="text-align: right">
            R$ <?= number_format($r->vl_unitario, 2, ',', '.') ?>
        </td>
        <td style="text-align: right"><?= number_format($r->qt_insumo, 3, ',', '.')  ?></td>
        <td style="text-align: right">R$ <?= number_format($r->vl_total, 2, ',', '.') ?></td>
        
    </tr>
    <? $total += $r->vl_total; } } ?>  
</table>
<br>

<table class="table" border="0" cellpadding="0" cellspacing="0">  
    
    <tr style="background: #eaeaea"> 
        <td  style="text-align: right">Custo Total</td> 
        <td style="text-align: right; width:20%">
            <strong style="text-align: right">R$ <?= number_format($row->vl_custo, 2, ',', '.') ?></strong>
        </td> 
    </tr>
</table>