<?php
//Member Controller

//error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create or access a Session
session_start();

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
$action = filter_input(INPUT_GET, 'action');
}

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'].'/library/connections.php';
// Get the member model
require_once $_SERVER['DOCUMENT_ROOT'].'/model/member-model.php';
// Get helper functions
require_once $_SERVER['DOCUMENT_ROOT'].'/library/functions.php';


switch ($action) {
    case 'details':
        $memberID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $memberDetail = getMemberDetail($memberID);

        if(empty($memberDetail)){
            $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                  <strong>Member ID $memberID</strong> was not found.
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                    </button>
                    </div>";
          } else {
            $memberPhoneNumbers = getMemberPhone($memberID);
            $memberAddresses = getMemberAddress($memberID);
        }

        include $_SERVER['DOCUMENT_ROOT'].'/view/member-detail.php';

    break;

    case 'edit':
        $memberID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                  <strong>Editing Not Allowed!</strong> Member ID $memberID can not be edited at this time!
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                    </button>
                    </div>";

        include $_SERVER['DOCUMENT_ROOT'].'/view/member-edit.php';
        
    break;

    case 'delete':
        $memberID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                  <strong>Delete Not Allowed!</strong> Member ID $memberID can not be deleted at this time!
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                    </button>
                    </div>";

        include $_SERVER['DOCUMENT_ROOT'].'/view/member-delete.php';
        
    break;

    default:
        // future check if logged in and role
        $memberDirectory = getMemberDirectory();
   
        include $_SERVER['DOCUMENT_ROOT'].'/view/members.php';
}