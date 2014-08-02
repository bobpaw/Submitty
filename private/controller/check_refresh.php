<?php

require_once("../private/model/homework_model_functions.php");

$cource = "REFRESH_CHECK_NO_COURSE";
if (isset($_POST["course"])) {
    $new_course = htmlspecialchars($_POST["course"]);
    if (!is_valid_course($new_course)) {
        $course = "REFRESH_CHECK_BAD_COURSE";
    } else {
        $course = $new_course;
    }
}

if (isset($_POST["assignment_id"]) && isset($_POST["assignment_version"]) && isset($_POST["submitting_version"]) && isset($_POST["assignment_graded"]) && isset($_POST["submitting_graded"])) {
    $assignment_id = htmlspecialchars($_POST["assignment_id"]);
    $assignment_version = htmlspecialchars($_POST["assignment_version"]);
    $submitting_version = htmlspecialchars($_POST["submitting_version"]);
    $assignment_graded = htmlspecialchars($_POST["assignment_graded"]);
    $submitting_graded = htmlspecialchars($_POST["submitting_graded"]);
    if (!$assignment_graded) {
        $results = get_assignment_results($_SESSION["id"], $assignment_id, $assignment_version);
        if ($results != NULL && $results != false) {
            echo "true";
            exit();
        }
    }
    echo $submitting_graded;
    if (!$submitting_graded)
    {
        $results = get_assignment_results($_SESSION["id"], $assignment_id, $submitting_version);
        if ($results != NULL && $results != false) {
            echo "true";
            exit();
        }
    }
}
echo "false";
