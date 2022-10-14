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
                    <div class="col-lg-6">
                        <form action="<?= base_url($tela) ?>" method="POST" class="row gx-3 gy-2 align-items-center">
                            <div class="hstack gap-3"> 
                                <input value="<?= set_value('Filter[descricao]') ?>" name="Filter[descricao]" class="form-control me-auto" type="text" placeholder="Descrição">
                                <button type="submit" class="btn btn-secondary">Pesquisar</button>
                                <div class="vr"></div>
                                <a href="<?= base_url($tela . 'cadastro') ?>" class="btn btn-success">
                                    Adicionar
                                </a>
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
                                <th>Nome</th>
                                <th style="width:15%">Celular</th>
                                <th style="width:5%">Ativo</th> 
                                <th style="width:5%"></th> 
                            </tr>
                        </thead> 
                        <tbody>
                            <? foreach($rows as $r) { ?>
                            <tr>
                                <td><?= $r->id ?></td>
                                <td><?= $r->nm_ajudante?></td>
                                <td><?= $r->nr_celular?></td>
                                <td><span class="badge badge-soft-<?=($r->fl_ativo == 'S' ? 'success' : 'danger' )?>"><?=($r->fl_ativo == 'S' ? 'Ativo' : 'Inativo' )?></span></td> 
                                <td>
                                    <div class="d-flex gap-3"> 
                                        <a href="<?= base_url($tela . $r->id . '') ?>" class="text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Editar">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a> 
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