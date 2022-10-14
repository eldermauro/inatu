<div class="row"> 
    <div class="col-lg-12 col-xl-12">
        <div class="row">

            <div class="col-md-12 col-lg-3">
                <!--Balance indicator--> 
                <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="header-pretitle text-muted fs-11 font-weight-bold text-black-50 text-uppercase mb-2">
                        Custo por Lote (<?= date('m/Y') ?>)
                    </div>
                    <div class="text-muted text-end"> 
                        <span class="text-success text-monospace font-size-20">
                            R$ 0,00
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3">
                <!--Balance indicator--> 
                <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                        Receita Mensal (<?= date('m/Y') ?>)
                    </div>
                    <div class="text-muted text-end">
                        <span class="text-success text-monospace font-size-20">
                            R$ 0,00
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3">
                <!--Balance indicator--> 
                <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                        Receita Acumulada (<?= date('Y') ?>)
                    </div>
                    <div class="text-muted text-end">
                        <span class="text-success text-monospace font-size-20">
                            R$ 0,00
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-3">
                <!--Balance indicator--> 
                <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                        Faturamento x Custo (<?= date('Y') ?>)
                    </div>
                    <div class="text-muted text-end">
                        <span class="text-success text-monospace font-size-20">
                            R$ 0,00
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-body text-center">
                <div class="row justify-content-center">
                    <canvas id="ChartProdution" width="400" ></canvas>
                </div> 
            </div>
        </div>
    </div> 
    <div class="col-lg-12 col-xl-4">
        <div class="card mb-4">
            <div class="card-body">
                <i class="typcn typcn-th-list-outline mr-2"></i>
                PROCESSOS HABILITADOS
            </div>
            <div class="card-body pt-0"> 
                <ul class="list-unstyled chat-list">
                    <? foreach($processos as $r) { ?>
                    <li class="unread">
                            <a href="<?=base_url('producao/processo/'.$r->id)?>">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0 user-img online align-self-center me-3">
                                        <div class="avatar-sm align-self-center">
                                            <span class="avatar-title rounded-circle bg-soft-success text-success">
                                                I
                                            </span>
                                        </div> 
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-13 mb-1"><?=$r->nm_processo?></h5>
                                        <small class="text-truncate mb-0 font-weight-bold">
                                            <?=$r->ds_processo?>
                                        </small>
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

<?php

$labels = [];
$custott = [];
$qtaprovado = [];
foreach($chartpss as $t)
{
    $labels[] = $t->ds_ref;
    $custott[] = $t->tt_valor;
    $qtaprovado[] = $t->tt_aprovado;
}
?>

<script src="<?= base_url('assets/js/chart.min.js') ?>"></script>
<script> 
    const labels = <?=JSON_encode($labels) ?>;
    const datatt = <?=JSON_encode($custott) ?>;
    const qtaprovado = <?=JSON_encode($qtaprovado) ?>; 
    const data = {
        labels: labels,
        datasets: [ 
            {
                label: 'Produção (kg)',
                data: qtaprovado,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235,0.5)',
                stack: 'combined',
                type: 'bar'
            }, 
            {
                label: 'Custo de Produção (R$ / Kg)',
                data: datatt,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgb(75, 192, 192)',
                stack: 'combined',
            }
        ]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Acompanhamento de Processos'
                }
            },
            scales: {
                y: [{
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return '$' + value.toFixed(3);
                        }
                    }
                }]
            }
        },
    };
    const myChart = new Chart(
        document.getElementById('ChartProdution'),
        config
    );
</script>