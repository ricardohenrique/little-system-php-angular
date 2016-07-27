<?php 
    //É preciso incluir o Model de coneção aqui
    include('Model.php');

    //Model com todas as funções relacionadas ao banco de dados
    class MainModel extends Model{

        //Função de gravar um contato
        public function storeContato($data){
            $conn = $this::connect(); //Poderia fazer fireto com $this::connect() mas isso pode dar problema na frente
            $stmt = $conn->prepare("INSERT INTO contato (nome) VALUES (:nome)");
            $stmt->bindParam(':nome', $data['nome']);
            $stmt->execute();
            $data['last_id_insert'] = $conn->lastInsertId(); //Insiro o novo contato e pego o id dele
            $this::storeContatoEmail($data); //Chama a função para inserir o email do novo contato
        }
        
        //Função de gravar o email do contato
        public function storeContatoEmail($data){
            $conn = $this::connect();

            foreach ($data['email'] as $key => $value) {
                $stmt = $conn->prepare("INSERT INTO contato_email (id_contato_email_tipo, id_contato, email) VALUES (:id_contato_email_tipo, :id_contato, :email)");
                $stmt->bindParam(':id_contato_email_tipo', $data['email_tipo'][$key]);
                $stmt->bindParam(':id_contato', $data['last_id_insert']);
                $stmt->bindParam(':email', $value);
                $stmt->execute();
            }

            $this::storeContatoTelefone($data); //Chama a função para inserir o telefone do novo contato
        }

        //Função de gravar o telefone do contato
        public function storeContatoTelefone($data){
            $conn = $this::connect();

            foreach ($data['telefone'] as $key => $value) {
                $stmt = $conn->prepare("INSERT INTO contato_telefone (id_contato_telefone_tipo, id_contato, telefone, ddd) VALUES (:id_contato_telefone_tipo, :id_contato, :telefone, :ddd)");
                $stmt->bindParam(':id_contato_telefone_tipo', $data['telefone_tipo'][$key]);
                $stmt->bindParam(':id_contato', $data['last_id_insert']);
                $stmt->bindParam(':telefone', $value);
                $stmt->bindParam(':ddd', $data['ddd'][$key]);
                $stmt->execute();
            }

            //Quando é gravado o telefone já podemos redirecionar pra HOME
            header("Location: http://localhost/mt4");
        }

        //Função para pegar todos os contatos do banco
        public function getContatos(){
            $conn = $this::connect();

            //Query responsável por pegar todas as informações.
            $consulta = $conn->query("
                SELECT 
                    contato.id_contato as contato_id, 
                    contato.nome as contato_nome
                from contato
                order by contato.id_contato;
            ");

            $consulta->execute();
            $data = $consulta->fetchAll();

            //Converte o array de dados em json
            $myJSON = json_encode($data);

            //retorna o json
            print_r($myJSON);
        }

        //Função para pegar todos os contatos do banco
        public function getContato($id_contato){
            $conn = $this::connect();

            //Query responsável por pegar todas as informações.
            $consulta = $conn->query("
                SELECT 
                    contato.id_contato as contato_id, 
                    contato.nome as contato_nome, 
                    contato_email.email as email_contato,
                    contato_email_tipo.nome as contato_email_tipo,
                    contato_telefone.telefone as contato_telefone,
                    contato_telefone.ddd as contato_telefone_ddd,
                    contato_telefone_tipo.nome as contato_telefone_tipo
                from contato
                left join contato_email on (contato.id_contato = contato_email.id_contato)
                left join contato_email_tipo on (contato_email.id_contato_email_tipo = contato_email_tipo.id_contato_email_tipo)
                left join contato_telefone on (contato.id_contato = contato_telefone.id_contato)
                left join contato_telefone_tipo on (contato_telefone.id_contato_telefone_tipo = contato_telefone_tipo.id_contato_telefone_tipo)
                where contato.id_contato = $id_contato;
            ");

            $consulta->execute();
            $data = $consulta->fetchAll();

            //Converte o array de dados em json
            $myJSON = json_encode($data);

            //retorna o json
            print_r($myJSON);
        }
    }

?>