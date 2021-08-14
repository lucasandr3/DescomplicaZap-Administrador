<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('menu')?>">Cardápio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Todos os Itens</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container" >
    <button data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-outline-success mb-3"><i class="fa fa-plus"></i> Novo Adicional</button>
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
                                    <th>Nome do Item Adicional</th>
                                    <th>Item do produto</th>
                                    <th>Item da categoria</th>
                                    <th>Preço</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($itens as $item): ?>
                                    <tr>
                                        <td><?=$item['name_option_item']?></td>
                                        <td><?=$item['name_product']?></td>
                                        <td><?=$item['name_option']?></td>
                                        <td><?=real($item['price_option_item'])?></td>
                                        <td>
                                            <?php if($item['option_item_status'] == "POIACTIVE"): ?>
                                                <span class="badge badge-success">Ativo</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Inativo</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?=BASE_URL?>itens/edit/<?=$item['id']?>" class="btn btn-primary btn-xs"
                                                   style="border-radius:5px;display:flex;justify-content: space-evenly;margin-right:5px;">
                                                    Editar
                                                </a>
                                                <a href="<?=BASE_URL?>itens/delete/<?=$item['id']?>" class="btn btn-danger btn-xs"
                                                   style="border-radius:5px;display:flex;justify-content: space-evenly;">
                                                    Excluir
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
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

<div class="row">
    <div class="col-sm">
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastro de Adicional</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?=url('itens/addAction')?>" method="post">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome do item Adicional</label>
                                <input type="text" class="form-control" name="name_option"
                                       aria-describedby="emailHelp" placeholder="Digite o nome aqui..."
                                />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Categoria do item adicional</label>
                                <select name="id_category_option" class="form-control select2">
                                    <?php foreach($adicionais as $a): ?>
                                        <option value="<?=$a['id']?>"><?=$a['name_option']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Produto do item adicional</label>
                                <select name="id_product" class="form-control select2">
                                    <?php foreach($produtos as $p): ?>
                                        <option value="<?=$p['id']?>"><?=$p['name_product']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Preço do item Adicional</label>
                                <input type="number" class="form-control" name="price_option"
                                       aria-describedby="emailHelp" placeholder="0.00" value="0.00"
                                />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="available" class="form-control">
                                    <option value="POIACTIVE">Publicar</option>
                                    <option value="POIINACTIVE">Não Publicar</option>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer" style="justify-content: start;">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-danger btn-sm">Cadastrar Item</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
