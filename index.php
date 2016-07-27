<?php include('include/head.php') ?>
    <div class="container">
        <div class="row">
            <div class="input-field col s12">
                <i class="prefix fa fa-search-plus" aria-hidden="true"></i>
                <input id="icon_prefix" type="text" class="validate" ng-model="filterContato"> 
                <label for="icon_prefix">Pesquisar</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <table class="bordered striped centered" id="tabela">
                    <thead>
                        <tr>
                            <th data-field="contato_id" ng-click="sortType = 'contato.contato_id'; sortReverse = !sortReverse">
                                ID Contato {{fullName()}}
                                <i ng-show="sortType == 'contato.contato_id' && !sortReverse" class="fa fa-angle-down"></i>
                                <i ng-show="sortType == 'contato.contato_id' && sortReverse" class="fa fa-angle-up"></i>
                            </th>
                            <th data-field="contato_nome" ng-click="sortType = 'contato.contato_nome'; sortReverse = !sortReverse">
                                Nome Contato
                                <i ng-show="sortType == 'contato.contato_nome' && !sortReverse" class="fa fa-angle-down"></i>
                                <i ng-show="sortType == 'contato.contato_nome' && sortReverse" class="fa fa-angle-up"></i>
                            </th>
                            <th data-field="ver">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr dir-paginate="contato in response | orderBy:sortType:sortReverse |filter:filterContato | itemsPerPage:5">
                            <td>{{contato.contato_id}}</td>
                            <td>{{contato.contato_nome}}</td>
                            <td>
                                <a class="waves-effect waves-light btn modal-trigger" id="#modal_contato" ng-click='getContact(contato.contato_id)' onclick="openModal()">Ver</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" ></dir-pagination-controls>
            </div>
        </div>
    </div>
    <div class="modal" id="modal_contato">
        <div class="modal-content">
            <h4 ng-repeat="contato in contato_unico | limitTo:1">{{contato.contato_nome}}</h4>
            <p ng-repeat="contato in contato_unico | limitTo:1"><strong>ID: </strong>{{contato.contato_id}}</p>
            <p ng-repeat="contato in contato_unico | limitTo:1"><strong>Nome: </strong>{{contato.contato_nome}}</p>

            <p><strong>Email Contato:</strong></p>
            <ul ng-repeat="contato in contato_unico | unique:'email_contato'" class="fa-ul">
                <li ng-if="!contato.email_contato"></li>
                <li ng-if="contato.email_contato"><i class="fa-li fa fa-envelope-o"></i> {{contato.email_contato}} - {{contato.contato_email_tipo}}</li>
            </ul>

            <p><strong>Contato Telefone:</strong></p>
            <ul ng-repeat="contato in contato_unico | unique:'contato_telefone'" class="fa-ul">
                <li ng-if="!contato.contato_telefone"></li>
                <li ng-if="contato.contato_telefone"><i class="fa-li fa fa-phone"></i> ({{contato.contato_telefone_ddd}}) {{contato.contato_telefone | tel}} - {{contato.contato_telefone_tipo}}</li>
            </ul>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>
    <div ng-repeat="contato in response" id="modal{{contato.contato_id}}" class="modal">
        <div class="modal-content">
            <h4>{{contato.contato_nome}}</h4>
            <p>
                <strong>ID: </strong>{{contato.contato_id}}<br>
                <strong>Nome: </strong>{{contato.contato_nome}}<br>
                <strong>Email Contato: </strong>{{contato.email_contato}}<br>
                <strong>Contato Email Tipo: </strong>{{contato.contato_email_tipo}}<br>
                <strong>Contato Telefone: </strong>{{contato.contato_telefone}}<br>
                <strong>Contato Telefone Tipo: </strong>{{contato.contato_telefone_tipo}}
            </p>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>
<?php include('include/footer.php') ?>