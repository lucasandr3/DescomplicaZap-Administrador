<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="<?=url('store')?>">Configuração</a></li>
        <li class="breadcrumb-item active" aria-current="page">Configuração da Loja</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container">
    <div class="content">
        <ul class="nav nav-tabs shadow" style="margin-bottom: 30px;background-color: #f7f7f7;padding: 10px;border-radius: 8px;">
            <li class="nav-item">
                <a href="#home" class="nav-link active" data-toggle="tab">Dados de Cadastro</a>
            </li>
            <li class="nav-item">
                <a href="#profile" class="nav-link" data-toggle="tab">Layout do Cardápio</a>
            </li>
            <li class="nav-item">
                <a href="#messages" class="nav-link" data-toggle="tab">Tema do Cardápio</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home">
                <?php get_flash(); ?>
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">

                            <form action="<?=url('store/editLojaAction')?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome da Loja</label>
                                    <input type="text" class="form-control" name="nome"
                                           aria-describedby="emailHelp" placeholder="Digite o nome aqui..."
                                           value="<?=($data_store['name_store'] === "") ? '' : $data_store['name_store']?>"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Endereço</label>
                                    <input type="text" class="form-control" name="rua"
                                           aria-describedby="emailHelp" placeholder="Ex: Rua Tertuliano Goulart"
                                           value="<?=($data_store['street'] === "") ? '' : $data_store['street']?>"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bairro</label>
                                    <input type="text" class="form-control" name="bairro"
                                           aria-describedby="emailHelp" placeholder="Digite o bairro aqui..."
                                           value="<?=($data_store['neighborhood'] === "") ? '' : $data_store['neighborhood']?>"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cidade</label>
                                    <input type="text" class="form-control" name="cidade"
                                           aria-describedby="emailHelp" placeholder="Digite a cidade aqui..."
                                           value="<?=($data_store['city'] === "") ? '' : $data_store['city']?>"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Número</label>
                                    <input type="text" class="form-control" name="numero"
                                           aria-describedby="emailHelp" placeholder="Digite o número aqui..."
                                           value="<?=($data_store['number'] === "") ? '' : $data_store['number']?>"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Telefone</label>
                                    <input type="tel" class="form-control" name="telefone"
                                           placeholder="(00) 00000-0000"
                                           value="<?=($data_store['phone'] === "") ? '' : $data_store['phone']?>"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Logo no app</label>
                                    <input type="file" class="form-control" name="arquivo"/>
                                    <div style="margin-top: 20px;">
                                        <img src="<?=$data_store['logo']?>" style="width: 200px;height: 200px;border-radius: 10px;border: 2px solid #f50057;">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Salvar alterações</button>
                            </form>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <div class="tab-pane fade" id="profile">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <?php if(isset($_SESSION['alert']) && !empty($_SESSION['alert'])) : ?>
                                <?php echo $_SESSION['alert']; ?>
                                <?php $_SESSION['alert'] = ''; ?>
                            <?php endif; ?>

                            <form action="<?=url('store/layout')?>" method="POST">

                                <div class="top-text-wrapper">
                                    <h4>Visualizaçã dos Produtos</h4>
                                    <p>Escolha a forma que os produtos serão exibidos.</p>
                                    <hr>
                                </div>
                                <div class="grid-wrapper grid-col-2">
                                    <div class="selection-wrapper">
                                        <label for="selected-item-1" class="selected-label">
                                            <input type="radio" value="0" name="layout" id="selected-item-1">
                                            <span class="icon"></span>
                                            <div class="selected-content">
                                                <img src="<?=url('assets/portal/img/config/vis-h.png')?>" alt="">
                                                <h5>Cards Horizontais.</h5>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="selection-wrapper">
                                        <label for="selected-item-2" class="selected-label">
                                            <input type="radio" value="1" name="layout" id="selected-item-2">
                                            <span class="icon"></span>
                                            <div class="selected-content">
                                                <img src="<?=url('assets/portal/img/config/vis-v.png')?>" alt="">
                                                <h5>Cards Verticais.</h5>
                                            </div>
                                        </label>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-success">Salvar Layout</button>
                            </form>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <div class="tab-pane fade" id="messages">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <?php if(isset($_SESSION['alert']) && !empty($_SESSION['alert'])) : ?>
                                <?php echo $_SESSION['alert']; ?>
                                <?php $_SESSION['alert'] = ''; ?>
                            <?php endif; ?>

                            <form action="<?=url('store/theme')?>" method="POST">

                                <div class="top-text-wrapper">
                                    <h4>Tema</h4>
                                    <p>Escolha o tema do cardápio.</p>
                                    <hr>
                                </div>
                                <div class="grid-wrapper grid-col-2">
                                    <div class="selection-wrapper">
                                        <label for="selected-item-3" class="selected-label">
                                            <input type="radio" value="0" name="layout" id="selected-item-3">
                                            <span class="icon"></span>
                                            <div class="selected-content">
                                                <img src="<?=url('assets/portal/img/config/t-dark-yellow.png')?>" alt="">
                                                <h5>Tema (dark-yellow).</h5>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="selection-wrapper">
                                        <label for="selected-item-4" class="selected-label">
                                            <input type="radio" value="1" name="layout" id="selected-item-4">
                                            <span class="icon"></span>
                                            <div class="selected-content">
                                                <img src="<?=url('assets/portal/img/config/t-light-red.png')?>" alt="">
                                                <h5>Tema (light-red).</h5>
                                            </div>
                                        </label>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-success">Salvar Layout</button>
                            </form>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
            </div>
        </div>
