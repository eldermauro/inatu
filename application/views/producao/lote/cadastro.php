<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">
                <a href="<?= base_url($tela)?>" class="btn-link"> 
                    << Voltar 
                </a> 
                |
                <?= $titulo ?>
            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Produção</li>
                    <li class="breadcrumb-item active"><?= $titulo ?></li> 
                </ol>
            </div>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header bg-transparent border-primary"> 
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="my-0 text-primary">
                        <i class="mdi mdi-check-all"></i>
                        Dados do Lote
                    </h5> 
                </div>
            </div>
            <div class="card-body">
                    <div class="row" style="padding:5px">
                          
                        <div class="col-sm-12">
                            <label>Quantidade</label>
                            <input value="<?= $row->nm_produtotipo.' de '.$row->nm_produto ?>" readonly class="form-control"  />
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Lote</label>
                            <input value="<?= $row->nr_lote ?>" readonly class="form-control"  />
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Nº IDESAM</label>
                            <input value="<?= $row->nr_idesam ?>" readonly class="form-control"  />
                        </div>
                        
                    </div>
                </div>  
        </div>
    </div>
    <div class="col-sm-8"> 
        <div class="card">
            <div class="card-header bg-transparent border-success"> 
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="my-0 text-success">
                        <i class="mdi mdi-check-all"></i>
                        Composição do Lote
                    </h5> 
                </div> 
            </div> 
            <div class="card-body"> 
                 <div class="table-responsive m-t-10">
                    <table data-item-id="datatableview" class="table display table-hover ">
                        <thead>
                            <tr> 
                                <th>Descrição</th>
                                <th class="text-center" style="width:15%">Quantidade.</th>
                                <th class="text-center" style="width:15%">Aprovado</th>  
                                <th class="text-center" style="width:15%">Total R$</th> 
                            </tr>
                        </thead> 
                        <tbody>
                            <? $total = 0; foreach($itens as $r) { ?>
                            <tr>
                                <td>
                                    <small><?=$r->nm_produtor?></small><br/>
                                    <strong><?=$r->nm_produto?></strong>
                                </td>
                                <td class="text-center">
                                    <?=$r->nr_quantidade?> Kg
                                </td>
                                <td class="text-center">
                                    <?=$r->nr_aprovado?> Kg
                                </td>
                                 <td class="align-right">
                                    R$ <?= number_format($r->vl_compra,2,',','.')?>
                                 </td> 
                            </tr>
                            <? $total += $r->vl_total; }?>
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div> 
<script src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script> 