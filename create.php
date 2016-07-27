<?php include('include/head.php') ?>
    <div class="container">
        <div class="row">
            <form class="col s12" method="POST" action="controller/MainController.php">
                <input type="hidden" name="store" value="1">
                <div class="card light-blue darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Nome</span>
                        <div class="input-field">
                            <i class="prefix fa fa-user" aria-hidden="true"></i>
                            <input id="nome" type="text" name="nome" class="validate" required="required">
                            <label for="nome">Nome</label>
                        </div>
                    </div>
                </div>
                <div class="card light-blue darken-4 ">
                    <div class="card-content white-text row">
                        <span class="card-title col s12">Email</span>
                    </div>
                    <div class="card-content white-text row"  ng-repeat="email in emails track by $index">
                        <div class="input-field col s10">
                            <i class="prefix fa fa-envelope" aria-hidden="true"></i>
                            <input id="email" type="email" name="email[]" class="validate" required="required">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col s2">
                            <select class="browser-default" name="email_tipo[]" required="">
                                <option value="" disabled selected>Tipo</option>
                                <option value="1">Pessoal</option>
                                <option value="2">Trabalho</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="button" class="btn light-blue lighten-2" ng-click="addEmail()">Novo</button>
                        <button type="button" class="btn red darken-3" ng-click="removeEmail($index)" >Remover</button>
                    </div>
                </div>
                <div class="card light-blue darken-4">
                    <div class="card-content white-text row">
                        <span class="card-title col s12">Telefone</span>
                    </div>
                    <div class="card-content white-text row" ng-repeat="telefone in telefones track by $index">
                        <div class="input-field col s2">
                            <i class="prefix fa fa-phone-square" aria-hidden="true"></i>
                            <input id="ddd" type="number" name="ddd[]" class="validate" required="required">
                            <label for="ddd">DDD</label>
                        </div>
                        <div class="input-field col s8">
                            <input id="telefone" type="number" name="telefone[]" class="validate" required="required">
                            <label for="telefone">Telefone</label>
                        </div>
                        <div class="input-field col s2">
                            <select class="browser-default" name="telefone_tipo[]" required="">
                                <option value="" disabled selected>Tipo</option>
                                <option value="1">Celular</option>
                                <option value="2">Residencial</option>
                                <option value="3">Trabalho</option>
                            </select>
                          </div>
                    </div>
                    <div class="card-action">
                        <button type="button" class="btn light-blue lighten-2" ng-click="addTelefone()">Novo</button>
                        <button type="button" class="btn red darken-3" ng-click="removeTelefone($index)" >Remover</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button class="waves-effect waves-light btn-large cyan center-align">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php include('include/footer.php') ?>