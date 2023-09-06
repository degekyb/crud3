<?php
include_once('conexao/conexao.php');

$db = new Database();

class Crud{
    private $conn;
    private $table_name = "tenis";

    public function __construct($db){
        $this->conn = $db;

    }
    /*este código esta definindo uma classe Crud que vai ser usada para realizar operacoes no banco de dados relacionado a tabela
     "tenis". Ele depende de uma conexao com o banco de dados estabelecida pela classe Database. As operacoes de CRUD reais provavelmente
      seriam implementadas como métodos dentro da classe Crud*/

    //funcao para criar meus registros
    public function create($postValues){
        $modelo = $postValues['modelo'];
        $marca = $postValues['marca'];
        $placa = $postValues['tamanho'];
        $cor = $postValues['cor'];


        $query = "INSERT " . $this->table_name . " (modelo, marca, tamanho, cor) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$modelo);
        $stmt->bindParam(2,$marca);
        $stmt->bindParam(3,$tamanho);
        $stmt->bindParam(4,$cor);
        /*esse trecho de codigo e responsavel por criar um novo registro no banco de dados com base nos valores disponibilizado no array 
        $postValues. Ele constroi uma consulta SQL, vincula os valores e a executa, com base na conexao com o banco de dados disponivel 
        na classe Crud */
    }
        $rows = $this->read();
       if ($stmt->execute()) {
    // Consulta bem-sucedida
    print "<script>alert('Cadastro Ok!')</script>";
    print "<script> location.href='?action=read';</script>";
} else {
    // Erro na consulta
    print "<script>alert('Erro ao cadastrar!')</script>";
}
/*este codigo esta tratando a resposta da execucao da consulta SQL, fornecendo feedback ao usuario com base no resultado da operacao
 no banco de dados. Se for bem sucedido, exibe uma mensagem de sucesso e redireciona o usuario; se houver um erro, exibe uma mensagem
 de erro. */

            return false;


        //funcao para ler os regitros
        public function read(){
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
        }
        /* essas duas funcoes estao relacionadas a operacoes basicas de CRUD em um banco de dados, 
        permitindo criar novos registros e ler todos os registros de uma tabela especifica.*/

        //funcao de atualizar registros
        public function update($postValues){
            $id = $postValues['id'];
            $modelo = $postValues['modelo'];
            $marca = $postValues['marca'];
            $placa = $postValues['placa'];
            $cor =  $postValues['cor'];

            if(empty($id) || empty($marca) || empty($tamanho) || empty($cor)){
                return false;
            }
            /*essa parte do codigo e uma verificacao para garantir que os dados principais estejam presentes antes de prosseguir
             com a operacao de atualizacao no sistema ou banco de dados.*/

                    $query = "UPDATE ". $this->table_name . " SET modelo = ?, marca = ?, tamanho = ?, cor = ? WHERE ID = ?";
                    $stmt->bindParam(1,$modelo);
                    $stmt->bindParam(2,$marca);
                    $stmt->bindParam(3,$tamanho);
                    $stmt->bindParam(4,$cor);
                    $stmt->bindParam(6,$id);
                    if($stmt->execute()){
                        return true;
                    }else{
                        return false;
                    }
                /* este codigo e responsavel por construir e executar uma consulta SQL de atualizacao em um banco de dados. 
                Ele atualiza um registro na tabela especificada com base nos valores fornecidos nas variaveis, se a atualizacao for bem sucedida, 
                a funcao retorna true, se nao retorna false */
            
            //funcao para apagar os registros do banco e inserir no formulario
            public function read0ne($id){
                $query = "SELECT * FROM     ". $this->table_name . " WHERE id = ?";
                $stmt =$this->conn->prepare($query);
                $stmt->binfParam(1, $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
                /*a funcao retorna esse registro como resultado, portanto este codigo permite recuperar um unico registro da tabela
                 especificada com base no ID fornecido como parametro para a funcao ($id) */


        }
    }
    
}


?>