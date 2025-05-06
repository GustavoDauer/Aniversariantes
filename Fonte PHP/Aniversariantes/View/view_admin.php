<?php
require_once '../include/comum.php';
require_once '../Model/Pessoa.php';
require_once '../DAO/PessoaDAO.php';
?>
<?= !empty($result) ? $result : "" ?>
<table border="1" cellpadding="7" cellspacing="0" align="center">
    <tr>
        <th colspan="2">ORIENTAÇÕES</th>
    </tr>    
    <tr>
        <td valign="top" style="text-align: center;">
            A planilha deve estar no formato .CSV, exatamente conforme a imagem abaixo:<br>
            <img src="../include/imagens/exemplo.png">
        </td>
        <td valign="top" style="text-align: center;">
            Ao abrir o arquivo em um bloco de notas, ao invés de uma suíte office, ele apresenta a seguinte configuração:<br>
            <img src="../include/imagens/exemplo2.png" height="500">
        </td>
    </tr>
    <tr>
        <td colspan="2"> Selecionar arquivo extraído do SiCaPEx e salvo em .CSV<br><br>
            <form action="../Controller/AniversarianteController.php" method="post" id="importar" enctype="multipart/form-data">
                <input type="hidden" name="action" value="import">
                <input type="file" name="planilhaPessoas" accept=".csv" onchange="importar();">
            </form>  
        </td>
    </tr>
</table>                       
<script>
    function importar() {
        document.getElementById("importar").submit();
    }
</script>
