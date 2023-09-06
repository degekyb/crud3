<?php 
require_once('classes/Crud.php');
require_once('conexao/conexao.php');

$database = new Database();
$db = $database->getConnection();
$crud = new Crud($db);
/*esse codigo inicializa uma conexao com o banco de dados e cria uma instancia da classe Crud, 
que pode ser usada para realizar operacoes de CRUD no banco de dados, essa configuracao
 e geralmente o ponto de partida para a interacao com o banco de dados em uma aplicacao. */


if(isset($_GET['action'])){
    switch($_GET['action']){
    case 'create':
        $crud->create($_POST);
        $rows = $crud->read();
        break;
    case 'read':
        $rows = $crud->read();
        break;
        //case upadte

        //case delete

        default:
        $rows = $crud->read();
        break;
    }
}else{
    $rows = $crud->read();
}
/* este codigo controla diferentes acoes com base no parametro GET action na URL, realizando operacoes de criacao e 
leitura no banco de dados, com a capacidade de implementar acoes de atualizacao e exclusao no futuro */

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    form{
        max-width:500px;
        margin: 0 auto;
    }
    label{
        display: flex;
        margin:-top;
    }
    input[
        type=text]{
            width:100%;
            padding: 12px 20px;
            margin: 8px 0;
            display:inline-block;
            border: 1px solid #ccc;
            border-radius:4px;
            box-sizing:border-box;
        }
        input[type=submit]{
            background-color:#4caf50;
            color:white;
            padding:12px 20px;
            border:none;
            border-radius:4px;
            cursor:pointer;
            float:right;
        }
        input[type=submit]:hover{
            background-color:#45a049;
        }
        table{
            border-collapse:collapse;
            width:100%;
            font-family:Arial, sans-serif;
            font-size:14px;
            color:#333;
        }
        th, td{
            text-align:left;
            padding:8px;
            border: 1px solid #ddd;
        }
        th{ 
            background-color:#f2f2f2f2;
            font-weight:bold;
        }
        a{
            display:inline-block;
            padding:4px 8px;
            background-color: #007bff;
            color: #fff;
            text-decoration:none;
            border-radius:4px;
        }
        a:hover{
            background-color:#0069d9;

        }

        a.delete{
            background-color: #dc3545
        }
        a.delete:hover{
            background-color:#c82333;
        }

        
    </style>
    este e um esqueleto basico de uma pagina da web que provavelmente sera usada para interagir com registros de algum sistema, 
    a funcionalidade real e os detalhes especificos do conteudo devem ser implementados em outras partes do codigo HTML e em scripts 
    JavaScript ou PHP
</head>

    <table>
        <tr>
            <td>Id</td>
            <td>Modelo</td>
            <td>Marca</td>
            <td>Tamanho</td>
            <td>Cor</td>
            <td>Ações</td>
        </tr>
        <?php
            if($rows->rowCount() == 0){
                echo "<tr>";
                echo "<td colspan='7'>Nenhum dado encontrado</td>";
                echo "</tr>";

            } else {
                while($row = $rows->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['modelo'] . "</td>";
                echo "<td>" . $row['marca'] . "</td>";
                echo "<td>" . $row['tamanho'] . "</td>";
                echo "<td>" . $row['cor'] . "</td>";
                echo "<td>";
                echo "<a href='?action=update&id=" . $row['id'] . "'>Atualizar</a>";
                echo "<a href='?action=delete&id=" . $row['id'] . "' onclick='return confirm(\"Tem certeza que quer apagar esse registro?\")' class='delete'>Delete</a>";
                echo "</td>";
                echo "</tr>";
                }
            }
?>
/*esse codigo gera uma tabela HTML dinamica que exibe os registros do banco de dados e fornece opcoes para atualizacao e exclusao dos mesmos
 a logica especifica do banco de dados e a funcionalidade de atualizacao/exclusao devem ser implementadas no codigo PHP correspondente */
        
    </table>
</body>

            <?php

                if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])){
                    $id = $_GET['id'];
                    $result =$crud->read0ne($id);

                    if($result){
                        echo "Registro não encontrado";
                        exit();
                    }
                    $modelo = $result['modelo'];
                    $marca = $result['marca'];
                    $tamanho = $result['tamanho'];
                    $cor = $result['cor'];

                }
    
        ?>
    </html>
    /*este codigo PHP verifica se a pagina deve atualizar um registro no banco de dados com base no ID fornecido na URL.
    ele tenta recuperar os detalhes desse registro e os armazena em variaveis. Se o registro nao for encontrado, 
    exibe "Registro nao encontrado", a implementacao completa da funcionalidade de atualizacao do registro nao esta presente neste codigo
    ele apenas prepara os dados para a possivel edicao futura */