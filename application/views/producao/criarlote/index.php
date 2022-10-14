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
            <div class="card-header bg-transparent border-primary">
                <h5 class="my-0 text-primary">
                    <i class="mdi mdi-check-all me-3"></i>
                    <?= $titulo ?>
                </h5>
            </div>
            <div class="card-header"> 
                <div class="row">
                    <div class="col-lg-12">
                        <form action="<?= base_url($tela) ?>" method="POST" class="row gx-3 gy-2 align-items-center">
                            <div class="hstack gap-3">
                                <select name="Filter[cd_produtor]" class="form-control">
                                    <option value="">Selecione o Produtor</option>
                                    <? foreach ($produtor as $p) { ?>
                                    <option <?= ((set_value('Filter[cd_produtor]') == $p->cd_pessoa) ? 'selected' : '') ?> value="<?= $p->cd_pessoa ?>"><?= $p->nm_pessoa ?></option>
                                    <? } ?>
                                </select>
                                <select name="Filter[cd_produto]" class="form-control">
                                    <option value="">Selecione o Produto</option>
                                    <? foreach ($produto as $p) { ?>
                                    <option <?= ((set_value('Filter[cd_produto]') == $p->cd_produto) ? 'selected' : '') ?> value="  <?= $p->cd_produto ?>"><?= $p->nm_produto ?></option>
                                    <? } ?>
                                </select>
                                <input value="<?= set_value('Filter[descricao]') ?>" name="Filter[descricao]" class="form-control me-auto" type="text" placeholder="Descrição">
                                <button type="submit" class="btn btn-secondary">Pesquisar</button>
                                <div class="vr"></div>
                                <button 
                                    class="btn btn-primary"
                                    type="button"
                                    data-bs-option="I"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#FormItem"

                                    > 
                                    Avulso
                                </button>
                            </div>
                        </form>
                    </div> 
                </div>  
            </div>
            <div class="card-body"> 
                <div class="table-responsive m-t-10">
                    <table data-item-id="datatableview" class="table display table-hover  ">
                        <thead>
                            <tr>
                                <th style="width:5%"></th>  
                                <th style="width:10%">Produto</th>
                                <th style="width:10%">Quantidade</th> 
                                <th>Nome</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <? foreach($rows as $r) { ?>
                            <tr>
                                <td>
                                    <div class="form-check form-check-right mb-3">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            name="Group[Coleta]" 
                                            id="formRadiosRight1" 
                                            value="<?= $r->id?>"
                                            data-bs-token="<?= base64_encode(json_encode($r)) ?>"
                                            >
                                        <label class="form-check-label" for="formRadiosRight1"> </label>
                                    </div>
                                </td>  
                                <td><?= $r->nm_produto ?></td> 
                                <td class="text-center">
                                    <?= number_format($r->nr_aprovado, 2, ',', '.') ?> kg
                                </td>  
                                <td><?= $r->nm_produtor?></td>
                            </tr>
                            <? } ?>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="5">
                                    <button 
                                        class="btn btn-success"  
                                        > 
                                        Criar Lote
                                    </button>
                                </th> 
                            </tr>
                        </thead> 
                    </table>
                </div> 

            </div>
        </div>
    </div>
    <div class="col-4">
        
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
            <div class="modal-body">
                <form action="<?= base_url($tela . 'save') ?>" method="POST" enctype="multipart/form-data" name="formAtividade">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-600">Produto</label>
                                <select required name="Register[cd_produto]" class="form-control">
                                    <option value="">Selecione o Produto</option>
                                    <? foreach ($produto as $p) { ?>
                                    <option value="<?= $p->cd_produto ?>"><?= $p->nm_produto ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row" style="margin-bottom: .5rem;margin-left: 0px;margin-right: 0px">
                                    <div class="col-md-6 font-weight-600">Produtor</div>
                                </div>
                                <select name="Register[cd_produtor]" class="form-control">
                                    <option value="">Selecione o Produtor</option>
                                    <? foreach ($produtor as $p) { ?>
                                    <option value="<?= $p->cd_pessoa ?>"><?= $p->nm_pessoa ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-600">Avaliação da Coleta</label>
                            <div class="form-group">
                                <select required name="Register[ds_avaliacao]" class="form-control">
                                    <option value="0 - Lote Conforme">0 - Lote Conforme</option>
                                    <option value="1 - Fungos/bolor">1 - Fungos/bolor</option>
                                    <option value="2 - Sementes vazias">2 - Sementes vazias</option>
                                    <option value="3 - Podres">3 - Podres</option>
                                    <option value="4 - Brocados">4 - Brocados</option>
                                    <option value="5 - Pragas">5 - Pragas</option>
                                    <option value="6 - Insetos ou fezes">6 - Insetos ou fezes</option>
                                    <option value="7 - Verdes/Não maduras">7 - Verdes/Não maduras</option>
                                    <option value="8">8 - Outros</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="font-weight-600">Local da Coleta</label>
                            <div class="form-group">
                                <select name="Register[cd_localidade]" class="form-control">
                                    <option selected disabled value="">Selecione o local de coleta</option>
                                    <? foreach ($local as $localidade) { ?>
                                    <option value="<?= $localidade->cd_localidade ?>"><?= $localidade->nm_localidade ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600">Coletado (Kg)</label>
                                <input data-item-price="calculo" required data-item-id="peso" name="Register[nr_coletada]" type="text"  class="form-control text-right">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600">Aprovado (Kg)</label>
                                <input data-item-price="calculo" required data-item-id="peso" name="Register[nr_aprovado]"
                                       type="text" value="<?= $row->nr_aprovado ?>" class="form-control text-right">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600">Reprovado (Kg)</label>
                                <input data-item-price="calculo" data-item-id="peso" name="Register[nr_reprovado]"  type="text" class="form-control text-right" readonly required>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600">Valor por Kg (R$)</label>
                                <input data-item-price="moeda" name="Register[vl_produto]" type="text" class="form-control text-right">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600">Valor a pagar (R$)</label>
                                <input data-item-id="moeda" name="Register[vl_compra]" type="text" class="form-control text-right" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600">Data</label>
                                <div class="icon-addon addon-md">
                                    <input id="data-criacao" name="Register[dt_pago]" type="date" class="form-control text-right" placeholder="dd/mm/yyyy">
                                    <label class="ti-calendar" title="Calendário"></label>
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
</div>
<script src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        $('[data-item-id="peso"]').mask('000000000,00', {reverse: true});
        $('[data-item-price="moeda"],[data-item-id="moeda"]').mask('#.##0,00', {reverse: true});

        $('input[name="Register[nr_coletada]"],input[name="Register[nr_aprovado]"]').keyup(function () {
            var coletado = parseFloat($('input[name="Register[nr_coletada]"]').val().toString().replace(',', '.'));
            var aprovado = parseFloat($('input[name="Register[nr_aprovado]"]').val().toString().replace(',', '.'));
            var resultado = parseFloat(coletado - aprovado).toFixed(2)
            if (isNaN(resultado)) {
                $('input[name="Register[nr_reprovado]"]').val('');
            } else {
                $('input[name="Register[nr_reprovado]"]').val(resultado.toString().replace('.', ','));
            }

        });
        $('input[name="Register[nr_aprovado]"],input[name="Register[vl_produto]"]').keyup(function () {
            var valor_kg = parseFloat($('input[name="Register[vl_produto]"]').val().toString().replace(',', '.'));
            var kg_aprovado = parseFloat($('input[name="Register[nr_aprovado]"]').val().toString().replace(',', '.'));
            var resultado = parseFloat(valor_kg * kg_aprovado).toFixed(2)
            if (isNaN(resultado)) {
                $('input[name="Register[vl_compra]"]').val('');
            } else {
                $('input[name="Register[vl_compra]"]').val(resultado.replace(',', '.'));
            }

        });
        
        
        
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
                $('[name="Register[cd_produto]"]').val(ires.cd_produto);
                $('[name="Register[cd_produtor]"]').val(ires.cd_produtor).prop('disabled', false);
                $('[name="Register[ds_avaliacao]"]').val(ires.ds_avaliacao).prop('disabled', false);
                $('[name="Register[cd_localidade]"]').val(ires.cd_localidade).prop('disabled', false);
                $('[name="Register[nr_coletada]"]').val(ires.nr_coletada).prop('disabled', false);
                $('[name="Register[nr_aprovado]"]').val(ires.nr_aprovado).prop('disabled', false);
                $('[name="Register[nr_reprovado]"]').val(ires.nr_reprovado).prop('disabled', false);
                $('[name="Register[vl_produto]"]').val(ires.vl_produto).prop('disabled', false);
                $('[name="Register[vl_compra]"]').val(ires.vl_compra).prop('disabled', false); 
                $('[name="Register[dt_pago]"]').val(ires.dt_pago).prop('disabled', false); 
            }
            if(Option == 'D')
            {
                $('[name="Register[id]"]').val(ires.id);
                $('[name="Register[cd_produto]"]').val(ires.cd_produto).prop('disabled', true);
                $('[name="Register[cd_produtor]"]').val(ires.cd_produtor).prop('disabled', true);
                $('[name="Register[ds_avaliacao]"]').val(ires.ds_avaliacao).prop('disabled', true);
                $('[name="Register[cd_localidade]"]').val(ires.cd_localidade).prop('disabled', true);
                $('[name="Register[nr_coletada]"]').val(ires.nr_coletada).prop('disabled', true);
                $('[name="Register[nr_aprovado]"]').val(ires.nr_aprovado).prop('disabled', true);
                $('[name="Register[nr_reprovado]"]').val(ires.nr_reprovado).prop('disabled', true);
                $('[name="Register[vl_produto]"]').val(ires.vl_produto).prop('disabled', true);
                $('[name="Register[vl_compra]"]').val(ires.vl_compra).prop('disabled', true); 
                $('[name="Register[dt_pago]"]').val(ires.dt_pago).prop('disabled', true); 
                $('[type="submit"]').removeClass().addClass('btn btn-danger').html('Deletar');
            }
        }); 
        
    });
</script>

