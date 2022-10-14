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
<div class="card">
    <div class="card-header bg-white">
        <?= $this->session->flashdata('register') ?>
    </div>
    <form action="<?= base_url($tela . 'save') ?>" method="POST" enctype="multipart/form-data" name="frmRegistroModal" id="frmRegistroModal<?= date('dmY') ?>" data-form="frmRegistroModal">
        <div class="card-body collapse show">
            <div class="row" style="padding:10px"> 
                <div class="col-sm-2">
                    <label>Código *</label>
                    <input readonly name="Register[id]" value="<?= $row->id ?>" type="text" class="form-control">
                </div> 
                
                <div class="col-sm-2">
                    <label>CPF*</label>
                    <input required name="Register[nr_cpf]" value="<?= $row->nr_cpf ?>" type="text" class="form-control"  />
                </div>

                <div class="col-sm-6">
                    <label>Nome Completo*</label>
                    <div class="input-group">
                        <input required name="Register[nm_ajudante]" value="<?= $row->nm_ajudante ?>" type="text" class="form-control"  />
                        <div class=" btn-group">
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Buscar em Associados">
                                <i class="mdi mdi-filter"></i>
                            </button>
                        </div> 
                    </div>
                    
                </div>
                
                <div class="col-sm-2">
                    <label>Apelido</label>
                    <input required name="Register[ds_apelido]" value="<?= $row->ds_apelido ?>" type="text" class="form-control"  />
                </div>
                
                <div class="col-sm-2">
                    <label>Telefone</label>
                    <input name="Register[nr_telefone]" value="<?= $row->nr_telefone ?>" type="text" class="form-control tel"  />
                </div>
                
                <div class="col-sm-2">
                    <label>Celular</label>
                    <input name="Register[nr_celular]" value="<?= $row->nr_celular ?>" type="text" class="form-control cel"  />
                </div>
                
                <div class="col-sm-2">
                    <label>Valor R$</label>
                    <input name="Register[vl_servico]" value="<?= $row->vl_servico ?>" type="text" class="form-control"  />
                </div>
                
                <div class="col-sm-3">
                    <label>Periodicidade de pagamento</label>
                    <select name="Register[fl_pagamento]"  class="form-control" required>
                        <option value="">Selecione</option>
                        <option <?=($row->fl_pagamento == 'D' ? 'selected' : '' )?> value="D">Diário</option>
                        <option <?=($row->fl_pagamento == 'M' ? 'selected' : '' )?> value="M">Mensal</option>
                        <option <?=($row->fl_pagamento == 'P' ? 'selected' : '' )?> value="P">Produção</option>
                    </select>
                </div>
                
                <div class="col-sm-6 mt-2">
                    <label>Status Ativo?</label>
                    <div class="mt-4 mt-md-0"> 
                        <div>
                            <div class="form-check form-check-right mb-3">
                                <input <?= ($row->fl_ativo == 'S' ? 'checked' : '' ) ?> class="form-check-input" type="radio" name="Register[fl_ativo]" id="formRadiosRight1" value="S">
                                <label class="form-check-label" for="formRadiosRight1">
                                    Sim
                                </label>
                            </div>
                            <div class="vr"></div>
                            <div class="form-check form-check-right"> 
                                <input <?= ($row->fl_ativo == 'N' ? 'checked' : '' ) ?> class="form-check-input" type="radio" name="Register[fl_ativo]" id="formRadiosRight2" value="N">
                                <label class="form-check-label" for="formRadiosRight2">
                                    Não
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>  
        </div>
        <div class="card-footer">
            <a href="<?= base_url($tela) ?>" class="btn btn-outline-danger"> 
                Cancelar
            </a>
            <button type="submit" class="btn btn-success pull-right"> 
                Salvar
            </button> 
        </div>
        <input name="Op" type="hidden" value="<?= ($row->id == '' ? 'I' : 'E') ?>">
    </form>
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