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
        if(isset($_POST['product']) && isset($_POST['price']))
        {
            $sql = "INSERT INTO produto (nome, valor) VALUES (?, ?)";
            $prm = [
                $_POST['product'],
                $_POST['price'],
            ];
            $prod = $conn->insert($sql, $prm);
            
            $_SESSION['msg'] = $prod !== false ? 'Produto cadastrado com sucesso!' : $prod;

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
        else if(isset($_POST['id']) && isset($_POST['product']) && isset($_POST['price']))
        {
            $sql = "UPDATE produto SET nome = ?, valor = ? WHERE id_produto = ?";
            $prm = [
                $_POST['product'],
                $_POST['price'],
                $_POST['id'],
            ];
            $prod = $conn->update($sql, $prm);
            $uprod = [
                "id_produto" => $_POST['id'],
                "nome"       => $_POST['product'],
                "valor"      => $_POST['price'],
                ];
            
            $_SESSION['msg'] = $prod !== false ? 'Produto atualizado com sucesso!' : $prod;
            
            # Redirect to list products
            $prod = $conn->select("SELECT * FROM produto");
            $crud = 'select';
        }
    }
    else if($_POST['crud'] == 'delete')
    {
        $sql = "DELETE FROM produto WHERE id_produto = ?";
        $prm = [
            $_POST['id_delete'],
        ];
        $prod = $conn->delete($sql, $prm);
        
        $_SESSION['msg'] = $prod !== false ? 'Produto excluído com sucesso!' : $prod;

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