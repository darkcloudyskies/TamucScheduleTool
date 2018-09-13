<?php
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
                                <input class="form-control" placeholder="Username" name="email" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Repeat Password" name="passwordRepeat" type="password" value="">
                            </div>
                            <input class="btn btn-lg btn-register btn-block" type="submit" value="Register">

                        </fieldset>
                    </form>
                    <hr/>
                    <center><h4>OR</h4></center>
                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>