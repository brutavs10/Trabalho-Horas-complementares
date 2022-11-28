<?php
require_once('config.php');
require_once('./model' . DIRECTORY_SEPARATOR . 'myPDO.php');

$conn = new myPDO(APPDB); 

$crud  = 'select';
$prod  = [];
$uprod = [];

if(isset($_POST['crud']) && $_POST['crud'] != 'select')
{
    $crud = $_POST['crud'];

    if($_POST['crud'] == 'insert')
    {
        if(isset($_POST['Course']) && isset($_POST['Year'])  && isset($_POST['Semester']) && isset($_POST['Complementary Activity']) && isset($_POST['Registration']) && isset($_POST['student']) && isset($_POST['Workload']))
        {
            $sql = "INSERT INTO produto (nome, valor, valor, nome, valor, nome, valor) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $prm = [
               $_POST['Course'],
                $_POST['Year'],
                $_POST['Semester'],
                $_POST['Complementary Activity'],
                $_POST['Registration'],
                $_POST['Student'],
                $_POST['Workload'],
                
            ];
            $prod = $conn->insert($sql, $prm);
            
            $_SESSION['msg'] = $prod !== false ? 'Aluno cadastrado com sucesso!' : $prod;

            # Redirect to list products
            $prod = $conn->select("SELECT * FROM produto");
            $crud = 'select';
        }
    }
    else if($_POST['crud'] == 'update')
    {
        if(isset($_POST['id_update']))
        {
            $sql = "SELECT * FROM produto WHERE id_produto = ?";
            $prm = [
                $_POST['id_update'],
            ];
            $prod = $conn->select($sql, $prm);
            $uprod = $prod[0];
        }
        else if(isset($_POST['Course']) && isset($_POST['Year'])  && isset($_POST['Semester']) && isset($_POST['Complementary Activity']) && isset($_POST['Registration']) && isset($_POST['student']) && isset($_POST['Workload']))
         {
            $sql = "UPDATE Aluno SET nome = ?, valor = ?, valor = ?, nome = ?, valor = ?, nome = ?, valor = ? WHERE id_Aluno = ?";
            $prm = [
               $_POST['Course'],
               $_POST['Year'],
               $_POST['Semester'],
               $_POST['Complementary Activity'],
               $_POST['Registration'],
               $_POST['Student'],
               $_POST['Workload'],
               $_POST['id'],
            ];
            $prod = $conn->update($sql, $prm);
            $uprod = [
                "id_produto" => $_POST['id'],
                "nome"       => $_POST['Course'], $_POST['Complementary Activity'], $_POST['Student'],
                "valor"      => $_POST['Year'], $_POST['Semester'], $_POST['Registration'], $_POST['Workload'],
                ];
            
            $_SESSION['msg'] = $prod !== false ? 'Aluno atualizado com sucesso!' : $prod;
            
            # Redirect to list products
            $prod = $conn->select("SELECT * FROM produto");
            $crud = 'select';
        }
    }
    else if($_POST['crud'] == 'delete')
    {
        $sql = "DELETE FROM Aluno WHERE id_produto = ?";
        $prm = [
            $_POST['id_delete'],
        ];
        $prod = $conn->delete($sql, $prm);
        
        $_SESSION['msg'] = $prod !== false ? 'Aluno excluído com sucesso!' : $prod;

        # Redirect to list products
        $prod = $conn->select("SELECT * FROM produto");
        $crud = 'select';
    }
}
else
{
    $prod = $conn->select("SELECT * FROM produto");
}

// echo "<pre>";
// print_r($_POST);
// print_r($prod);
// print_r($uprod);
// echo "</pre>";
