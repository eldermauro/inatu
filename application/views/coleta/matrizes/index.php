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
                    <div class="col-lg-12">
                        <form action="<?= base_url($tela) ?>" method="POST" class="row gx-3 gy-2 align-items-center">
                            <div class="hstack gap-3"> 
                                <input value="<?= set_value('Filter[descricao]') ?>" name="Filter[descricao]" class="form-control me-auto" type="text" placeholder="Descrição">
                                <button type="submit" class="btn btn-secondary">Pesquisar</button>
                                <div class="vr"></div>
                                <button 
                                    type="button" 
                                    class="btn btn-primary"  
                                    href="<?= base_url($tela . 'cadastro') ?>" 
                                    data-bs-option="I" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#FormItem"
                                    >
                                    Adicionar
                                </button>
                                <div class="vr"></div>
                                <button 
                                    type="button" 
                                    class="btn btn-warning"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#FormItemMap"
                                    >
                                    Mapa
                                </button>
                            </div>
                        </form>
                    </div> 
                </div>  
            </div>
            <div class="card-body"> 
                <div class="table-responsive m-t-10">
                    <table id="datatable" data-item-id="datatableview" class="table display table-hover  table-striped ">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th style="width:30%">Lat/Lon</th> 
                                <th style="width:5%"></th> 
                            </tr>
                        </thead> 
                        <tbody>
                            <?php 
                            $posicao = []; 
                            foreach($rows as $r)
                            { 
                            ?>
                            <tr>
                                <td><?= $r->nm_coletor.'<br>'.$r->nm_localidade?></td>
                                <td><?= $r->nr_latitude .' / '. $r->nr_longitude?></td>
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
                            <?php
                                if($r->nr_latitude != '' && $r->nr_longitude != '')
                                {
                                   $posicao[] = [$r->nr_longitude, $r->nr_latitude]; 
                                }
                            } 
                            ?>
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content"> 
            <form action="<?= base_url($tela . 'save') ?>" method="POST" enctype="multipart/form-data" name="formAtividade">
                <div class="modal-body">
                    <div class="row" style="padding:5px"> 
                        
                        <div class="col-sm-6">
                            <label>Localidade</label>
                            <select name="Register[cd_localidade]"  class="form-control" required>
                                <option value="">Selecione a localidade</option>
                                <?php foreach ($localidade as $a) { ?>
                                    <option value="<?= $a->cd_localidade ?>"><?= $a->nm_localidade ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Coletor</label>
                            <select name="Register[cd_coletor]"  class="form-control" required>
                                <option value="">Selecione o Coletor</option>
                                <?php foreach ($coletor as $c) { ?>
                                    <option value="<?= $c->cd_coletor ?>"><?= $c->nm_coletor ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-9">
                            <label>Descrição do Local</label>
                            <input required name="Register[nm_localidade]" type="text" class="form-control"  />
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Longitude</label>
                            <input required name="Register[nr_longitude]" type="text" class="form-control"  />
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Latitude</label>
                            <input name="Register[nr_latitude]" type="text" class="form-control"  />
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Vegetação</label>
                            <textarea name="Register[ds_vegetacao]" class="form-control"></textarea>
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Relevo</label>
                            <textarea name="Register[ds_relevo]" class="form-control"></textarea>
                        </div>
                        
                        <div class="col-sm-6">
                            <label>Solo</label>
                            <textarea name="Register[ds_solo]" class="form-control"></textarea>
                        </div>
                         
                        <div class="col-sm-6">
                            <label>Observação</label>
                            <textarea name="Register[ds_obs]" class="form-control"></textarea>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div> 
                <input name="Register[cd_localidade]" type="hidden"> 
                <input name="Op" type="hidden">  
            </form>
        </div> 
    </div>
</div>


<div class="modal fade"
     id="FormItemMap"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-labelledby="FormItemMap"
     aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered" role="document">
        <div class="modal-content"> 
            <div class="modal-body">
                <div id="map" style="height: 480px;"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button> 
            </div>  
        </div> 
    </div>
</div>


<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" ></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script type="text/javascript">
    $(document).ready(function () {  
        
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
                $('[name="Register[cd_localidade]"]').val(ires.cd_localidade);
                $('[name="Register[nr_localidade]"]').val(ires.nr_localidade).prop('disabled', false);
                $('[name="Register[nm_localidade]"]').val(ires.nm_localidade).prop('disabled', false);
                $('[name="Register[nr_longitude]"]').val(ires.nr_longitude).prop('disabled', false);
                $('[name="Register[nr_latitude]"]').val(ires.nr_latitude).prop('disabled', false);
            } 
            if(Option == 'D')
            {
                $('[name="Register[nr_localidade]"]').prop('disabled', true);
                $('[name="Register[nm_localidade]"]').prop('disabled', true);
                $('[name="Register[nr_longitude]"]').prop('disabled', true);
                $('[name="Register[nr_latitude]"]').prop('disabled', true);
                $('[type="submit"]').removeClass().addClass('btn btn-danger').html('Deletar');
            }
        });
          /*
        
        var map = L.map('map').setView([<?=(count($posicao) > 0 ? $posicao[0][0].','.$posicao[0][1] : -3.7276364.','.-61.3186273) ?>], 13);
        L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 12,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(map); 
        <?php  
        foreach($rows as $key => $r) { 
            if($r->nr_latitude != '' && $r->nr_longitude != '') { ?>
         //  var marker_<?=$key?> = L.marker([<?=trim(trim($r->nr_longitude).','.trim($r->nr_latitude))?>]).addTo(map).bindPopup('<?=trim($r->nm_localidade)?>');
        <?php }} ?>
            
             */
            
    });
</script>

