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
require_once '../Model/Pessoa.php';

class PessoaDAO {

    public function insert($object) {
        try {
            $c = connect();            
            $pgrad = $object->getPGRAD();
            $nomeGuerra = $object->getNOME_GUERRA();
            $dataNascimento = $object->getDT_NASCIMENTO();
            $sql = "INSERT INTO Pessoa("
                    . "PGRAD, NOME_GUERRA, DT_NASCIMENTO "
                    . ") "
                    . "VALUES(?, ?, ?);";
            $stmt = $c->prepare($sql);
            if ($stmt) {
                $stmt->bind_param(
                        "sss",
                        $pgrad,
                        $nomeGuerra,
                        $dataNascimento
                );
                $sqlOk = $stmt->execute();
            } else {
                $sqlOk = false;
            }
            $c->close();
            return $sqlOk;
        } catch (Exception $e) {
            throw($e);
        }
        return true;
    }

    public function deleteAll() {
        try {
            $c = connect();
            $sql = "DELETE FROM Pessoa";
            $stmt = $c->prepare($sql);
            $sqlOk = $stmt ? $stmt->execute() : false;
            $c->close();
            return $sqlOk;
        } catch (Exception $e) {
            throw($e);
        }
    }

    public function getAllList() {
        try {
            $c = connect();            
            $sql = "SELECT * FROM Pessoa";
            $stmt = $c->prepare($sql);
            if ($stmt) {
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $objectArray = $this->fillArray($row);
                    $lista[] = new Pessoa($objectArray);
                }
            }
            $c->close();
            return isset($lista) ? $lista : null;
        } catch (Exception $e) {
            throw($e);
        }
    }

    public function getByMesList($mes) {
        try {
            $c = connect();            
            $sql = "SELECT *, DATE_FORMAT(DT_NASCIMENTO, '%m-%d') AS Day "
                    . " FROM Pessoa "
                    . " WHERE DT_NASCIMENTO LIKE ? "
                    . " ORDER BY Day";
            $stmt = $c->prepare($sql);
            if ($stmt) {
                $likeMes = '%-' . $mes . '-%';
                $stmt->bind_param("s", $likeMes);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $objectArray = $this->fillArray($row);
                    $lista[] = new Pessoa($objectArray);
                }
            }
            $c->close();
            return isset($lista) ? $lista : null;
        } catch (Exception $e) {
            throw($e);
        }
    }

    public function fillArray($row) {
        return array(
            "id" => $row["idPessoa"],
            "PGRAD" => $row["PGRAD"],
            "NOME_GUERRA" => $row["NOME_GUERRA"],
            "DT_NASCIMENTO" => $row["DT_NASCIMENTO"],
        );
    }
}
