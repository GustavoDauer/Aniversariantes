<?php
require_once '../include/comum.php';
require_once '../Model/Pessoa.php';
require_once '../DAO/PessoaDAO.php';
?>
<link rel="stylesheet" href="../include/css/estilos.css">
<div align="center" class="titulo"><h2>Aniversariantes do mês de <?= mesPorExtenso($mes); ?></h2></div>            
<div class="subtitulo"><?= is_array($pessoaList) ? count($pessoaList) : "0" ?> aniversariantes</div>
<?php if (is_array($pessoaList)) { ?> 
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="botao"><a href="../Controller/AniversarianteController.php?mes=<?= $mesAnterior ?>" class="botaoLink"><</a></td>
            <td>
                <div align="center">
                    <ul class="painel">
                        <?php
                        foreach ($pessoaList as $pessoa):
                            $dateDif = date_diff($hoje, new DateTime(equalizeYear($pessoa->getDT_NASCIMENTO())));
                            if ($dateDif->format('%a') == 0) {
                                $bolo = "bolo_aniversario";
                                $color = "black;";
                            } else if ($dateDif->format('%R') == "+" && $dateDif->format('%a') == 1) {
                                $bolo = "bolo_aceso";
                                $color = "black;";
                            } else if ($dateDif->format('%R') == "-") {
                                $bolo = "bolo_apagado";
                                $color = "gray;";
                            } else {
                                $bolo = "bolo";
                                $color = "black;";
                            }
                            ?>
                            <li class="linhaPainel" style="color: <?= $color ?>;">
                                <img src="../include/imagens/<?= $bolo ?>.png" width="50" vspace="7"><br>
                                <?= $pessoa->getPGRAD() ?><br>
                                <b><?= strtoupper($pessoa->getNOME_GUERRA()) ?></b><br>
                                <?= dateFormat($pessoa->getDT_NASCIMENTO()) ?><br>  
                            </li>
                        <?php endforeach; ?>    
                    </ul>
                </div>
            </td>
            <td class="botao"><a href="../Controller/AniversarianteController.php?mes=<?= $mesPosterior ?>" class="botaoLink">></a></td>
        </tr>
    </table>
<?php } ?>