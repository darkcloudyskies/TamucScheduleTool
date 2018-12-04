<?php
error_reporting(0);
require_once "../resources/library/DAO/StudentDAO.php";
require_once "../resources/library/POPO/Student.php";

if (!empty($_GET))
{
    if($_GET["type"] == "Register") {
        $name = $_GET["name"];
        $username = $_GET["username"];
        $password = $_GET["password"];
        $password2 = $_GET["password2"];

        $student = new Student();
        $studentDAO = new StudentDAO();

        $student->setUsername($username);
        $student->setPassword($password);
        $student->setStudentName($name);

        if ($studentDAO->insertStudent($student)) {
            header("Location: login.php");
            exit();
        }
    }
    else if($_GET["type"]=='"login"')
    {
        header("Location: login.php");
        exit();
    }
}

include_once ("common/header.php");

?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Register</h3>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Repeat Password" name="password2" type="password" value="">
                            </div>
                            <input class="btn btn-lg btn-register btn-block" name="type" type="submit" value="Register">
                            <hr/>
                            <center><h4>OR</h4></center>
                            <input class="btn btn-lg btn-success btn-block" type="button" value="Login" onclick="window.location.href='login.php'">
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>