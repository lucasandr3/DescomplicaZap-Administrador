<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('menu')?>">Empresas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalhes da Empresa - <?=$stores_details['name_company']?></li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container" >

    <?php if($viewData['menu'] === 'da'): ?>
        <a href="<?=url('store')?>" class="btn btn-outline-primary mb-3"><i class="fa fa-arrow-left"></i> Voltar</a>
    <?php else: ?>
        <a href="<?=url('store/store_inactive')?>" class="btn btn-outline-primary mb-3"><i class="fa fa-arrow-left"></i> Voltar</a>
    <?php endif; ?>    
    <?php get_flash(); ?>
    
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-sm">
                    <div class="table-wrap">
                        <div class="header-table">
                            <h6>Dados da Empresa</h6>
                        </div>
                        <table class="table w-100 display pb-30">
                            <tr>
                                <td width="500"><strong>Nome da Empresa</strong></td>
                                <td><?=$stores_details['name_company']?></td>
                            </tr>
                            <tr>
                                <td><strong>Categoria da Empresa</strong></td>
                                <td><?=$stores_details['category_company']?></td>
                            </tr>
                            <tr>
                                <td><strong>Slug</strong></td>
                                <td><?=$stores_details['slug']?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-wrap">
                        <div class="header-table">
                            <h6>Dados de Endereço</h6>
                        </div>
                        <table class="table w-100 display pb-30">
                            <tr>
                                <td width="500"><strong>CEP</strong></td>
                                <td><?=$stores_details['zipcode']?></td>
                            </tr>
                            <tr>
                                <td><strong>Rua</strong></td>
                                <td><?=$stores_details['street']?></td>
                            </tr>
                            <tr>
                                <td><strong>Bairro</strong></td>
                                <td><?=$stores_details['neighborhood']?></td>
                            </tr>
                            <tr>
                                <td><strong>Estado</strong></td>
                                <td><?=$stores_details['state']?></td>
                            </tr>
                            <tr>
                                <td><strong>Cidade</strong></td>
                                <td><?=$stores_details['city']?></td>
                            </tr>
                            <tr>
                                <td><strong>Número</strong></td>
                                <td><?=$stores_details['number']?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-wrap">
                        <div class="header-table">
                            <h6>Dados de Contato</h6>
                        </div>
                        <table class="table w-100 display pb-30">
                            <tr>
                                <td width="500"><strong>Contato</strong></td>
                                <td><?=$stores_details['phone']?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-wrap">
                        <div class="header-table">
                            <h6>Dados de Horário</h6>
                        </div>
                        <table class="table w-100 display pb-30">
                            <tr>
                                <td width="500"><strong>Domingo</strong></td>
                                <td><?=$stores_details['sunday_time']?></td>
                            </tr>
                            <tr>
                                <td><strong>Segunda Feira</strong></td>
                                <td><?=$stores_details['monday_time']?></td>
                            </tr>
                            <tr>
                                <td><strong>Terça Feira</strong></td>
                                <td><?=$stores_details['tuesday_time']?></td>
                            </tr>
                            <tr>
                                <td><strong>Quarta Feira</strong></td>
                                <td><?=$stores_details['wednesday_time']?></td>
                            </tr>
                            <tr>
                                <td><strong>Quinta Feira</strong></td>
                                <td><?=$stores_details['thursday_time']?></td>
                            </tr>
                            <tr>
                                <td><strong>Sexta Feira</strong></td>
                                <td><?=$stores_details['friday_time']?></td>
                            </tr>
                            <tr>
                                <td><strong>Sábado</strong></td>
                                <td><?=$stores_details['saturday_time']?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="table-wrap">
                        <div class="header-table">
                            <h6>Dados de Acesso</h6>
                        </div>
                        <table class="table w-100 display pb-30">
                            <?php foreach($users_store as $user): ?>
                            <tr>
                                <td width="500"><strong><?=$user['nome_user']?></strong></td>
                                <td><?=$user['email_user']?></td>
                                <td><?=$user['nome_group']?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                    <div class="table-wrap">
                        <div class="header-table">
                            <h6>Dados de Design</h6>
                        </div>
                        <table class="table w-100 display pb-30">
                            <tr>
                                <td width="500"><strong>Logo</strong></td>
                                <td>
                                    <img src="<?=$stores_details['logo']?>" style="width: 150px;height: auto;"/>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Cover</strong></td>
                                <td>
                                    <img src="<?=$stores_details['cover']?>" style="width: 150px;height: auto;"/>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

</div>

<style>
    table {
        border: 1px solid #ddd;
    }
    td {
        border-right: 1px solid #ddd;
    }
    .header-table {
        background-color: #eee;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>