<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('categoria')?>">Categoria de Prato</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edição de Categoria</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container" >
    <a href="<?=url('categoria')?>" class="btn btn-outline-success mb-3"><i class="fa fa-arrow-left"></i> Voltar</a>
    <?php get_flash(); ?>
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper" style="margin-bottom: 147px;">
                <div class="row">
                    <div class="col-sm">


                <form action="<?=url('categoria/editAction')?>" method="POST">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome da Categoria</label>
                        <input type="text" class="form-control" name="name_category"
                               aria-describedby="emailHelp" placeholder="Digite o nome aqui..."
                               value="<?=($categoria['name_category'] === "") ? '' : $categoria['name_category']?>"
                        />
                    </div>



<!--                    <div class="form-group">-->
<!--                        <label for="exampleInputEmail1">Status</label>-->
<!--                        <select name="status" class="form-control">-->
<!--                            --><?php //if($categoria['category_status'] == "ACTIVE"): ?>
<!--                                <option value="ACTIVE">Ativo</option>-->
<!--                            --><?php //else: ?>
<!--                                <option value="INACTIVE">Inativo</option>-->
<!--                            --><?php //endif; ?>
<!--                            --><?php //if($categoria['category_status'] == "ACTIVE"): ?>
<!--                                <option value="ACTIVE">Inativo</option>-->
<!--                            --><?php //else: ?>
<!--                                <option value="INACTIVE">Ativo</option>-->
<!--                            --><?php //endif; ?>
<!--                        </select>-->
<!--                    </div>-->

                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select name="status" class="form-control">
                            <?php if($categoria['category_status'] == "ACTIVE"): ?>
                                <option value="ACTIVE">Publicada</option>
                            <?php else: ?>
                                <option value="INACTIVE">Rascunho</option>
                            <?php endif; ?>
                            <?php if($categoria['category_status'] == "INACTIVE"): ?>
                                <option value="ACTIVE">Publicar</option>
                            <?php else: ?>
                                <option value="INACTIVE">Rascunho</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <input type="hidden" name="id" value="<?=$categoria['id']?>">

                    <button type="submit" class="btn btn-success">Salvar alterações</button>
                </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /Row -->
</div>
