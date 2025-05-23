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

function dateFormat($date) {
    return date_format(new DateTime($date), "d/m");
}

function equalizeYear($date) {
    $dateExploded = explode("-", $date);    
    return count($dateExploded) === 3 ? date('Y') . "-$dateExploded[1]-$dateExploded[2]" : $date;    
}

function connect() {
    $dbConfig = parse_ini_file('/var/www/aniversariantes.ini');
    $servername = $dbConfig['servername'];
    $username = $dbConfig['username'];
    $password = $dbConfig['password'];
    $database = $dbConfig['dbname'];
    try {
        $conexao = new mysqli($servername, $username, $password, $database);
        if ($conexao->connect_errno) {
            throw new Exception('Erro na conexão ao banco de dados! O sistema pode estar em manutenção para realização de correções ou backup dos dados.');
        } else {
            $conexao->set_charset("utf8");
        }
        return $conexao;
    } catch (Exception $e) {
        require_once 'view_error.php';
    }
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}