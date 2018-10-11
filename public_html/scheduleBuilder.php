<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 10/7/2018
 * Time: 6:59 PM
 */

include_once ("common/loginCheck.php");

include_once ("common/header.php");
?>

<main role="main" class="container mt-2 ">
    <form>
        <h2>General</h2>
        <div class="card mt-2">
            <div class="card-header ">
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2">Minimum Total Hours</div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-number-input" type="number" id="gridCheck1">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Maximum Total Hours</div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-number-input" type="number" id="gridCheck1">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Maximum Online Hours</div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-number-input" type="number" id="gridCheck1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>Time Filters</h2>
        <div class="card mt-2">
            <div class="card-header ">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Monday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tuesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Wednesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Thursday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Friday</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2">Enabled / Present</div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0">Filter Type</legend>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                   value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Whitelist
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                   value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                 Blacklist
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="example-time-input" class="col-2 col-form-label">Start Time</label>
                        <div class="col-2">
                            <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                        </div>
                    </div>
                    <div class="row">
                        <label for="example-time-input" class="col-2 col-form-label">End Time</label>
                        <div class="col-2">
                            <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <button class="btn btn-primary" type="submit">Add New Time</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" type="submit">Remove Previous Time</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>Sorting Preferences</h2>
        <div class="card mt-2">
            <div class="card-header ">
            </div>
            <div class="card-body">

            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-primary mt-5 mb-5" type="submit">Build Schedule</button>
                </div>
            </div>
        </div>
    </form>
</main>
</body>
</html>