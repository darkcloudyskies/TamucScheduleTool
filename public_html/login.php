<?php

require_once "../resources/library/DAO/StudentDAO.php";
require_once "../resources/library/POPO/Student.php";

session_start();

if (!empty($_GET))
{
    if($_GET["type"] == "Login") {
        $username = $_GET["username"];
        $password = $_GET["password"];

        $studentDAO = new StudentDAO();

        $student = $studentDAO->getStudentFromUsername($username);

        if ($student->getPassword() == $password) {
            $_SESSION['user_id'] = $student->getUsername();
            header("Location: account.php");
            exit();
        }
        else
        {

        }
    }

}

include_once ("common/header.php");
?>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                </label>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" name="type" type="submit" value="Login">
                        </fieldset>
                    </form>
                    <hr/>
                    <center><h4>OR</h4></center>
                    <input class="btn btn-lg btn-register btn-block" type="submit" value="Register">
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>