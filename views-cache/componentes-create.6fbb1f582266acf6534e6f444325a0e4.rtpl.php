<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/">Início</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/componentes">Componentes</a>
    </li>
    <li class="breadcrumb-item active">Cadastrar</li>
</ol>
<div class="card">
    <div class="card-header">
        Cadastrar Componente
    </div>
    <div class="card-body">
        <form class="needs-validation" action="/componentes/cadastrar" method="post" novalidate>
            <div class="row">
                <div class="form-group col-12 required">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome"
                        required="required">
                    <div class="invalid-feedback">Este campo deve ser preenchido!</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-md-5">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="Telefone">
                </div>
                <!-- <div class="form-group col-12 col-md-4">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail"
                        required="required">
                </div> -->
                <div class="form-group col-12 col-md-5">
                    <label for="data_admissao">Data de Admissão:</label>
                    <input type="date" class="form-control" name="data_admissao" id="data_admissao"
                        placeholder="Data de admissão">
                </div>
                <div class="form-group col-12 col-md-2 align-self-end">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="ativo" id="ativo" value="1">
                        <label for="ativo" class="custom-control-label">Ativo</label>
                    </div>
                </div>
            </div>
            <h6 class="custom-border">Informações de Fardamento</h6>
            <div class="row">
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <label for="tam_camiseta">Camiseta:</label>
                    <select class="custom-select" name="tam_camiseta">
                        <option selected>Tamanhos</option>
                        <option value="P">P</option>
                        <option value="M">M</option>
                        <option value="G">G</option>
                        <option value="GG">GG</option>
                        <option value="XGG">XGG</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <label for="tam_mangas_curtas">Mangas Curtas:</label>
                    <input type="number" class="form-control" name="tam_mangas_curtas" id="tam_mangas_curtas"
                        placeholder="Número" min="1">
                </div>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <label for="tam_mangas_compridas">Mangas Compridas:</label>
                    <input type="number" class="form-control" name="tam_mangas_compridas" id="tam_mangas_compridas"
                        placeholder="Número" min="1">
                </div>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <label for="tam_sapato">Sapato:</label>
                    <input type="number" class="form-control" name="tam_sapato" id="tam_sapato" placeholder="Número"
                        min="1">
                </div>
            </div>
            <button type="submit" class="btn btn-success float-right">
                <i class="fas fa-fw fa-check"></i> Salvar</button>
        </form>
    </div>
    <div class="card-footer"></div>
</div>