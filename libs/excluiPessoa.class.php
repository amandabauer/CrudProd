<?php

require('../autoload.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $oPessoa = new Pessoa();
    echo $oPessoa->excluir((int) $id);  
}

sleep(3);
echo `<script type="text/javascript">window.location = '../index.php';</script>`; 
    
?>