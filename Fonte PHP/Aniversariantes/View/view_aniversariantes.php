<?php
require_once '../include/comum.php';
require_once '../Model/Pessoa.php';
require_once '../DAO/PessoaDAO.php';

function format($mes) {
    if (intval($mes) < 10) {
        return "0" . intval($mes);
    }
    return intval($mes);
}

function anterior($mes) {
    if (intval($mes) == 1) {
        return 12;
    }
    return intval($mes) - 1;
}

function posterior($mes) {
    if (intval($mes) == 12) {
        return 1;
    }
    return intval($mes) + 1;
}

function mesPorExtenso($mes) {
    switch ($mes) {
        case 1: return "Janeiro";
            break;
        case 2: return "Fevereiro";
            break;
        case 3: return "Março";
            break;
        case 4: return "Abril";
            break;
        case 5: return "Maio";
            break;
        case 6: return "Junho";
            break;
        case 7: return "Julho";
            break;
        case 8: return "Agosto";
            break;
        case 9: return "Setembro";
            break;
        case 10: return "Outubro";
            break;
        case 11: return "Novembro";
            break;
        case 12: return "Dezembro";
            break;
        default: return "";
            break;
    }
}

$hoje = new DateTime();
$pessoaDAO = new PessoaDAO();
$mes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_ADD_SLASHES);
$mes = empty($mes) ? date('m') : format($mes);
$mesAnterior = anterior($mes);
$mesPosterior = posterior($mes);
$pessoaList = $pessoaDAO->getByMesList($mes);
$botao = "font-size: 52px; font-weight: bold; font-family: sans-serif; text-align: center;";
?>
<div align="center" style="font-family: sans-serif;"><h2>Aniversariantes do mês de <?= mesPorExtenso($mes); ?></h2></div>            
<div style="font-size: 16px; font-weight: bold; color: #cc0000; text-align: center;"><?= is_array($pessoaList) ? count($pessoaList) : "0" ?> aniversariantes</div>
<?php if (is_array($pessoaList)) { ?> 
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="<?= $botao ?>"><a href="view_aniversariantes.php?mes=<?= $mesAnterior ?>" style="text-decoration: none; color: darkgreen;"><</a></td>
            <td>
                <div align="center">
                    <ul style="display: flex; flex-wrap: wrap; list-style-type: none; margin: 0; padding: 14px; width: 800px;">
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
                            <li style="margin-right: 7px; text-align: center; color: <?= $color ?>; width: 125px; font-size: 12px;">
                                <img src="../include/imagens/<?= $bolo ?>.png" width="50" vspace="7"><br>
                                <?= $pessoa->getPGRAD() ?><br>
                                <b><?= strtoupper($pessoa->getNOME_GUERRA()) ?></b><br>
                                <?= dateFormat($pessoa->getDT_NASCIMENTO()) ?><br>  
                            </li>
                        <?php endforeach; ?>    
                    </ul>
                </div>
            </td>
            <td style="<?= $botao ?>"><a href="view_aniversariantes.php?mes=<?= $mesPosterior ?>" style="text-decoration: none; color: darkgreen;">></a></td>
        </tr>
    </table>
<?php } ?>