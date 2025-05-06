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
class Pessoa {

    private $id,
            $NOME_GUERRA,
            $PGRAD,
            $DT_NASCIMENTO;

    function __construct($idOrRow = 0) {
        if (is_int($idOrRow)) {
            $this->id = $idOrRow;
        } else if (is_array($idOrRow)) {
            $this->id = $idOrRow["id"];
            $this->NOME_GUERRA = $idOrRow["NOME_GUERRA"];
            $this->PGRAD = $idOrRow["PGRAD"];
            $this->DT_NASCIMENTO = $idOrRow["DT_NASCIMENTO"];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNOME_GUERRA() {
        return $this->NOME_GUERRA;
    }

    public function getPGRAD() {
        return $this->PGRAD;
    }

    public function getDT_NASCIMENTO() {
        return $this->DT_NASCIMENTO;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNOME_GUERRA($NOME_GUERRA): void {
        $this->NOME_GUERRA = $NOME_GUERRA;
    }

    public function setPGRAD($PGRAD): void {
        $this->PGRAD = $PGRAD;
    }

    public function setDT_NASCIMENTO($DT_NASCIMENTO): void {
        $this->DT_NASCIMENTO = $DT_NASCIMENTO;
    }
}
