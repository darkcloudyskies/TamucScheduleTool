<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/11/2018
 * Time: 7:28 PM
 */

require_once '../POPO/Department.php';
require_once '../DAO/DepartmentDAO.php';

$department = new Department();
$department->setDepartmentName("TestDepo41");
$department->setDepartmentId(10);
$department->setDepartmentCode("TestCode34");

$departmentDAO = new DepartmentDAO();
$departmentDAO->insertDepartment($department);
