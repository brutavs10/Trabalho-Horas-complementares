<?php

function require_view($file, $type)
{
    $variables = get_replacement($type);

    if($type == 'list_item')
    {
        $new_html = "";
        foreach($variables as $var)
        {
            $html = file_get_contents($file);

            foreach($var as $key => $val)
            {
                $html = str_replace($key, $val, $html);
            }

            $new_html .= $html;
        }
        
        $list = file_get_contents('view' . DIRECTORY_SEPARATOR . 'list.html');
        $html = str_replace('{{list_items}}', $new_html, $list);
    }
    else
    {
        $html = file_get_contents($file);

        foreach($variables as $key => $val)
        {
            $html = str_replace($key, $val, $html);
        }
    }

    echo $html;
}



function get_replacement($type)
{
    global $crud;
    global $uprod;

    if($type == 'header')
    {
        $alert = isset($_SESSION['msg']) ? '<div class="alert alert-success" role="alert">'.$_SESSION['msg'].'</div>' : '';
        unset($_SESSION['msg']);

        if($crud == 'select')
        {
            return ['{{alert-msg}}' => $alert, '{{title}}' => 'Listagem de Alunos', '{{h1}} => 'Alunos'];     
			}
            
        else if($crud == 'insert')
        {
            return ['{{alert-msg}}' => $alert, '{{title}}' => 'CRUD - Insert', '{{h1}}' => 'Inserir Alunos'];     
            }
            
        else if($crud == 'update')
        {
            return ['{{alert-msg}}' => $alert, '{{title}}' => 'CRUD - Update', '{{h1}}' => 'Atualizar Alunos']; 
			}
                    
    else if($type == 'insert')
    {
        return ['{{crud}}' => 'insert', '{{id}}' => '', '{{Course}}' => '', '{{Year}}' => '',  '{{Semester}}' => '', '{{Complementary Activity}}' => '', '{{Registration}}' => '', '{{Student}}' => '', '{{Worload}}' =>, '{{btn}}' => 'Cadastrar']; 
    }
    else if($type == 'update')
    {
        $id    = isset($uprod['id_produto']) ? $uprod['id_produto'] : '';
        $nome  = isset($uprod['nome']) ? $uprod['nome'] : '';
        $valor = isset($uprod['valor']) ? $uprod['valor'] : '';

        return ['{{crud}}' => 'update', '{{id}}' => $id, '{{product}}' => $nome, '{{price}}' => $valor, '{{btn}}' => 'Atualizar']; 
    }
    else if($type == 'list_item')
    {
        return mount_replacement();
    }

    return [];
}

function mount_replacement()
{
    global $prod;

    $data = [];

    foreach($prod as $rtn)
    {
        array_push($data, [
            '{{id}}'       => $rtn['id_produto'],
            '{{product}}'  => $rtn['nome'],
            '{{price}}'    => number_format($rtn['valor'], 2, ',', '.'),
            '{{discount}}' => number_format($rtn['valor_desconto'], 2, ',', '.'),
        ]);
    }

    return $data;
}
