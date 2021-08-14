<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('menu')?>">Cardápio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Categorias de Pratos</li>
    </ol>
</nav>
<!-- /Breadcrumb -->


<div class="container" >
    <button data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-outline-success mb-3"><i class="fa fa-plus"></i> Nova Categoria</button>
    
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
                                    <th>Nome da Categoria</th>
                                    <th>Total de Produtos na Categoria</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($categorias as $category): ?>
                                <tr>
                                    <td><?=$category['name_category']?></td>
                                    <td><?=$category['total_products']?> Produto(s)</td>
                                    <td>
                                        <?php if($category['category_status'] === 'ACTIVE'): ?>
                                            <button class="btn btn-success btn-xs">Publicada</button>
                                        <?php else: ?>
                                            <button class="btn btn-warning btn-xs">Rascunho</button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="<?=url('categoria/edit/'.$category['id'])?>">Editar</a>
                                        <a class="btn btn-danger btn-xs <?=($category['total_products'] != '0')?'disabled':''?>" href="<?=url('categoria/delete/'.$category['id'])?>">Excluir</a>
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
                        <h5 class="modal-title">Cadastro de Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?=url('categoria/addAction')?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome da Categoria</label>
                                <input type="text" class="form-control" name="name_category"
                                       aria-describedby="emailHelp" placeholder="Digite o nome aqui..."/>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="form-control">
                                    <option value="ACTIVE">Publicar</option>
                                    <option value="INACTIVE">Rascunho</option>
                                </select>
                            </div>

                            <input type="hidden" value="<?=getUser()->id_company?>" name="company">

                    </div>
                    <div class="modal-footer" style="justify-content: start;">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-danger btn-sm">Cadastrar Categoria</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
