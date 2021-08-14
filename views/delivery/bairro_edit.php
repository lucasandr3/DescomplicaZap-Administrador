<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('delivery')?>">Taxa de Entrega</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edição</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container" >
    <a href="<?=url('delivery')?>" class="btn btn-outline-success mb-3" >
        <i class="fa fa-arrow-left"></i> Voltar &nbsp;
    </a>
    <?php get_flash(); ?>
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper" style="margin-bottom: 150px;">

                <form action="<?=BASE_URL?>delivery/editAction" method="POST">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome do Bairro</label>
                        <input type="text" class="form-control" name="nome_bairro"
                               aria-describedby="emailHelp" placeholder="Digite o nome aqui..."
                               value="<?=($bairro['nome_bairro'] === "") ? '' : $bairro['nome_bairro']?>"
                        />
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Taxa de entrega</label>
                        <input type="number" class="form-control" name="taxa_entrega"
                               aria-describedby="emailHelp" placeholder="Ex: Rua Tertuliano Goulart"
                               value="<?=($bairro['taxa_entrega'] === "") ? '' : $bairro['taxa_entrega']?>"
                        />
                    </div>


                        <input type="hidden" class="form-control" name="retirada"
                               aria-describedby="emailHelp" placeholder="Digite o bairro aqui..."
                               value="<?=($bairro['retirada'] === "") ? '' : $bairro['retirada']?>"
                        />

                    <input type="hidden" name="id" value="<?=$bairro['id']?>">

                    <button type="submit" class="btn btn-success">Salvar alterações</button>
                </form>

            </section>
        </div>
    </div>
    <!-- /Row -->
</div>
