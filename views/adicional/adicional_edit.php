<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('adicional')?>">Cardápio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Todos os Adicionais</li>
        <li class="breadcrumb-item active" aria-current="page">Edição de Adicional</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container" >
    <a href="<?=BASE_URL?>adicional" class="btn btn-outline-success mb-3" style="border-radius:5px;">
        <i class="fa fa-arrow-left"></i> &nbsp;&nbsp;Voltar
    </a>
    <?php get_flash(); ?>
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <div class="row">
                    <div class="col-sm">

                        <form action="<?=url('adicional/editAction')?>" method="POST">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome do adicional</label>
                                <input type="text" class="form-control" name="category_name_option"
                                       aria-describedby="emailHelp" placeholder="Digite o nome aqui..."
                                       value="<?=($adicional['name_option'] === "") ? '' : $adicional['name_option']?>"
                                />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Produtos</label>
                                <select name="id_product" class="form-control select2">
                                    <optgroup label="Produto Atual">
                                        <option value="<?=$adicional['id_product']?>"><?=$adicional['name_product']?></option>
                                    </optgroup>
                                    <optgroup label="Trocar Produto">
                                        <?php foreach($produtos as $p): ?>
                                            <option value="<?=$p['id']?>"><?=$p['name_product']?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="active" class="form-control">
                                    <?php if($adicional['option_status'] == "POACTIVE"): ?>
                                        <option value="POACTIVE">Publicado</option>
                                    <?php else: ?>
                                        <option value="POINACTIVE">Não Publicar</option>
                                    <?php endif; ?>
                                    <?php if($adicional['option_status'] == "POINACTIVE"): ?>
                                        <option value="POACTIVE">Publicar</option>
                                    <?php else: ?>
                                        <option value="POINACTIVE">Não Publicar</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <input type="hidden" name="id_category_option" value="<?=$adicional['id']?>">

                            <button type="submit" class="btn btn-success">Salvar alterações</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /Row -->

</div>
