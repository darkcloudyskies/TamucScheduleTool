<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 8/5/2018
 * Time: 2:33 PM
 */

require_once "../DAO/DepartmentDAO.php";
require_once "../POPO/Department.php";

$departmentDAO = new DepartmentDAO();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        header('Content-Type: application/json');
        if(!empty($_GET["departmentId"]))
        {
            $departmentId=intval($_GET["departmentId"]);
            $department=$departmentDAO->getDepartmentFromId($departmentId);
            echo json_encode($department);
        }
        else if(!empty($_GET["departmentName"]))
        {
            $departmentName = $_GET["departmentName"];
            $department = $departmentDAO->getDepartmentFromName($departmentName);
            echo json_encode($department);
        }
        else if(!empty($_GET["departmentCode"]))
        {
            $departmentCode = $_GET["departmentCode"];
            $department = $departmentDAO->getDepartmentFromCode($departmentCode);
            echo json_encode($department);
        }
        else
        {
            $departments = $departmentDAO->getAllDepartments();
            echo json_encode($departments);
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}