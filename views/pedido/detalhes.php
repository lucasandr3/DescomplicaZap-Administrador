<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('pedido/finalizados')?>">Pedidos</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="text-danger"><?=$title?></span> </li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container" >
    <?php if($back === 'final') : ?>
        <a href="<?=url('pedido/finalizados')?>" class="btn btn-outline-success mb-3">
            <i class="fa fa-arrow-left"></i> &nbsp;&nbsp;Voltar
        </a>
    <?php else: ?>
        <a href="<?=url('pedido/cancelados')?>" class="btn btn-outline-success mb-3">
            <i class="fa fa-arrow-left"></i> &nbsp;&nbsp;Voltar
        </a>
    <?php endif; ?>
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h5 style="color:#555;margin-bottom: 10px;">Dados Financeiros</h5>
                            <div class="card card-body" style="margin-bottom:0.875em;">
                                <div style="display: flex;justify-content: space-between;align-items: center;">
                                    <div>
                                        <p><strong>Id do Pedido: </strong><span class="text-danger">#<?=$pedido['id']?></span></p>
                                        <p style="margin:0;"><strong>Status do Pedido: </strong><span class="text-success" style="font-weight: bold">Finalizado</span></p>
                                    </div>
                                    <div>
                                        <p><strong>Data do Pedido: </strong><?=$pedido['date_order']?></p>
                                        <p style="margin:0;"><strong>Hora do Pedido: </strong><?=$pedido['our_order']?> hs</p>
                                    </div>
                                    <div>
                                        <p><strong>Subtotal: </strong><span class="text-success font-weight-bold"><?=real($pedido['subtotal_order'])?></span></p>
                                        <p style="margin:0;"><strong>Total do Pedido: </strong><span class="text-success font-weight-bold"><?=real($pedido['total_order'])?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h5 style="color:#555;margin-bottom: 10px;margin-top: 10px;">Endereço de entrega</h5>
                        <div class="card card-body" style="margin-bottom:0.875em;">
                            <div style="display: flex;justify-content: space-between;align-items: center;">
                                <?php $endereco = ['address' => $pedido['order_address']]; ?>
                                <?php if(isset(json_decode($endereco['address'])->retirada)) : ?>
                                    <p>Retirada</p>
                                <?php else : ?>
                                <?php $entrega = explode(",", json_decode($endereco['address'])->bairro); ?>
                                    <div>
                                        <p><strong>CEP: </strong><?=(json_decode($endereco['address'])->cep == "") ? 'Não Informado': json_decode($endereco['address'])->cep?></p>
                                        <p><strong>Bairro: </strong><?=$entrega[0]?></p>
                                        <p><strong>Endereço: </strong><?=json_decode($endereco['address'])->rua?>, <?=json_decode($endereco['address'])->numero?></p>
                                        <p style="margin:0;"><strong>Referência: </strong><?=(json_decode($endereco['address'])->referencia == "") ? 'Sem ponto de referência': json_decode($endereco['address'])->referencia?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h5 style="color:#555;margin-bottom: 10px;margin-top: 10px;">Pagamento</h5>
                        <div class="card card-body" style="margin-bottom:0.875em;">
                            <div style="display: flex;justify-content: space-between;align-items: center;">
                                <div>
                                    <p><strong>Meio de pagamento: </strong><span><?=$pedido['payment']?></span></p>
                                    <p><strong>troco: </strong><span class="text-success font-weight-bold"><?=real($pedido['tip'])?></span></p>
                                    <p style="margin:0;"><strong>Taxa de Entrega: </strong><span class="text-success font-weight-bold"><?=real($pedido['delivery'])?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h5 style="color:#555;margin-bottom: 10px;margin-top: 10px;">Produtos do Pedido</h5>
                        <div class="card card-body" style="margin-bottom:0.875em;">
                            <?php foreach(json_decode($pedido['order_object']) as $prod): ?>
                                <div style="display: flex;flex-direction: column;align-items: start;">

                                    <div>
                                        <p><strong>Nome do produto: </strong><?=$prod->nameProduct?></p>
                                        <p style="margin:0;"><strong>Adicionais:</strong></p>
                                        <?php foreach($prod->aditional as $add): ?>
                                            <?php if($add->item !== ''): ?>
                                                <ul style="margin-left: 10px;margin-bottom: 5px;">
                                                    <li style="list-style: circle;margin-left: 20px;">
                                                        <div style="display: flex;">
                                                            <div>
                                                                <span><strong>Nome do Item:</strong> </span> => <span><?=$add->item?></span>
                                                            </div>
                                                            <div style="margin-left: 20px;">
                                                                <span><strong>Preço:</strong> </span> => <span><?=real($add->preco)?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            <?php else: ?>
                                                <span>Sem Adicionais</span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <p style="margin:0;"><strong>Preço: </strong>R$ <?=$prod->priceProduct?></p>
                                    </div>
                                    <div>
                                        <p><strong>Quantidade: </strong><?=($prod->quantityProduct == "1") ? $prod->quantityProduct.' unidade' : $prod->quantityProduct.' unidades'?></p>

                                    </div>
                                </div>
                                <hr style="border-color: #c7c7c7 !important;border-top: 2px solid rgba(0,0,0,.1);" />
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /Row -->

</div>

<style>
    p {
        padding: 10px;
    }
</style>
