<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('menu')?>">Empresas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Empresas Inativas</li>
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
                                    <th>Nome da Empresa</th>
                                    <th>Categoria da Empresa</th>
                                    <th>Slug</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($stores)): foreach($stores as $store): ?>
                                <tr>
                                    <td><?=$store['name_company']?></td>
                                    <td><?=$store['category_company']?></td>
                                    <td><?=$store['slug']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="<?=url('store/details/'.$store['id'].'/inactive')?>">Detalhes</a>
                                        <a class="btn btn-success btn-xs" href="<?=url('store/active/'.$store['id'])?>">Ativar</a>
                                    </td>
                                </tr>
                               <?php endforeach; endif; ?>
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