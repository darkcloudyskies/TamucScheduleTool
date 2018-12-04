<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 10/7/2018
 * Time: 6:59 PM
 */
error_reporting(0);
include_once ("common/loginCheck.php");

include_once ("common/header.php");
?>

<main role="main" class="container mt-2 ">
    <form action="preparedSchedule.php">
        <input type="hidden" name="sectionBlacklist[]" value="-1">
        <h2>General</h2>
        <div class="card mt-2">
            <div class="card-header ">
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2">Minimum Total Hours</div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-number-input" type="number" id="minimumTotalHours" name="minimumTotalHours" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Maximum Total Hours</div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-number-input" type="number" id="maximumTotalHours" name="maximumTotalHours" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Maximum Online Hours</div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-number-input" type="number" id="maximumOnlineHours" name="maximumOnlineHours" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>Time Filters</h2>
        <div class="card mt-2">
            <div class="card-header ">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="monday-tab" data-toggle="tab" href="#mondayTab" role="tab" aria-controls="monday-tab" aria-selected="true">Monday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tuesday-tab" data-toggle="tab" href="#tuesdayTab" role="tab" aria-controls="tuesday-tab" aria-selected="false">Tuesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="wednesday-tab" data-toggle="tab" href="#wednesdayTab" role="tab" aria-controls="wednesday-tab" aria-selected="false">Wednesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="thursday-tab" data-toggle="tab" href="#thursdayTab" role="tab" aria-controls="thursday-tab" aria-selected="false">Thursday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="friday-tab" data-toggle="tab" href="#fridayTab" role="tab" aria-controls="friday-tab" aria-selected="false">Friday</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="timeTabs">
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="monday-tab" id="mondayTab">
                        <div class="form-group" id="mondayTimeBlock0">
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">Start Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="00:00:00"  id="mondayStartTime0" name="mondayStartTime[0]">
                                </div>
                            </div>
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">End Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="23:59:59"  id="mondayEndTime0" name="mondayEndTime[0]">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <button class="btn btn-primary" id = "mondayAddTimeBtn" type="button">Add New Time</button>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="mondayRemoveTimeBtn" type="button">Remove Previous Time</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" role="tabpanel" aria-labelledby="tuesday-tab" id="tuesdayTab">
                        <div class="form-group" id="tuesdayTimeBlock0">
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">Start Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="00:00:00"  id="tuesdayStartTime0" name="tuesdayStartTime[0]">
                                </div>
                            </div>
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">End Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="23:59:59"  id="tuesdayEndTime0" name="tuesdayEndTime[0]">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <button class="btn btn-primary" id = "tuesdayAddTimeBtn" type="button">Add New Time</button>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="tuesdayRemoveTimeBtn" type="button">Remove Previous Time</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" role="tabpanel" aria-labelledby="wednesday-tab-tab" id="wednesdayTab">
                        <div class="form-group" id="wednesdayTimeBlock0">
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">Start Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="00:00:00"  id="wednesdayStartTime0" name="wednesdayStartTime[0]">
                                </div>
                            </div>
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">End Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="23:59:59"  id="wednesdayEndTime0" name="wednesdayEndTime[0]">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <button class="btn btn-primary" id = "wednesdayAddTimeBtn" type="button">Add New Time</button>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="wednesdayRemoveTimeBtn" type="button">Remove Previous Time</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" role="tabpanel" aria-labelledby="thursday-tab-tab" id="thursdayTab">
                        <div class="form-group" id="thursdayTimeBlock0">
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">Start Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="00:00:00"  id="thursdayStartTime0" name="thursdayStartTime[0]">
                                </div>
                            </div>
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">End Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="23:59:59"  id="thursdayEndTime0" name="thursdayEndTime[0]">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <button class="btn btn-primary" id = "thursdayAddTimeBtn" type="button">Add New Time</button>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="thursdayRemoveTimeBtn" type="button">Remove Previous Time</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" role="tabpanel" aria-labelledby="friday-tab-tab" id="fridayTab">
                        <div class="form-group" id="fridayTimeBlock0">
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">Start Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="00:00:00"  id="fridayStartTime0" name="fridayStartTime[0]">
                                </div>
                            </div>
                            <div class="row">
                                <label for="example-time-input" class="col-2 col-form-label">End Time</label>
                                <div class="col-2">
                                    <input class="form-control" type="time" value="23:59:59"  id="fridayEndTime0" name="fridayEndTime[0]">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <button class="btn btn-primary" id = "fridayAddTimeBtn" type="button">Add New Time</button>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="fridayRemoveTimeBtn" type="button">Remove Previous Time</button>
                                </div>
                            </div>
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortTime" value="early" required>
                                <label class="form-check-label">Early</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortTime" value="late">
                                <label class="form-check-label">Late</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-primary mt-5 mb-5" type="submit">Build Schedule</button>
                </div>
            </div>
        </div>
        <script src="js/scheduleBuilder.js"></script>
    </form>
</main>
</body>
</html>