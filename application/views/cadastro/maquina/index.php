<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18"><?= $titulo ?></h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Cadastro</li>
                    <li class="breadcrumb-item active"><?= $titulo ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?= $this->session->flashdata('register') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> 
                <div class="row">
                    <div class="col-lg-10">
                        <form action="<?= base_url($tela) ?>" method="POST" class="row gx-3 gy-2 align-items-center">
                            <div class="hstack gap-3"> 
                                <input value="<?= set_value('Filter[descricao]') ?>" name="Filter[descricao]" class="form-control me-auto" type="text" placeholder="Descrição">
                                <select name="Filter[fl_tipo]"  class="form-control me-auto">
                                    <option value="">Todos</option>
                                    <option <?=(set_value('Filter[fl_tipo]') == 'M' ? 'selected' : '')?> value="M">Máquina</option>
                                    <option <?=(set_value('Filter[fl_tipo]') == 'E' ? 'selected' : '')?> value="E">Equipamentos</option>
                                </select>
                                <button type="submit" class="btn btn-secondary">Pesquisar</button>
                                <div class="vr"></div>
                                <button 
                                    type="button" 
                                    class="btn btn-primary"
                                    data-bs-option="I"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#FormItem"
                                    >
                                    Adicionar
                                </button> 
                            </div>
                        </form>
                    </div> 
                </div>  
            </div>
            <div class="card-body"> 
                <div class="table-responsive m-t-10">
                    <table data-item-id="datatableview" class="table display table-hover  table-striped ">
                        <thead>
                            <tr>
                                <th style="width:5%">ID</th>
                                <th>Descrição</th>
                                <th style="width:15%">Valor</th>
                                <th style="width:5%">Ativo</th> 
                                <th style="width:5%"></th> 
                            </tr>
                        </thead> 
                        <tbody>
                            <? foreach($rows as $r) { ?>
                            <tr>
                                <td><?= $r->id ?></td>
                                <td><?= $r->nm_maquina?></td>
                                <td><?= number_format($r->vl_maquina,2,',','.')?></td>
                                <td><span class="badge badge-soft-<?=($r->fl_ativo == 'S' ? 'success' : 'danger' )?>"><?=($r->fl_ativo == 'S' ? 'Ativo' : 'Inativo' )?></span></td> 
                                <td>
                                    <div class="d-flex gap-3"> 
                                        <button 
                                            type="button" 
                                            class="text-success btn btn-link p-0"  
                                            data-bs-token="<?= base64_encode(json_encode($r)) ?>"
                                            data-bs-option="E"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#FormItem" 
                                           data-bs-toggle="tooltip" 
                                           data-bs-placement="top" 
                                           title="" 
                                           data-bs-original-title="Editar"
                                           >
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </button>
                                        <button
                                            type="button"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#FormItem"
                                            data-bs-option="D"
                                            data-bs-token="<?= base64_encode(json_encode($r)) ?>"
                                            class="text-danger btn btn-link p-0"  
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="" 
                                            data-bs-original-title="Editar">
                                            <i class="mdi mdi-trash-can font-size-18"></i>
                                        </button>
                                    </div> 
                                </td>
                            </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


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
            <form action="<?= base_url($tela . 'save') ?>" method="POST" enctype="multipart/form-data" name="formAtividade">
                <div class="modal-body">
                    <div class="row" style="padding:5px">
                        
                        <div class="col-sm-6 mt-2">
                            <label>Tipo</label>
                            <div class="mt-4 mt-md-0"> 
                                <div>
                                    <div class="form-check form-check-right mb-3">
                                        <input checked class="form-check-input" type="radio" name="Register[fl_tipo]" id="formRadiosRight1" value="M">
                                        <label class="form-check-label" for="formRadiosRight1">
                                            Maquina
                                        </label>
                                    </div>
                                    <div class="vr"></div>
                                    <div class="form-check form-check-right"> 
                                        <input class="form-check-input" type="radio" name="Register[fl_tipo]" id="formRadiosRight2" value="F">
                                        <label class="form-check-label" for="formRadiosRight2">
                                            Ferramenta
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12" data-item-id="id_maquina_tipo">
                            <label>Tipo de Maquina</label>
                            <select name="Register[id_maquina_tipo]"  class="form-control">
                                <option value="">Selecione a máquina</option>
                                <?php foreach ($tipo as $t) { ?>
                                    <option value="<?= $t->id ?>"><?= $t->nm_maquina_tipo ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-12" data-item-id="id_insumo">
                            <label>Ferramenta</label>
                            <select name="Register[id_insumo]"  class="form-control">
                                <option value="">Selecione a Ferramenta</option>
                                <?php foreach ($ferramenta as $t) { ?>
                                    <option value="<?= $t->cd_insumo ?>"><?= $t->nm_insumo ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-12">
                            <label>Descrição</label>
                            <input required name="Register[nm_maquina]" type="text" class="form-control"  />
                        </div>
                        
                        <div class="col-sm-12" data-item-id="id_fonte_energia">
                            <label>Fonte de Energia</label>
                            <select name="Register[id_fonte_energia]"  class="form-control">
                                <option value="">Selecione a fonte de energia</option>
                                <?php foreach($fonte as $f) { ?>
                                    <option value="<?= $f->id ?>"><?= $f->nm_fonte_energia ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                        
                        
                        <div class="col-sm-4">
                            <label>Valor (R$)</label>
                            <input required name="Register[vl_maquina]" type="text" class="form-control valor"  />
                        </div> 
                        
                        <div class="col-sm-4 mt-2" data-item-id="fl_horimetro">
                            <label>Horímetro</label>
                            <div class="mt-4 mt-md-0"> 
                                <div>
                                    <div class="form-check form-check-right mb-3">
                                        <input <?= ($row->fl_horimetro == 'S' ? 'checked' : '' ) ?> class="form-check-input" type="radio" name="Register[fl_horimetro]" id="formRadiosRight1" value="S">
                                        <label class="form-check-label" for="formRadiosRight1">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="vr"></div>
                                    <div class="form-check form-check-right"> 
                                        <input <?= ($row->fl_horimetro == 'N' ? 'checked' : '' ) ?> class="form-check-input" type="radio" name="Register[fl_horimetro]" id="formRadiosRight2" value="N">
                                        <label class="form-check-label" for="formRadiosRight2">
                                            Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div> 
                <input name="Register[id]" type="hidden"> 
                <input name="Op" type="hidden">  
            </form>
        </div> 
    </div>
</div>
<script src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        
        
        
        
        
        
        
        $('.valor').mask('0000000,00', {reverse: true}); 
        var ModalEl = document.getElementById('FormItem');
        ModalEl.addEventListener('show.bs.modal', function (event)
        {
            var button = event.relatedTarget;
            var Option = button.getAttribute('data-bs-option');
            $('[name="Op"]').val(Option);
            $('[type="submit"]').removeClass().addClass('btn btn-primary').html('Salvar');

            if(Option != 'I')
            {
                var token = button.getAttribute('data-bs-token');
                var ires = JSON.parse(atob(token));
                $('[name="Register[id]"]').val(ires.id);
                $('[name="Register[id_maquina_tipo]"]').val(ires.id_maquina_tipo);
                $('[name="Register[id_insumo]"]').val(ires.id_insumo).prop('disabled', false);
                $('[name="Register[fl_tipo]"]').val(ires.fl_tipo);
                $('[name="Register[id_insumo]"]').val(ires.id_insumo).prop('disabled', false);
                $('[name="Register[nm_maquina]"]').val(ires.nm_maquina).prop('disabled', false);
                $('[name="Register[id_fonte_energia]"]').val(ires.id_fonte_energia).prop('disabled', false);
                $('[name="Register[vl_maquina]"]').val(ires.vl_maquina).prop('disabled', false);
                $('[name="Register[fl_horimetro]"]').val(ires.fl_horimetro).prop('disabled', false);
                
                
                if(ires.fl_tipo == 'M'){
                    $('[data-item-id="id_insumo"]').hide();
                    $('[data-item-id="id_maquina_tipo"]').show();
                    $('[data-item-id="id_fonte_energia"]').show();
                    $('[data-item-id="fl_horimetro"]').show();
                }else{
                    $('[data-item-id="id_insumo"]').show();
                    $('[data-item-id="id_maquina_tipo"]').hide();
                    $('[data-item-id="id_fonte_energia"]').hide();
                    $('[data-item-id="fl_horimetro"]').hide();
                }
                 
            }
            if(Option == 'D')
            {
                $('[name="Register[id]"]').val(ires.id);
                $('[name="Register[id_maquina_tipo]"]').val(ires.id_maquina_tipo).prop('disabled', true);
                $('[name="Register[id_insumo]"]').val(ires.id_insumo).prop('disabled', true);
                $('[name="Register[fl_tipo]"]').val(ires.fl_tipo).prop('disabled', true);
                $('[name="Register[id_insumo]"]').val(ires.id_insumo).prop('disabled', true);
                $('[name="Register[nm_maquina]"]').val(ires.nm_maquina).prop('disabled', true);
                $('[name="Register[id_fonte_energia]"]').val(ires.id_fonte_energia).prop('disabled', true);
                $('[name="Register[vl_maquina]"]').val(ires.vl_maquina).prop('disabled', true);
                $('[name="Register[fl_horimetro]"]').val(ires.fl_horimetro).prop('disabled', true);
                $('[type="submit"]').removeClass().addClass('btn btn-danger').html('Deletar');
            }
        }); 
    });
</script>


