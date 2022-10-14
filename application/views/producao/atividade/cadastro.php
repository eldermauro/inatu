<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">
                <a href="<?=base_url('producao/processo/'.$row->id_processo)?>" class="btn-link"> 
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
<div class="row align-items-center">
    <div class="col-md-6">
        <h4 class="mb-sm-0 font-size-18">
            <?=$row->nm_processo.' - '.$row->nm_produto?>
        </h4> 
    </div>
    <div class="col-md-6">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3"> 
            <div>
                <button class="btn btn-warning" data-bs-action="I" data-bs-whatever="Tools" data-bs-toggle="modal" data-bs-target="#FormItem">
                    <i class="bx bx-plus me-1"></i> 
                    Adicionar Insumo
                </button>
                <button class="btn btn-info" data-bs-action="I" data-bs-whatever="Person" data-bs-toggle="modal"  data-bs-target="#FormItem">
                    <i class="bx bx-plus me-1"></i> 
                    Adicionar Ajudante
                </button>
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
                        Atividade
                    </h5>
                    <div class="ms-auto">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-chevron-down font-size-20"></i> 
                            </a> 
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1" style="">
                                <a class="dropdown-item" 
                                   data-item-id="ModalExcluir"
                                   href="javascript:void(0)">
                                    Deletar
                                </a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="<?= base_url($tela . 'save') ?>" method="POST" enctype="multipart/form-data" name="frmRegistroModal" id="frmRegistroModal<?= date('dmY') ?>" data-form="frmRegistroModal">
                <div class="card-body">
                    <?= $this->session->flashdata('register') ?>
                    <div class="row" style="padding:5px">

                        <div class="col-sm-12">
                            <label>Atividade</label>
                            <select name="Register[id_atividade]"  class="form-control" required>
                                <option value="">Selecione o produto</option>
                                <?php foreach ($atividades as $a) { ?>
                                    <option <?= ($a->id == $row->id_atividade ? 'selected' : '') ?> data-item-id="<?= $p->id_maquina ?>" value="<?= $a->id ?>"><?= $a->nm_atividade ?></option> 
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-8">
                            <label>Produto alvo</label>
                            <select disabled name="Register[id_produto]"  class="form-control" required>
                                <option value="">Selecione o produto</option>
                                <?php foreach ($produto as $p) { ?>
                                    <option <?= ($p->cd_produto == $row->id_produto ? 'selected' : '') ?> value="<?= $p->cd_produto ?>"><?= $p->nm_produto ?></option> 
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label>Quantidade</label>
                            <input value="<?= $row->qt_produto ?>" required name="Register[qt_produto]" type="text" class="form-control"  />
                        </div>

                        <div class="col-sm-6">
                            <label>Data Início</label>
                            <input value="<?= $row->dt_inicio ?>" required name="Register[dt_inicio]" type="date" class="form-control bg-soft-warning"  />
                        </div>

                        <div class="col-sm-6">
                            <label>Hora Início</label>
                            <input value="<?= $row->hr_inicio ?>" required name="Register[hr_inicio]" type="time" class="form-control bg-soft-warning"  />
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Data Término</label>
                            <input value="<?= $row->dt_termino ?>" required name="Register[dt_termino]" type="date" class="form-control"  />
                        </div>

                        <div class="col-sm-6">
                            <label>Hora Término</label>
                            <input value="<?= $row->hr_termino ?>" required name="Register[hr_termino]" type="time" class="form-control"  />
                        </div>

                        <div class="col-sm-12">
                            <label>Máquina necessária</label>
                            <select name="Register[id_maquina_usina]"  class="form-control">
                                <option value="">Selecione a máquina</option>
                                <?php foreach ($maquina as $m) { ?>
                                    <option data-item-id="<?= $p->id_maquina_tipo ?>" value="<?= $p->nm_maquina ?>"><?= $p->id ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0"> 
                    <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                </div> 
                <input name="Op" type="hidden" value="I">
                <input name="Register[id_processo]" type="hidden" value="<?= $row->id ?>">
            </form>
        </div>
    </div>
    <div class="col-sm-8"> 
        <div class="card">
            <div class="card-header bg-transparent border-success">
                
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="my-0 text-success">
                        <i class="mdi mdi-check-all"></i>
                        Insumos e Ajudantes
                    </h5>
                    <div class="ms-auto">
                        <div class="font-size-24">
                            R$ <?= number_format($row->vl_custo,2,',','.')?>
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="card-body">
                <?= $this->session->flashdata('register_person') ?>
                 <div class="table-responsive m-t-10">
                    <table data-item-id="datatableview" class="table display table-hover ">
                        <thead>
                            <tr> 
                                <th>Descrição</th>
                                <th style="width:10%">Unit.</th>
                                <th style="width:10%">Quantidade</th>  
                                <th style="width:10%">Total</th>
                                <th style="width:5%"></th>
                            </tr>
                        </thead> 
                        <tbody>
                            <? $total = 0; foreach($itens as $r) { ?>
                            <tr>
                                <td>
                                    <?php
                                    if($r->fl_custo == 'A')
                                        echo $r->nm_ajudante.'<br><small>Ajudante</small>';
                                    else
                                        echo $r->nm_insumo.'<br><small>Insumo</small>';
                                    ?>
                                </td>
                                <td class="align-content-lg-end">
                                    <?= number_format($r->vl_unitario,2,',','.')?>
                                </td>
                                <td class="align-items-right"><?= $r->qt_insumo.' /'.($r->sg_medida == '' ? 'un' : $r->sg_medida)?></td>
                                <td class="align-items-right"><?= number_format($r->vl_total,2,',','.')?></td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <button
                                            type="button" 
                                            class="text-success btn btn-link p-0" 
                                            data-bs-whatever="<?=($r->fl_custo == 'A'? 'Person' : 'Tools')?>"
                                            data-bs-id="<?=$r->id ?>"
                                            data-bs-token="<?= base64_encode(json_encode($r)) ?>"
                                            data-bs-action="E"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#FormItem"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="" 
                                            data-bs-original-title="Editar">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </button>
                                        <button
                                            type="button"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#FormItemDel"
                                            class="text-danger btn btn-link p-0" 
                                            data-bs-id="<?=$r->id ?>"
                                            data-bs-atividade="<?=$r->id_atividade ?>"
                                            data-bs-processo="<?=$r->id_processo ?>"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="" 
                                            data-bs-original-title="Editar">
                                            <i class="mdi mdi-trash-can font-size-18"></i>
                                        </button>
                                    </div>
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
<!-- Static Backdrop Modal -->
<div class="modal fade"
     id="FormItem"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-labelledby="FormItem"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"> 
            <form action="<?= base_url($tela . 'item/save') ?>" method="POST" enctype="multipart/form-data" name="formAtividade">
                <div class="modal-body">
                    <div class="row" style="padding:5px">

                        <div class="col-sm-12 dv-ajudante">
                            <label>Ajudante</label>
                            <select name="Register[id_ajudante]"  class="form-control">
                                <option value="">Selecione o ajudante</option>
                                <?php foreach ($ajudante as $a) { ?>
                                    <option value="<?= $a->id ?>"><?= $a->nm_ajudante ?></option> 
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-12 dv-insumo">
                            <label>Insumo</label>
                            <select name="Register[id_insumo]"  class="form-control">
                                <option value="">Selecione o produto</option>
                                <?php foreach ($insumo as $p) { ?>
                                <option value="<?= $p->cd_insumo?>"><?= $p->nm_insumo?></option> 
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Quantidade</label>
                            <input required name="Register[qt_insumo]" type="text" class="form-control calculator qtd"  />
                        </div>
                        
                        <div class="col-sm-6">
                            <label>R$ Unitário</label>
                            <input required name="Register[vl_unitario]" type="text" class="form-control valor calculator"  />
                        </div>
                        
                        <div class="col-sm-12">
                            <label>R$ Total</label>
                            <input readonly name="Register[vl_total]" type="text" class="form-control font-size-24 valor"  />
                        </div>
                         
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div> 
                <input name="Register[id]" type="hidden">
                <input name="Register[fl_custo]" type="hidden">
                <input name="Op" type="hidden">
                <input name="Register[id_atividade]" type="hidden" value="<?= $row->id?>">
                <input name="Register[id_processo]" type="hidden" value="<?= $row->id_processo?>">
            </form>
        </div> 
    </div>
</div>


<div class="modal fade"
     id="FormItemDel"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-labelledby="FormItemDel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"> 
            <form action="<?= base_url($tela . 'item/save') ?>" method="POST" enctype="multipart/form-data" name="formAtividade">
                <div class="modal-body">
                     
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </div> 
                <input name="id" type="hidden"> 
                <input name="Op" value="D" type="hidden">
                <input name="atividade" type="hidden">
                <input name="processo" type="hidden">
            </form>
        </div> 
    </div>
</div>
<script src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script>
<script>
    $(document).ready(function()
    {
        $('.valor').mask('00000,00', {reverse: true});
        $('.qtd').mask('0000,000', {reverse: true});
        $('.valor').mask('00000,00', {reverse: true});

        $(document).on('change','.calculator', function(){
            var qtd = $('[name="Register[qt_insumo]"]').val();
            var vl = $('[name="Register[vl_unitario]"]').val();
            var tt = ( parseFloat(qtd.replace(',', '.')) * parseFloat(vl.replace(',', '.')));
            $('[name="Register[vl_total]"]').val( parseFloat(tt).toFixed(2).replace('.', ','));
            $('[name="Register[vl_total]"]').mask('00000,00');
        });

        var ModalEl = document.getElementById('FormItem');
        ModalEl.addEventListener('show.bs.modal', function (event)
        {
            var button = event.relatedTarget;
            var type = button.getAttribute('data-bs-whatever');
            var action = button.getAttribute('data-bs-action');
            var id = button.getAttribute('data-bs-id');  
            
            if(type == 'Person')
            {
                $('.dv-ajudante').show();
                $('.dv-insumo').hide();
                $('[name="Register[fl_custo]"]').val('A'); 
            }else{
                $('.dv-ajudante').hide();
                $('.dv-insumo').show();
                $('[name="Register[fl_custo]"]').val('I'); 
            }
            $('[name="Op"]').val(action);
            
            if(id != ''){
                var token = button.getAttribute('data-bs-token');
                $('[name="Register[id]"]').val(id);
                var ires = JSON.parse(atob(token));
                console.log(ires);
                $('[name="Register[id_ajudante]"]').val(ires.id_ajudante);
                $('[name="Register[id_insumo]"]').val(ires.id_insumo);
                $('[name="Register[vl_total]"]').val(ires.vl_total.replace('.', ','));
                $('[name="Register[vl_unitario]"]').val(ires.vl_unitario.replace('.', ','));
                $('[name="Register[qt_insumo]"]').val(ires.qt_insumo.replace('.', ','));
            } 
            
        });
        
        
        
        var ModalDel = document.getElementById('FormItemDel');
        ModalDel.addEventListener('show.bs.modal', function (event)
        {
            var button = event.relatedTarget;
            var atividade = button.getAttribute('data-bs-atividade'); 
            var id = button.getAttribute('data-bs-id');
            var processo = button.getAttribute('data-bs-processo');
            $('[name="id"]').val(id);
            $('[name="atividade"]').val(atividade);
            $('[name="processo"]').val(processo);
            
        });
        
    });
</script>