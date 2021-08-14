<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('itens')?>">Cardápio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Todos os Itens</li>
        <li class="breadcrumb-item active" aria-current="page">Edição de Item</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container" >
    <a href="<?=url('itens')?>" class="btn btn-outline-success mb-3"><i class="fa fa-arrow-left"></i> Voltar</a>
    <?php get_flash(); ?>
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <div class="row">
                    <div class="col-sm">
     
                        <form action="<?=url('itens/editAction')?>" method="POST">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome do item adicional</label>
                                <input type="text" class="form-control" name="name_option"
                                       aria-describedby="emailHelp" placeholder="Digite o nome aqui..."
                                       value="<?=($item['name_option_item'] === "") ? '' : $item['name_option_item']?>"
                                />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Preço do item</label>
                                <input type="number" class="form-control" name="price_option"
                                       aria-describedby="emailHelp" placeholder=""
                                       value="<?=($item['price_option_item']) ? $item['price_option_item'] : '0.00'?>"
                                />
                            </div>

                            <input type="hidden" name="id_category_option" value="<?=$item['id_option_product']?>">
                            <input type="hidden" name="id_product" value="<?=$item['id_product']?>">
                            <input type="hidden" name="id_option" value="<?=$item['id']?>">

                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Produtos</label>
                                <select name="id_product" class="form-control">
                                    <optgroup label="Produto Atual">
                                        <option value="<?=$item['id_product']?>"><?=$item['name_product']?></option>
                                    </optgroup>
                                    <optgroup label="Trocar Produto">
                                        <?php foreach($produtos as $p): ?>
                                            <option value="<?=$p['id_product']?>"><?=$p['name_product']?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div> -->

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="available" class="form-control">
                                    <?php if($item['option_item_status'] == "POIACTIVE"): ?>
                                        <option value="POIACTIVE">Ativo</option>
                                    <?php else: ?>
                                        <option value="POIINACTIVE">Inativo</option>
                                    <?php endif; ?>
                                    <?php if($item['available'] == "POIINACTIVE"): ?>
                                        <option value="POIINACTIVE">Inativo</option>
                                    <?php else: ?>
                                        <option value="POIACTIVE">Ativo</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Salvar alterações</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /Row -->

</div>
