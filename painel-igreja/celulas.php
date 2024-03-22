<?php
require_once ("../conexao.php");
$pagina = 'celulas';
?>

<div class="buttons_register">
    <a href="#" onclick="inserir()" class="button_tables_register">
        Nova Célula
        <i class="bi bi-plus-lg icon_tables_registers"></i>
    </a>
</div>


<div class="tabs">
    <div class="table-container">
        <?php
        $query = $pdo->query("SELECT * FROM $pagina WHERE igreja = '$id_igreja' order by id desc");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = count($res);
        if ($total_reg > 0) {
            ?>
            <table class="content-table" id="example">
                <thead class="thead-tabs">
                    <tr class="column-table">
                        <th class="th-table">Nome</th>
                        <th class="th-table">Horário</th>
                        <th class="th-table">Pastor Responsável</th>
                        <th class="th-table">Coordenador</th>
                        <th class="th-table">Líder</th>
                        <th class="th-table column-hidden">Líder em Treinamento</th>
                        <th class="th-table last_table" id="radius-action">Ações</th>
                    </tr>
                </thead>
                <tbody class="body-table">
                    <?php
                    for ($i = 0; $i < $total_reg; $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $nome = $res[$i]['nome'];
                        $dias = $res[$i]['dias'];
                        $hora = $res[$i]['hora'];
                        $local = $res[$i]['local'];
                        $pastor = $res[$i]['pastor'];
                        $coordenador = $res[$i]['coordenador'];
                        $lider1 = $res[$i]['lider1'];
                        $lider2 = $res[$i]['lider2'];
                        $obs = $res[$i]['obs'];
                        $id = $res[$i]['id'];

                        $query_con = $pdo->query("SELECT * FROM pastores where id = '$pastor'");
                        $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
                        if (count($res_con) > 0) {
                            $nome_pastor = $res_con[0]['nome'];
                        } else {
                            $nome_pastor = 'Nenhum!';
                        }

                        $query_con = $pdo->query("SELECT * FROM membros where id = '$coordenador'");
                        $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
                        if (count($res_con) > 0) {
                            $nome_coordenador = $res_con[0]['nome'];
                        } else {
                            $nome_coordenador = 'Nenhum!';
                        }

                        $query_con = $pdo->query("SELECT * FROM membros where id = '$lider1'");
                        $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
                        if (count($res_con) > 0) {
                            $nome_lider1 = $res_con[0]['nome'];
                        } else {
                            $nome_lider1 = 'Nenhum!';
                        }

                        $query_con = $pdo->query("SELECT * FROM membros where id = '$lider2'");
                        $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
                        if (count($res_con) > 0) {
                            $nome_lider2 = $res_con[0]['nome'];
                        } else {
                            $nome_lider2 = 'Nenhum!';
                        }

                        ?>
                        <tr class="column-body">
                            <td data-label="Nome" class="td-table">
                                <span class="">
                                    <?php echo $nome ?>
                                </span>
                            </td>
                            <td data-label="Dia" class="td-table column-hidden">
                                <?php echo $dias ?>
                            </td>
                            <td data-label="Hora" class="td-table">
                                <?php echo $hora ?>
                            </td>
                            <td data-label="Pastor" class="td-table">
                                <?php echo $nome_pastor ?>
                            </td>
                            <td data-label="Coordenador" class="td-table">
                                <?php echo $nome_coordenador ?>
                            </td>
                            <td data-label="Coordenador" class="td-table">
                                <?php echo $nome_lider1 ?>
                            </td>
                            <td data-label="Coordenador" class="td-table">
                                <?php echo $nome_lider2 ?>
                            </td>
                            <td class="td-table" id="radius-column-action">
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Opções
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="editar('<?php echo $id ?>', '<?php echo $nome ?>',
                                            '<?php echo $dias ?>', '<?php echo $hora ?>', '<?php echo $local ?>', '<?php echo $pastor ?>', 
                                            '<?php echo $coordenador ?>', '<?php echo $lider1 ?>', '<?php echo $lider2 ?>')">
                                                <i class="bi bi-pencil-square icons_actions"></i>
                                                Editar</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="excluir('<?php echo $id ?>', '<?php echo $nome ?>')">
                                                <i class="bi bi-trash3 icons_actions"></i>
                                                Excluir
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="dados('<?php echo $nome ?>', '<?php echo $dias ?>',
                                            '<?php echo $hora ?>', '<?php echo $local ?>', '<?php echo $nome_pastor ?>',
                                            '<?php echo $nome_coordenador ?>', '<?php echo $nome_lider1 ?>', '<?php echo $nome_lider2 ?>', 
                                            '<?php echo $obs ?>')">
                                                <i class="bi bi-info-circle icons_actions"></i>
                                                Ver Dados</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item <?php echo $classe_obs ?>" href="#" onclick="obs('<?php echo $id ?>', 
                                            '<?php echo $nome ?>', '<?php echo $obs ?>')">
                                                <i class="bi bi-chat-right-text icons_actions"></i>
                                                Observações</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else {
            echo 'Não existem dados cadastrados!';
        }
        ?>
    </div>
