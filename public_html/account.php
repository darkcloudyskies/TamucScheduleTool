<?php
include_once ("common/header.php");
?>


<main role="main" class="container mt-2 ">
    <div class="card mt-2">
        <div class="card-header ">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Majors</label>
                <input class="form-control mr-sm-2" type="text" placeholder="Enter A Major Here" aria-label="Add">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add</button>
            </form>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Computer Science
                    <button type="button" class="btn btn-outline-danger float-right">Remove</button>
                </li>
                <li class="list-group-item">
                    Math
                    <button type="button" class="btn btn-outline-danger float-right">Remove</button>
                </li>
            </ul>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Minors</label>
                <input class="form-control mr-sm-2" type="text" placeholder="Enter A Minor Here" aria-label="Add">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add</button>
            </form>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Physics
                    <button type="button" class="btn btn-outline-danger float-right">Remove</button>
                </li>
                <li class="list-group-item">
                    Art
                    <button type="button" class="btn btn-outline-danger float-right">Remove</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <form class="form-inline my-2 my-lg-0">
                <label class="mr-4">Courses Taken</label>
                <input class="form-control mr-sm-2" type="text" placeholder="Enter A Course Here" aria-label="Add">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add</button>
            </form>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    CSCI - 111 - Potato Salad
                    <button type="button" class="btn btn-outline-danger float-right">Remove</button>
                </li>
                <li class="list-group-item">
                    MATH - 999 - Extreme Mathematics
                    <button type="button" class="btn btn-outline-danger float-right">Remove</button>
                </li>
                <li class="list-group-item">
                    BGS - 222 - ?
                    <button type="button" class="btn btn-outline-danger float-right">Remove</button>
                </li>
            </ul>
        </div>
    </div>

</main>
</body>

</html>