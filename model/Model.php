<?php 
    // Classe Model 'Pai' que tem como única função a conexão com o banco
    class Model{
        // Declaração das variáveis Globais para conexão com o banco
        public $_HOST_NAME = "localhost";
        public $_DATABASE_NAME = "mt4";
        public $_DATABASE_USER_NAME = "root";
        public $_DATABASE_PASSWORD = '';

        //Função de conexão simples utilizando PDO
        public function connect(){
            try {
                $conn = new PDO("mysql:host=$this->_HOST_NAME;dbname=$this->_DATABASE_NAME", $this->_DATABASE_USER_NAME, $this->_DATABASE_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }
        }
    }

?>