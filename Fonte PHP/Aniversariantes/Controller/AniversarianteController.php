<?php

/* * *****************************************************************************
 * 
 * Copyright © 2025 Gustavo Henrique Mello Dauer - 1º Ten 
 * Chefe da Seção de Informática do 2º BE Cmb
 * Email: gustavodauer@gmail.com
 * 
 * Este arquivo é parte do programa SCC
 * 
 * SCC é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da Licença Pública Geral GNU como
 * publicada pela Free Software Foundation (FSF); na versão 3 da
 * Licença, ou qualquer versão posterior.

 * Este programa é distribuído na esperança de que possa ser útil,
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO
 * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.

 * Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
 * com este programa, Se não, veja <http://www.gnu.org/licenses/>.
 * 
 * ***************************************************************************** */

/**
 *
 * @author gustavodauer
 */
require_once '../include/comum.php';
require_once '../DAO/PessoaDAO.php';

class AniversarianteController {

    private $pessoaDAO;         // DAO instance for database operations      
    private $datasheet;         // Datasheet import from SiCaPEx

    /**
     * Responsible to receive all input form data
     */
    public function getFormData() {
        $this->datasheet = $_FILES["planilhaPessoas"];
    }

    /**
     * Generate list of everything on database calling the view
     */
    public function getAllList() {
        try {
            $this->pessoaDAO = new PessoaDAO();
            $objectList = $this->pessoaDAO->getAllList();
            require_once '../View/view_aniversariantes.php';
        } catch (Exception $e) {
            require_once '../View/view_error.php';
        }
    }

    /**
     * Generate list of everything on database calling the view
     */
    public function admin() {
        try {
            require_once '../View/view_admin.php';
        } catch (Exception $e) {
            require_once '../View/view_error.php';
        }
    }

    /**
     * Import SiCaPEx datasheet to database
     */
    function importDataSheet() {
        $this->getFormData();
        $result = "";
        $planilha = $this->datasheet;
        $pessoaDAO = new PessoaDAO();
        $row = 1;        
        if (($handle = fopen($planilha['tmp_name'], "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row <= 2) {
                    $row++;
                    continue;
                } else if ($row === 3) {
                    $ordCol = isset($data[0]) ? $data[0] : null;
                    $pgradCol = isset($data[1]) ? $data[1] : null;
                    $nomeGuerraCol = isset($data[2]) ? $data[2] : null;
                    $dataNascimentoCol = isset($data[3]) ? $data[3] : null;
                    if (
                            $ordCol === "ORD" &&
                            $pgradCol === "PGRAD" &&
                            $nomeGuerraCol === "NOME_GUERRA" &&
                            $dataNascimentoCol === "DT_NASCIMENTO"
                    ) {
                        $row++;                        
                        $pessoaDAO->deleteAll(); // Caso as colunas estejam corretas, deleta todos registros do banco para novos cadastros atualizados
                        continue;
                    } else {
                        $result .= "<span style='color: red;font-weight: bold;'>Erro ao importar os dados.</span>";
                        $result .= "<br><br><span style='color: red;'>A planilha deve estar no seguinte formato:<br><br>"
                                . "Colunas: ORD PGRAD NOME_GUERRA DT_NASCIMENTO";
                        break;
                    }
                }
                $num = count($data);
                $row++;
                $pessoa = new Pessoa();
                $pessoa->setPGRAD($data[1]);
                $pessoa->setNOME_GUERRA($data[2]);
                $dataNascimento = explode("/", $data[3]);
                $dataNascimentoFormatted = $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0];
                $pessoa->setDT_NASCIMENTO($dataNascimentoFormatted);
                if ($pessoa->getPGRAD() != "Sd Rcr") {
                    $result .= $pessoaDAO->insert($pessoa) ? $pessoa->getPGRAD() . " " . $pessoa->getNOME_GUERRA() . " " . "<span style='color: darkgreen; font-weight: bold;'>Cadastro efetuado com sucesso!</span><br>" : "<span style='color: red; font-weight: bold;'>Erro ao efetuar o cadastro!</span><br>";
                }
            }
            $result .= "<br>";
        }
        fclose($handle);        
        require_once '../View/view_admin.php';
    }
}

// POSSIBLE ACTIONS
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$controller = new AniversarianteController();
switch ($action) {
    case "admin":
        $controller->admin(); // Implementar restrição de segurança: Exemplo: !isAdminLevel($ADMIN_ANIVERSARIANTE) ? redirectToLogin() : $controller->admin();
        break;
    case "import":
        $controller->importDataSheet(); // Implementar restrição de segurança: Exemplo: !isAdminLevel($ADMIN_ANIVERSARIANTE) ? redirectToLogin() : $controller->importDataSheet();
        break;
    default:
        $controller->getAllList();
        break;
}
?>