</div>
    <style>
        .top-text-wrapper {
            margin: 0px 0 30px 0;
        }
        .top-text-wrapper h4{
            font-size: 24px;
            margin-bottom: 10px;
        }
        .top-text-wrapper code{
            font-size: .85em;
            background: linear-gradient(90deg,#fce3ec,#ffe8cc);
            color: #ff2200;
            padding: .1rem .3rem .2rem;
            border-radius: .2rem;
        }
        .tab-section-wrapper{
            padding: 30px 0;
        }

        .grid-wrapper {
            display: grid;
            grid-gap: 30px;
            place-items: center;
            place-content: center;
        }
        .grid-col-auto{
            grid-template-columns: repeat(auto-fill, minmax(280px, .1fr));
            grid-template-rows: auto;
        }
        .grid-col-1{
            grid-template-columns: repeat(1, auto);
            grid-template-rows: repeat(1, auto);
        }
        .grid-col-2{
            grid-template-columns: repeat(3, auto);
            grid-template-rows: repeat(1, auto);
        }
        .grid-col-3{
            grid-template-columns: repeat(3, auto);
            grid-template-rows: repeat(1, auto);
        }
        .grid-col-4{
            grid-template-columns: repeat(4, auto);
            grid-template-rows: repeat(1, auto);
        }


        /* ******************* Selection Radio Item */

        .selected-content{
            text-align: center;
            border-radius: 3px;
            box-shadow: 0 2px 4px 0 rgba(219, 215, 215, 0);
            border: solid 2px transparent;
            background: #fff;
            width: 280px;
            height: 330px;
            padding: 15px;
            display: grid;
            grid-gap: 15px;
            place-content: center;
            transition: .3s ease-in-out all;
        }

        .selected-content img {
            width: 150px;
            margin: 0 auto;
        }
        .selected-content h4 {
            font-size: 16px;
            letter-spacing: -0.24px;
            text-align: center;
            color: #1f2949;
        }
        .selected-content h5 {
            font-size: 14px;
            line-height: 1.4;
            text-align: center;
            color: #686d73;
        }

        .selected-label{
            position: relative;
        }
        .selected-label input{
            display: none;
        }
        .selected-label .icon{
            width: 20px;
            height: 20px;
            border: solid 2px #e3e3e3;
            border-radius: 50%;
            position: absolute;
            top: 15px;
            left: 15px;
            transition: .3s ease-in-out all;
            transform: scale(1);
            z-index: 1;
        }
        .selected-label .icon:before{
            content: "\f00c";
            position: absolute;
            width: 100%;
            height: 100%;
            font-family: 'FontAwesome';
            font-weight: 900;
            font-size: 12px;
            color: #000;
            text-align: center;
            opacity: 0;
            transition: .2s ease-in-out all;
            transform: scale(2);
        }
        .selected-label input:checked + .icon{
            background: #3057d5;
            border-color: #3057d5;
            transform: scale(1.2);
        }
        .selected-label input:checked + .icon:before{
            color: #fff;
            opacity: 1;
            transform: scale(.8);
        }
        .selected-label input:checked ~ .selected-content{
            box-shadow: 0 2px 4px 0 rgba(219, 215, 215, 0.5);
            border: solid 2px #3057d5;
        }
    </style>