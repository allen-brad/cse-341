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
            $message = "<div class=\"alert alert-warning\" role=\"alert\">Member ID $memberID was not found!</div>";
          } else {
            $memberPhoneNumbers = getMemberPhone($memberID);
            $memberAddresses = getMemberAddress($memberID);
        }

        include $_SERVER['DOCUMENT_ROOT'].'/view/member-detail.php';

    break;

    case 'edit':
        $memberID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $message = "<div class=\"alert alert-warning\" role=\"alert\">Editing of Member ID $memberID not allowed at this time!</div>";

        include $_SERVER['DOCUMENT_ROOT'].'/view/member-edit.php';
        
    break;

    case 'delete':
        $memberID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $message = "<div class=\"alert alert-warning\" role=\"alert\">Deleting of Member ID $memberID not allowed at this time!</div>";

        include $_SERVER['DOCUMENT_ROOT'].'/view/member-delete.php';
        
    break;

    default:
        // future check if logged in and role
        $memberDirectory = getMemberDirectory();
   
        include $_SERVER['DOCUMENT_ROOT'].'/view/members.php';
}