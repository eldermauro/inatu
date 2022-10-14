<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">
                <a href="<?= base_url($tela) ?>" class="btn-link"> 
                    << Voltar 
                </a> 
                |
                <?= $titulo ?>
            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Controle de Acesso</li>
                    <li class="breadcrumb-item"><?= $titulo ?></li>
                    <li class="breadcrumb-item active">Cadastro</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row align-items-center">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3"> 
            <div>
                <button class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#ProcessoEtapa">
                    <i class="bx bx-plus me-1"></i> 
                    Adicionar Etapa
                </button>

                <button class="btn btn-soft-success" data-bs-toggle="modal" data-bs-target="#ProcessoAtividade">
                    <i class="bx bx-plus me-1"></i> 
                    Adicionar Atividade
                </button>
            </div> 
        </div>

    </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header font-size-16 border-0">
                <i class="mdi mdi-leaf"></i> 
                <?= $row->id . ' - ' . $row->nm_processo ?>
            </div>
            <div class="card-body">
                <ul class="list-unstyled chat-list"> 
                    <li class="unread">
                        <label>Nome do Processo *</label>
                        <input required value="<?= $row->nm_processo ?>" name="Register[nm_processo]" type="text" class="form-control"  />
                    </li>
                    <li class="unread">
                        <label>Produto alvo</label>
                        <select name="Register[id_produto]"  class="form-control" required>
                            <option value="">Selecione o produto</option>
                            <?php foreach ($produtos as $p) { ?>
                                <option <?= ($row->id_produto == $p->cd_produto ? 'selected' :'' ) ?> value="<?= $p->cd_produto ?>"><?= $p->nm_produto ?></option> 
                            <?php } ?>
                        </select>
                    </li>
                    <li class="unread">
                        <label>Descrição do Processo*</label>
                        <textarea name="Register[ds_processo]" rows="5" class="form-control"><?= $row->ds_processo ?></textarea>
                    </li>
                    <li class="unread">
                    </li>
                </ul>
            </div>
            <div class="card-footer border-0">
                <input name="Op" type="hidden" value="E">
                <input name="Register[id]" value="<?= $row->id ?>" type="hidden" />
                <?= $this->session->flashdata('register') ?>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header font-size-16">
                <i class="mdi mdi-sitemap"></i> 
                Etapas e Atividades
            </div>
            <div class="card-body p-0">
                <?= $this->session->flashdata('RegisterEtapa') ?>
                <ul class="list-unstyled chat-list border-0 p-0">
                    <? foreach($etapas as $et) { ?>
                    <li class="bg-soft-primary">
                        <a href="javascript:void(0)">
                            <div class="d-flex align-items-start border-0"> 
                                <div class="flex-shrink-1 user-img online align-self-center me-3">
                                    <div class="avatar-sm align-self-center" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Editar Etapa">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-0 overflow-hidden">
                                    <h5 class="text-truncate font-size-13 mb-1"><?=$et->nm_etapa?></h5>
                                    <small class="text-truncate mb-0">
                                        <?=$et->ds_etapa?>
                                    </small>
                                </div> 
                                 
                            </div>
                        </a>
                    </li>
                        <? 
                        foreach($atividades as $at) { 
                        if($et->id == $at->id_etapa){
                        ?>
                            <li class="">
                                <a href="javascript:void(0)">
                                    <h5 class="text-truncate font-size-13 mb-1">
                                                <?=$at->nm_atividade?>
                                            </h5>
                                </a>
                            </li>
                        <? } } ?>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
 
<? if($row->id != '') { ?>
<div class="card"> 
    <div class="card-body">
        <form action="<?= base_url($tela . 'save') ?>" method="POST" enctype="multipart/form-data" name="frmRegistroModal" id="frmRegistroModal<?= date('dmY') ?>" data-form="frmRegistroModal">
            <span class='font-size-20'>Deseja excluir esse registro?</span>
            <button type="submit" class="btn btn-danger align-items-right">
                Sim! Excluir
            </button>
            <input name="Op" type="hidden" value="D" />
            <input name="ID" value="<?= $row->id ?>" type="hidden" />
        </form>
    </div> 
</div>
<? } ?>

<script src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        $('[name="Register[nr_cpf]"]').mask('000.000.000-00', {reverse: true});
        $('.tel').mask('(00)0000-0000');
        $('.cel').mask('(00)00000-0000');
        $('[name="Register[vl_servico]"]').mask('0000,00', {reverse: true});
    });
</script>

<!-- Static Backdrop Modal -->
<div class="modal fade" 
     id="ProcessoEtapa" 
     data-bs-backdrop="static" 
     data-bs-keyboard="false" 
     tabindex="-1" 
     role="dialog" 
     aria-labelledby="staticBackdropLabel" 
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="staticBackdropLabel">Processo Etapa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url($tela . 'etapa/save') ?>" method="POST" enctype="multipart/form-data" name="frmRegistroModal" id="frmRegistroModal<?= date('dmY') ?>" data-form="frmRegistroModal">
                <div class="modal-body">
                    <div class="row" style="padding:5px">  

                        <div class="col-sm-12">
                            <label>Nome da Etapa *</label>
                            <input required name="Register[nm_etapa]" type="text" class="form-control"  />
                        </div> 

                        <div class="col-sm-12">
                            <label>Descrição da Etapa</label>
                            <textarea name="Register[ds_etapa]" class="form-control"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                <input name="Op" type="hidden" value="I">
                <input name="Register[id_processo]" value="<?= $row->id ?>" type="hidden" />
            </form>
        </div> 
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" 
     id="ProcessoAtividade" 
     data-bs-backdrop="static" 
     data-bs-keyboard="false" 
     tabindex="-1" 
     role="dialog" 
     aria-labelledby="staticBackdropLabel" 
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="staticBackdropLabel">Processo Etapa / Atividade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url($tela . 'atividade/save') ?>" method="POST" enctype="multipart/form-data" name="frmRegistroModal" id="frmRegistroModal<?= date('dmY') ?>" data-form="frmRegistroModal">
                <div class="modal-body">
                    <div class="row" style="padding:5px">  
                        
                        <div class="col-sm-12">
                            <label>Etapa *</label>
                            <select required name="Register[id_etapa]" class="form-control"> 
                                <option value="">Selecione a etapa</option>
                                <?php foreach ($etapas as $p) { ?>
                                    <option value="<?= $p->id ?>"><?= $p->nm_etapa ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-12">
                            <label>Utilização da máquina do tipo</label>
                            <select name="Register[id_maquina]" class="form-control"> 
                                <option value="">Selecione o tipo de máquina</option>
                                <?php foreach ($maquinatipo as $p) { ?>
                                    <option value="<?= $p->id ?>"><?= $p->nm_maquina_tipo ?></option> 
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <label>Nome da Atividade *</label>
                            <input required name="Register[nm_atividade]" type="text" class="form-control"  />
                        </div> 

                        <div class="col-sm-12">
                            <label>Descrição da Atividade</label>
                            <textarea name="Register[ds_atividade]" class="form-control"></textarea>
                        </div>
                        
                        
                        <div class="col-sm-12">
                            <label>Produto obtido no final da atividade *</label>
                            <select name="Register[id_produto_final]" class="form-control"> 
                                <option value="">Selecione o produto obtido</option>
                                <?php foreach ($etapas as $p) { ?>
                                    <option value="<?= $p->id ?>"><?= $p->nm_etapa ?></option> 
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                <input name="Op" type="hidden" value="I">
                <input name="Register[id_processo]" value="<?= $row->id ?>" type="hidden" />
            </form>
        </div> 
    </div>
</div>