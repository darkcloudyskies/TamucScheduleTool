<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 9/16/2018
 * Time: 7:48 PM
 */
error_reporting(0);
require_once "../resources/library/DAO/PrefixDAO.php";
require_once "../resources/library/POPO/Prefix.php";

if (!empty($_GET))
{
    $departmentId = $_GET["id"];

    $prefixDAO = new PrefixDAO();
    $prefixes = $prefixDAO->getPrefixesFromDepartmentId($departmentId);
    ?>
    <div class="card-body">
            <?php
            foreach ($prefixes as $prefix)
            {
                    echo('<div class="card mt-2">');
                        echo('<div class="card-header">');
                                 echo("<a class='prefix' href='#' onclick='loadCourses(".$prefix->getPrefixId().")'>".$prefix->getPrefixName()."</a>");
                        echo('</div>');
                        echo('<div id="prefix_'.$prefix->getPrefixId().'">');
                        echo('</div>');
                    echo('</div>');
            }
            ?>
    </div>

    <?php


}