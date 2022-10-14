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
<div class="row align-items-center">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3"> 
            <div>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bx bx-plus me-1"></i> 
                    Novo Processo
                </button>
            </div> 
        </div>
    </div>
</div>
<!-- end row -->
<?= $this->session->flashdata('register') ?>
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="card border border-success">
            <div class="card-header bg-transparent border-success">
                <h5 class="my-0 text-success">
                    <i class="mdi mdi-check-all me-3"></i>
                    Processos IDESAM
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled chat-list"> 
                    <li class="unread">
                        <a href="#">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 user-img online align-self-center me-3">
                                    <div class="avatar-sm align-self-center">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            I
                                        </span>
                                    </div> 
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-13 mb-1">Processo de Castanha </h5>
                                    <p class="text-truncate mb-0">Fluxo do processo de Castanha</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="font-size-11">Atividades</div>
                                </div>
                                <div class="unread-message">
                                    <span class="badge bg-danger rounded-pill">1</span>
                                </div>
                            </div>
                        </a>
                    </li> 

                </ul>
            </div>
        </div> 
    </div> 
    <div class="col-lg-6  col-sm-12">
        <div class="card border border-primary ">
            <div class="card-header bg-transparent border-primary">
                <h5 class="my-0 text-primary">
                    <i class="mdi mdi-check-all me-3"></i>
                    Meus Processos
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled chat-list">
                    <? foreach($rows as $r){ ?>
                        <li class="unread">
                            <a href="<?=base_url($tela.'cadastro/'.$r->id)?>">
                                <div class="d-flex align-items-start"> 

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-13 mb-1"><?=$r->nm_processo?></h5>
                                        <small class="text-truncate mb-0">
                                            <?=$r->ds_processo?>
                                        </small>
                                    </div> 
                                    <div class="flex-shrink-1 user-img online align-self-center me-3">
                                        <div class="avatar-sm align-self-center" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Nº de Etapas">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                1
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-1 user-img online align-self-center me-3">
                                        <div class="avatar-sm align-self-center" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Nº de Tarefas">
                                            <span class="avatar-title rounded-circle bg-soft-success text-success">
                                                20
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Static Backdrop Modal -->
<div class="modal fade" 
     id="staticBackdrop" 
     data-bs-backdrop="static" 
     data-bs-keyboard="false" 
     tabindex="-1" 
     role="dialog" 
     aria-labelledby="staticBackdropLabel" 
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Novo Processo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url($tela . 'save') ?>" method="POST" enctype="multipart/form-data" name="frmRegistroModal" id="frmRegistroModal<?= date('dmY') ?>" data-form="frmRegistroModal">
                <div class="modal-body">
                    <div class="row" style="padding:5px">  

                        <div class="col-sm-6">
                            <label>Nome do Processo *</label>
                            <input required name="Register[nm_processo]" type="text" class="form-control"  />
                        </div>

                        <div class="col-sm-6">
                            <label>Produto alvo</label>
                            <select name="Register[id_produto]"  class="form-control" required>
                                <option value="">Selecione o produto</option>
                                <?php foreach($produtos as $p){?>
                                <option value="<?=$p->cd_produto?>"><?=$p->nm_produto?></option> 
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <label>Descrição do Processo*</label>
                            <textarea name="Register[ds_processo]" class="form-control"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Criar</button>
                </div>
                <input name="Op" type="hidden" value="I">
            </form>
        </div> 
    </div>
</div>