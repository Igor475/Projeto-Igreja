<?php
@session_start();

$nivel = @$_SESSION['nivel_usuario'];

if($limitar_tesoureiro == 'Sim') {
    if($nivel == 'tesoureiro') {
        echo 'Você não tem permissão para executar essa tarefa! Verifique com o Pastor.';
        exit();
    }
}

?>