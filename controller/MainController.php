<?php 
    // É preciso incluir o Model para itilizar suas funções
    include("../model/MainModel.php");

    //Já instancio como global pois todas as clausulas irão utilizar do Model
    $model = new MainModel;
    
    // Caso exista o post store significa que esta sendo requisitado uma nova inclusão
    if(isset($_POST['store'])){
        $data['nome']          = $_POST['nome'];
        $data['email']         = $_POST['email'];
        $data['email_tipo']    = $_POST['email_tipo'];
        $data['telefone']      = $_POST['telefone'];
        $data['telefone_tipo'] = $_POST['telefone_tipo'];
        $data['ddd']           = $_POST['ddd'];

        $model->storeContato($data);
    }

    // Caso tenha uma requisisçao de get_contatos significa que preciso de todos eles
    if (isset($_GET['get_contatos'])) {
        $model->getContatos();
    }

    if (isset($_GET['id_contato'])) {
        $id_contato   = $_GET['id_contato'];
        $model->getContato($id_contato);
    }
 ?>