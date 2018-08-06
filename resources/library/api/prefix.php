<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/5/2018
 * Time: 2:50 PM
 */

require_once "../DAO/PrefixDAO.php";
require_once "../POPO/Prefix.php";

$prefixDAO = new PrefixDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["prefixId"]))
        {
            $prefixId=intval($_GET["prefixId"]);
            $prefix=$prefixDAO->getPrefixFromId($prefixId);
            echo json_encode($prefix);
        }
        else if(!empty($_GET["prefixName"]))
        {
            $prefixName = $_GET["prefixName"];
            $prefix = $prefixDAO->getPrefixFromName($prefixName);
            echo json_encode($prefix);
        }
        else
        {
            $prefixs = $prefixDAO->getAllPrefixes();
            echo json_encode($prefixs);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}