</div>







<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="Cadastro" id="tituloModal"></h3>
                <span class="bi bi-x mod_close" data-bs-dismiss="modal" aria-label="Close"></span>
            </div>
            <form id="form" method="post">
                <div class="modal-body">
                    <div action="#" class="form-modal">
                        <div class="form first">
                            <div class="fields">
                                <div class="input-field">
                                    <label>Nome</label>
                                    <input type="text" name="nome" id="nome" placeholder="Nome da Célula" required>
                                </div>

                                <div class="input-field flex_int_3">
                                    <label>Dias</label>
                                    <input type="text" name="dias" id="dias" placeholder="Dia da Célula">
                                </div>

                                <div class="input-field flex_int_2">
                                    <label>Horário</label>
                                    <input type="text" name="hora" id="hora" placeholder="Horário da Célula" required>
                                </div>

                                <div class="input-field flex_int_3">
                                    <label>Local da Célula</label>
                                    <input type="text" name="local" id="local" placeholder="Local da Célula" required>
                                </div>

                                <div class="input-field flex_int_7">
                                    <label>Pastor</label>
                                    <select class="sel21" id="pastor" name="pastor">
                                        <option value="">Selecione um Pastor</option>
                                        <?php
                                        $query = $pdo->query("SELECT * FROM pastores WHERE igreja = '$id_igreja' order by nome asc");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $total_reg = count($res);
                                        if ($total_reg > 0) {
                                            for ($i = 0; $i < $total_reg; $i++) {
                                                foreach ($res[$i] as $key => $value) {
                                                }

                                                $nome_reg = $res[$i]['nome'];
                                                $id_reg = $res[$i]['id'];
                                                ?>
                                                <option value="<?php echo $id_reg ?>">
                                                    <?php echo $nome_reg ?>
                                                </option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>

                                <div class="input-field flex_int_7">
                                    <label>Coordenador</label>
                                    <select class="sel2" id="coordenador" name="coordenador">
                                        <option value="">Selecione um Membro</option>
                                        <?php
                                        $query = $pdo->query("SELECT * FROM membros WHERE igreja = '$id_igreja' order by nome asc");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $total_reg = count($res);
                                        if ($total_reg > 0) {
                                            for ($i = 0; $i < $total_reg; $i++) {
                                                foreach ($res[$i] as $key => $value) {
                                                }

                                                $nome_reg = $res[$i]['nome'];
                                                $id_reg = $res[$i]['id'];
                                                ?>
                                                <option value="<?php echo $id_reg ?>">
                                                    <?php echo $nome_reg ?>
                                                </option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>

                                <div class="input-field flex_int_7">
                                    <label>Líder</label>
                                    <select class="sel2" id="lider1" name="lider1">
                                        <option value="">Selecione um Membro</option>
                                        <?php
                                        $query = $pdo->query("SELECT * FROM membros WHERE igreja = '$id_igreja' order by nome asc");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $total_reg = count($res);
                                        if ($total_reg > 0) {
                                            for ($i = 0; $i < $total_reg; $i++) {
                                                foreach ($res[$i] as $key => $value) {
                                                }

                                                $nome_reg = $res[$i]['nome'];
                                                $id_reg = $res[$i]['id'];
                                                ?>
                                                <option value="<?php echo $id_reg ?>">
                                                    <?php echo $nome_reg ?>
                                                </option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>

                                <div class="input-field flex_int_7">
                                    <label>Líder em Treinamento</label>
                                    <select class="sel2" id="lider2" name="lider2">
                                        <option value="">Selecione um Membro</option>
                                        <?php
                                        $query = $pdo->query("SELECT * FROM membros WHERE igreja = '$id_igreja' order by nome asc");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $total_reg = count($res);
                                        if ($total_reg > 0) {
                                            for ($i = 0; $i < $total_reg; $i++) {
                                                foreach ($res[$i] as $key => $value) {
                                                }

                                                $nome_reg = $res[$i]['nome'];
                                                $id_reg = $res[$i]['id'];
                                                ?>
                                                <option value="<?php echo $id_reg ?>">
                                                    <?php echo $nome_reg ?>
                                                </option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>

                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="igreja" id="igreja" value="<?php echo $id_igreja ?>">

                            </div>
                        </div>
                    </div>
                </div>
                <div id="mensagem"></div>
                <div class="modal-footer">
                    <div class="area-buttons">
                        <button type="button" id="btn-fechar" class="btn-close" data-bs-dismiss="modal">Fechar</button>

                        <button type="submit" class="btn-add">
                            Salvar
                            <i class="bi bi-pencil-square icon-btn-form"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>







<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="Cadastro">Excluir Registro</h3>
                <span class="bi bi-x mod_close" data-bs-dismiss="modal" aria-label="Close"></span>
            </div>
            <form id="form-excluir" method="post">
                <div class="modal-body">
                    <div action="#" class="form-modal-auto">
                        <div class="form first">
                            <div class="details personal">

                                <span class="text_excluir">Deseja mesmo excluir este Registro
                                    <span id="nome-excluido"></span>?

                                    <div id="mensagem-excluir"></div>

                                    <input type="hidden" name="id-excluir" id="id-excluir">

                            </div>
                        </div>
                    </div>
                </div>
                <div id="mensagem"></div>
                <div class="modal-footer">
                    <div class="area-buttons">
                        <button type="button" id="btn-fechar-excluir" class="btn-close"
                            data-bs-dismiss="modal">Fechar</button>

                        <button type="submit" class="btn-remove">
                            Excluir
                            <i class="bi bi-trash3 icon-btn-form"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="Cadastro">Nome: <span id="nome-dados"></span></h3>
                <span class="bi bi-x mod_close" data-bs-dismiss="modal" aria-label="Close"></span>
            </div>
            <div class="modal-body scroll-modal">
                <div class="user_area">
                    <img src="../img/svg/cpf.svg" class="img_icon_data" alt="">
                    <span class="user_name">Dias: </span>
                    <span class="texts_son" id="dias-dados"></span>
                </div>
                <div class="user_area">
                    <img src="../img/svg/email.svg" class="img_icon_data" alt="">
                    <span class="user_name">Horário:</span>
                    <span class="texts_son" id="hora-dados"></span>
                </div>
                <div class="user_area">
                    <img src="../img/svg/telefone.svg" class="img_icon_data" alt="">
                    <span class="user_name">Local: </span>
                    <span class="texts_son" id="local-dados"></span>
                </div>
                <div class="user_area">
                    <img src="../img/svg/map_endereco.svg" class="img_icon_data" alt="">
                    <span class="user_name">Pastor Responsável: </span>
                    <span class="texts_son" id="pastor-dados"></span>
                </div>
                <div class="user_area">
                    <img src="../img/svg/calendario.svg" class="img_icon_data" alt="">
                    <span class="user_name">Coordenador: </span>
                    <span class="texts_son" id="coordenador-dados"></span>
                </div>
                <div class="user_area">
                    <img src="../img/svg/calendario.svg" class="img_icon_data" alt="">
                    <span class="user_name">Líder da Célula: </span>
                    <span class="texts_son" id="lider1-dados"></span>
                </div>
                <div class="user_area">
                    <img src="../img/svg/igreja.svg" class="img_icon_data" alt="">
                    <span class="user_name">Líder em Treinamento: </span>
                    <span class="texts_son" id="lider2-dados"></span>
                </div>
                <div class="user_area">
                    <img src="../img/svg/calendario.svg" class="img_icon_data" alt="">
                    <span class="user_name">OBS: </span>
                    <span class="texts_son" id="obs-dados"></span>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="modalObs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="Cadastro">Observações - <span id="nome-obs"></span></h3>
                <span class="bi bi-x mod_close" data-bs-dismiss="modal" aria-label="Close"></span>
            </div>
            <form id="form-obs" method="post">
                <div class="modal-body">
                    <div class="area_obs">
                        <label class="txt_label_obs">Observações (Máximo de 1000 Caracteres)</label>
                        <textarea class="txt-obs" name="obs" id="obs" maxlength="1000"></textarea>
                    </div>

                    <div id="mensagem-obs"></div>

                    <input type="hidden" name="id-obs" id="id-obs">

                </div>
                <div id="mensagem"></div>
                <div class="modal-footer">
                    <div class="area-buttons">
                        <button type="button" id="btn-fechar-obs" class="btn-close"
                            data-bs-dismiss="modal">Fechar</button>

                        <button type="submit" class="btn-add">
                            Salvar
                            <i class="bi bi-pencil-square icon-btn-form"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





<script type="text/javascript">
    var pag = "<?= $pagina ?>" 
</script>
<script src="../js/ajax.js"></script>




<script type="text/javascript">
    function editar(id, nome, dias, hora, local, pastor, coordenador, lider1, lider2) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#dias').val(dias);
        $('#local').val(local);
        $('#hora').val(hora);
        $('#pastor').val(pastor).change();
        $('#coordenador').val(coordenador).change();
        $('#lider1').val(lider1).change();
        $('#lider2').val(lider2).change();

        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }


    function dados(nome, dias, hora, local, pastor, coordenador, lider1, lider2, obs) {

        $('#nome-dados').text(nome);
        $('#dias-dados').text(dias);
        $('#hora-dados').text(hora);
        $('#local-dados').text(local);
        $('#pastor-dados').text(pastor);
        $('#coordenador-dados').text(coordenador);
        $('#lider1-dados').text(lider1);
        $('#lider2-dados').text(lider2);
        $('#obs-dados').text(obs);


        var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {});
        myModal.show();
        $('#mensagem').text('');
    }


    function obs(id, nome, obs) {

        for (let letra of obs) {
            if (letra === '+') {
                obs = obs.replace(' +  + ', '\n');
            }
        }

        $('#nome-obs').text(nome);
        $('#id-obs').val(id);
        $('#obs').val(obs);

        var myModal = new bootstrap.Modal(document.getElementById('modalObs'), {});
        myModal.show();
        $('#mensagem-obs').text('');
    }


    function limpar() {

        $('#id').val('');
        $('#titulo').val('');
        $('#descricao').val('');
        $('#data').val('');
        $('#hora').val('');

        document.getElementById("pastor").options.selectedIndex = 0;
        $('#pastor').val($('#pastor').val()).change();

        document.getElementById("coordenador").options.selectedIndex = 0;
        $('#coordenador').val($('#coordenador').val()).change();

        document.getElementById("lider1").options.selectedIndex = 0;
        $('#lider1').val($('#lider1').val()).change();

        document.getElementById("lider2").options.selectedIndex = 0;
        $('#lider2').val($('#lider2').val()).change();
    }


    $(document).ready(function() {
        $('.sel2').select2({
            placeholder: 'Selecione um Registro',
            dropdownParent: $('#modalForm'),
        });
    });
    
    $(document).ready(function() {
        $('.sel21').select2({
            placeholder: 'Selecione um Pastor',
            dropdownParent: $('#modalForm'),
        });
    });


</script>