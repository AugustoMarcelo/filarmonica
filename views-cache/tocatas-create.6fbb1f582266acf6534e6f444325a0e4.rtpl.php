<?php if(!class_exists('Rain\Tpl')){exit;}?><ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/">Início</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/tocatas">Tocatas</a>
    </li>
    <li class="breadcrumb-item active">Criar</li>
</ol>
<div class="card">
    <div class="card-header">
        Cadastrar Tocata
    </div>
    <div class="card-body">
        <form class="needs-validation" method="post" novalidate>
            <div class="row">
                <div class="form-group col-12 col-md-6 required">
                    <label for="local">Local:</label>
                    <input type="text" class="form-control" name="local" id="local" placeholder="local"
                        required="required">
                    <div class="invalid-feedback">Este campo deve ser preenchido!</div>
                </div>
                <div class="form-group col-12 col-md-6 required">
                    <label for="data">Data:</label>
                    <input type="date" name="data" id="data" class="form-control" required="required">
                    <div class="invalid-feedback">Este campo deve ser preenchido!</div>
                </div>
            </div>
            <h6 class="custom-border">Componentes</h6>
            <div class="row">
                <?php $counter1=-1;  if( isset($componentes) && ( is_array($componentes) || $componentes instanceof Traversable ) && sizeof($componentes) ) foreach( $componentes as $key1 => $value1 ){ $counter1++; ?>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            id="componente<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <label for="componente<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="custom-control-label"
                            title="Marcar componente como presente"><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                    </div>
                </div>
                <?php } ?>
            </div>

            <!-- <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente1" id="componente1">
                        <label for="componente1" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="componente2" id="componente2">
                        <label for="componente2" class="custom-control-label"
                            title="Marcar componente como presente">Wilkcimar Taquel de Medeiros
                            Batista</label>
                    </div>
                </div>
            </div> -->
            <button type="submit" class="btn btn-success float-right" title="Salvar lista de chamada">
                <i class="fas fa-fw fa-check"></i> Confirmar</button>
        </form>
    </div>
    <div class="card-footer"></div>
</div>