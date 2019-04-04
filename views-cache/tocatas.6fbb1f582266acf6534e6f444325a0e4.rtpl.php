<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/">Início</a>
    </li>
    <li class="breadcrumb-item active">Tocatas</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Tocatas</div>
    <div class="card-body">
        <div class="row justify-content-md-end">
            <div class="col-12 col-md-6 mb-2">
                <!-- <div class="col col-md-4 col-lg-4"> -->
                <a href="/tocatas/cadastrar" class="btn btn-primary" role="button"
                    title="Clique para adicionar um componente">
                    <i class="fas fa-plus"></i> Adicionar</a>
            </div>
            <div class="col-12 col-md-6">
                <!-- <div class="col offset-md-2 col-md-6 offset-lg-4 col-lg-4"> -->
                <div class="input-group mb-2">
                    <input type="text" id="searchField" class="form-control" title="Digite para fazer uma pesquisa"
                        arial-label="search field" placeholder="Procurar..." aria-describedby="basic-addon1">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Local</th>
                        <th>Data</th>
                        <th>Horário</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Local</th>
                        <th>Data</th>
                        <th>Horário</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $counter1=-1;  if( isset($tocatas) && ( is_array($tocatas) || $tocatas instanceof Traversable ) && sizeof($tocatas) ) foreach( $tocatas as $key1 => $value1 ){ $counter1++; ?>
                    <tr href="/tocatas/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <td><?php echo htmlspecialchars( $value1["local"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php echo htmlspecialchars( $value1["data"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php echo htmlspecialchars( $value1["horario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>