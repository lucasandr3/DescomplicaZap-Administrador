<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('menu')?>">Cardápio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Todos os Pratos</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container" >
    <?php get_flash(); ?>
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1" class="table w-100 display pb-30">
                                <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Preço</th>
                                    <th>Adicionais</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($produtos as $produto): ?>
                                    <tr>
                                        <td>
                                            <img src="<?=$produto['image']?>" style="width: 80px;height: 80px;object-fit: cover;border-radius: 10px;" />
                                        </td>
                                        <td><?=$produto['name_product']?></td>
                                        <td><?=$produto['category']?></td>
                                        <td><?=real($produto['price'])?></td>
                                        <td><button class="btn btn-warning btn-xs" onclick="options(<?=$produto['id'];?>)">Adicionais</button></td>
                                        <td>
                                            <?php if($produto['status'] == "PACTIVE"): ?>
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-secondary btn-xs" id="btn-i-one_<?=$produto['id'];?>" onclick="indisponivelone(<?=$produto['id'];?>, 'INACTIVE')">Pausado</button>
                                                    <button class="btn btn-success btn-xs" id="btn-d-one_<?=$produto['id'];?>" onclick="disponivelone(<?=$produto['id'];?>, 'PACTIVE')">Disponível</button>
                                                </div>
                                            <?php else : ?>
                                                <div class="btn-group">
                                                    <button class="btn btn-danger btn-xs" id="btn-i-two_<?=$produto['id'];?>" onclick="indisponiveltwo(<?=$produto['id'];?>, 'INACTIVE')">Pausado</button>
                                                    <button class="btn btn-outline-secondary btn-xs" id="btn-d-two_<?=$produto['id'];?>" onclick="disponiveltwo(<?=$produto['id'];?>, 'PACTIVE')">Disponível</button>
                                                </div>
                                            <?php endif; ?>
                                           </div>
                                        </td>
                                    </tr>

                        <!-- Classic Modal -->
                                                        <div class="modal fade" id="myModal<?=$produto['id'];?>" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Adicionais do produto</h4>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-hidden="true">
                                                                            <i class="fa fa-close"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body" id="body-modal-options<?=$produto['id_product'];?>">



                                                                    </div>
                                                                    <div class="modal-footer" style="justify-content: space-between;">
                                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                            data-dismiss="modal">Fechar</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                        <!--                                End Modal -->
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /Row -->
</div>
