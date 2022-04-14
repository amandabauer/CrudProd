<?php
require('autoload.php');

GLOBAL $conn;
$conn = new Conexao();
// $result = $conn->getSelect("SELECT * FROM pessoa");
// echo $result->nome;

$metaCharset = new Meta("UTF-8");
$metaHttEquiv = new Meta(null, null, "X-UA-Compatible", "IE=edge");
$metaName = new Meta(null, "viewport", null, "width=device-width, initial-scale=1.0");

$title = new Title("Atividade");

$linkBootstrap = new LinkCss("https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css","stylesheet", "sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl","anonymous");

$head = new Head();
$head->addElement($metaCharset);
$head->addElement($metaHttEquiv);
$head->addElement($metaName);
$head->addElement($linkBootstrap);
$head->addElement($title);

$body = new Body("body");

$container = new Div("container");
$barra = new Div("row");
$conteudoBarra = new Div("col bg-warning");
$texto = new Texto("Atividade");
$conteudoBarra->addElement($texto);
$barra->addElement($conteudoBarra);

$areaprincipal = new Div("row");

$dados_menu = $conn->getSelect("SELECT * FROM menu where tipo = 'lista'");
$menu = new Menu(new Div("col-sm-2"),
                $dados_menu);

$miolo = new Div("col-sm-10");

function object_to_array($obj) {
    $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($_arr as $key => $val) {
        $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
        $arr[$key] = $val;
    }
    return $arr;
}


if (isset($_GET["pagina"])) {
    //montar a tabela de dados
    $page = $_GET["pagina"];
    $consulta_dados =  $conn->getSelect("SELECT * FROM menu WHERE acao = '?pagina={$page}'");

    if ($consulta_dados[0]->tipo=='lista') {
        $dados_tabela = $conn->getSelect($consulta_dados[0]->sqltabela);
        $colunas = explode(",",$consulta_dados[0]->colunas);

        for ($i=0;$i<=count($colunas);$i++) {
            @$pagina .= $colunas[$i]."   ";
        }
        $pagina .= "<br>";
        foreach($dados_tabela as $valor) {
            for ($i=0;$i<=count($colunas)-1;$i++) {
                $obj_array = get_object_vars($valor);
                $array_keys = array_keys($obj_array);
                $pagina .= $obj_array[$array_keys[$i]]."   ";
                
            }
            $pagina .= " link upadte ?pagina=pessoa_editar&id=" . $obj_array[$array_keys[0]];
            $pagina .= " link delete ?pagina=pessoa_deletar&id=" . $obj_array[$array_keys[0]];
            $pagina .= "<br>";
        }
        //$pagina = $_GET["pagina"];
    }
    if ($consulta_dados[0]->tipo=='cadastro') {
        $pagina = 'cadastro';
    }
    if ($consulta_dados[0]->tipo=='editar') {
        $pagina = '<form><label>Nome</label><input value="nome"></form>';
    }
    if ($consulta_dados[0]->tipo=='excluir') {
        $pagina = 'exclusão';
    }
} else  {
    $pagina = "Selecione uma das opções no menu";
}
$miolo->addElement($pagina);

$areaprincipal->addElement($menu);
$areaprincipal->addElement($miolo);

$container->addElement($barra);
$container->addElement($areaprincipal);

$body->addElement($container);


$form = new FormPessoa("id", "nome", "email");
$divform = new Div("input-group mb-3");
$input = new Input('text','form-control','Username','Username');
$form->addElementForms($input);
$divform->addElement($form);
$div1->addElement($ul);
$div1->addElement($table);
$div1->addElement($divform);
$body->addElement($div1);

$miolo->addElement($form);

$table = new Table();
$th1 = new Tr();
$th1->addElementTr(new Td('IDENTIFICAÇÃO'), new Td('NOME'), new Td('E-MAIL'), new Td('CRIAÇÃO DO USUÁRIO'), new Td('Excluir'));
// usar função da classe pessoa para buscar todas as pessoas
// para cada pessoa que retornar da função anterior deverá gerar um TR. Colocar cada campo dentro de um td
$table->addElements($th1);
$ePessoa = new Pessoa();
foreach($ePessoa->buscar() as $linhaResultadoFuncao) {

    $form_excluir = new Form('POST', 'acoes/excluiPessoa.php');
    $input_excluir = new Input('form-control', [
        'type' => 'submit',
        'name' => 'excluir',
        'value' => "X"
    ]);
    $input_pessoa = new Input('form-control', [
        'type' => 'hidden',
        'name' => 'id',
        'value' => "$linhaResultadoFuncao[0]"
    ]);
    
    $form_excluir->addElementForms($input_excluir);
    $form_excluir->addElementForms($input_pessoa);

    $tr = new Tr();
    $tr->addElementTr(
                    new Td($linhaResultadoFuncao[0]), 
                    new Td($linhaResultadoFuncao[1]), 
                    new Td($linhaResultadoFuncao[2]), 
                    new Td($linhaResultadoFuncao[4]),
                    new Td($form_excluir)
                );
    $table->addElements($tr);
}
$miolo->addElement($table);



$html = new Html("pt-br", $head, $body);

echo $html;

?>

