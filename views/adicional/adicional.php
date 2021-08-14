<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('menu')?>">Cardápio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Todos os Adicionais</li>
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
                                    <th>Nome do Adicional</th>
                                    <th>Produto do adicional</th>
                                    <th>Total de Itens</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($adicionais as $adicional): ?>
                                    <tr>
                                        <td><?=$adicional['name_option']?></td>
                                        <td><?=$adicional['name_product']?></td>
                                        <td><?=$adicional['total_itens']?> Item(s)</td>
                                        <td>
                                            <?php if($adicional['option_status'] == "POACTIVE"): ?>
                                                <span class="badge badge-success">Ativo</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Inativo</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?=BASE_URL?>adicional/edit/<?=$adicional['id']?>" class="btn btn-primary btn-xs"
                                                   style="border-radius:5px;display:flex;justify-content: space-evenly;margin-right:5px;">
                                                   Editar
                                                </a>
                                                <a href="<?=BASE_URL?>adicional/delete/<?=$adicional['id']?>" class="btn btn-danger btn-xs <?=($adicional['total_itens'] != '0')?'disabled':''?>"
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
                        <form action="<?=url('adicional/addAction')?>" method="post">

                            <div class="form-group">
                                <label>Produto do adicional</label>
                                <select name="id_product" class="form-control select2">
                                        <option>Escolha o Produto</option>
                                    <?php foreach($produtos as $p): ?>
                                        <option value="<?=$p['id']?>"><?=$p['name_product']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome do Adicional</label>
                                <input type="text" class="form-control" name="category_name_option"
                                       aria-describedby="emailHelp" placeholder="Digite o nome aqui..."
                                />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="active" class="form-control">
                                    <option value="POACTIVE">Publicar</option>
                                    <option value="POINATIVE">Não Publicar</option>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer" style="justify-content: start;">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-danger btn-sm">Cadastrar Adicional</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
