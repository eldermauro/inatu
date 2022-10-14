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
                    <input readonly name="Register[cd_pessoa]" value="<?= $row->cd_pessoa ?>" type="text" class="form-control">
                </div> 

                <div class="col-sm-2">
                    <label>CPF*</label>
                    <input required name="Register[nr_cpf_cnpj]" value="<?= $row->nr_cpf_cnpj ?>" type="text" class="form-control"  />
                </div>

                <div class="col-sm-6">
                    <label>Nome Completo*</label> 
                    <input required name="Register[nm_pessoa]" value="<?= $row->nm_pessoa ?>" type="text" class="form-control"  />
                </div>

                <div class="col-sm-2">
                    <label>Apelido</label>
                    <input required name="Register[nm_apelido]" value="<?= $row->nm_apelido ?>" type="text" class="form-control"  />
                </div>

                <div class="col-sm-2">
                    <label>Telefone</label>
                    <input name="Register[nr_telefone]" value="<?= $row->nr_telefone ?>" type="text" class="form-control tel"  />
                </div>

                <div class="col-sm-2">
                    <label>Celular</label>
                    <input name="Register[nr_celular]" value="<?= $row->nr_celular ?>" type="text" class="form-control cel"  />
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
            <div class="row" style="padding:10px">
                <div class="col-md-2">
                    <label>CEP</label>
                    <input data-item="Cep" data-item-cep="Pessoa" name="Register[nr_cep]" value="<?= $row->nr_cep ?>" type="text" maxlength="9" class="form-control cep" >
                </div>
                <div class="col-md-7">
                    <label>Endereço*</label>
                    <input data-item-cep-logradouro="Pessoa" name="Register[ds_endereco]" value="<?= $row->ds_endereco ?>" type="text" class="form-control" >
                </div>
                <div class="col-md-3">
                    <label>Comunidade</label>
                    <input name="Register[nm_comunidade]" value="<?= $row->nm_comunidade ?>" type="text" class="form-control" >
                </div>
                <div class="col-md-4">
                    <label>Bairro</label>
                    <input data-item-cep-bairro="Pessoa" name="Register[nm_bairro]" value="<?= $row->nm_bairro ?>" type="text" class="form-control">
                </div>
                <div class="col-md-8">
                    <label>Complemento</label>
                    <input name="Register[ds_complemento]" value="<?= $row->ds_complemento ?>" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Cidade * </label>
                    <input data-item-cep-cidade="Pessoa" value="<?= $row->nm_cidade ?>" required type="text" name="Register[nm_cidade]" id="nm_cidade" class="form-control inputupper" data-layout="Upper" autocomplete="off" size="50" >
                </div>
                <div class="col-md-2">
                    <label>Estado</label>
                    <input maxlength="2" value="<?= $row->nm_estado ?>" data-item-cep-estado="Pessoa" name="Register[nm_estado]" type="text" class="form-control">
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
        <input name="Op" type="hidden" value="<?= ($row->cd_pessoa == '' ? 'I' : 'E') ?>">
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
            <input name="ID" value="<?= $row->cd_pessoa ?>" type="hidden" />
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