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
        $memberDetail = getMemberDetail($memberID);

        if(empty($memberDetail)){
            $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                        <strong>Editing Not Allowed!</strong> Member ID $memberID can not be edited at this time!
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                        </button>
                        </div>";
            } else {
            $memberPhoneNumbers = getMemberPhone($memberID);
            $memberAddresses = getMemberAddress($memberID);
        }

        include $_SERVER['DOCUMENT_ROOT'].'/view/member-edit.php';
        
    break;

    case 'addPhone':
        $memberID = filter_input(INPUT_POST, 'memberID', FILTER_SANITIZE_NUMBER_INT);
        $phoneTypeID = filter_input(INPUT_POST, 'phoneTypeID', FILTER_SANITIZE_NUMBER_INT);
        $phoneNew = preg_replace("/[^0-9]/","",(filter_input(INPUT_POST, 'phoneNew', FILTER_SANITIZE_STRING)));
        $isPrimary = filter_input(INPUT_POST, 'isPrimary', FILTER_SANITIZE_NUMBER_INT);

        $outcome = addMemberPhone($memberID, $phoneTypeID, $phoneNew, $isPrimary);
        // Check and report the result
        if($outcome === 1){
            $message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                            <strong>Success!</strong> Phone number: ". format_phone_us($phone)." added.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=edit&id=$memberID");
            exit();

        }else{
            $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
            <strong>Something Went Wrong!</strong> Phone number was not added!
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=edit&id=$memberID");
            exit();

        }
        
    break;

    case 'updatePhone':
        $memberID = filter_input(INPUT_POST, 'memberID', FILTER_SANITIZE_NUMBER_INT);
        $memberPhoneID = filter_input(INPUT_POST, 'phoneID', FILTER_SANITIZE_NUMBER_INT);
        $phoneTypeID = filter_input(INPUT_POST, 'phoneTypeID', FILTER_SANITIZE_NUMBER_INT);
        $phoneNew = preg_replace("/[^0-9]/","",(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING)));
        $isPrimary = filter_input(INPUT_POST, 'isPrimary', FILTER_SANITIZE_NUMBER_INT);

        $outcome = updateMemberPhone($memberPhoneID,$memberID, $phoneTypeID, $phoneNew, $isPrimary);
        // Check and report the result
        if($outcome === 1){
            $message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                            <strong>Success!</strong> Phone number: ". format_phone_us($phoneNew)." updated.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=edit&id=$memberID");
            exit();

        }else{
            $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
            <strong>Something Went Wrong!</strong> Phone number was not added!
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=edit&id=$memberID");
            exit();

        }
        
    break;

    case 'deletePhone':
        $memberID = filter_input(INPUT_GET, 'memberID', FILTER_SANITIZE_NUMBER_INT);
        $phoneID = filter_input(INPUT_GET, 'phoneID', FILTER_SANITIZE_NUMBER_INT);

        echo "<script type='text/javascript'>alert('In deletePhone $phoneID $memberID ');</script>";

        $outcome = deleteMemberPhone($phoneID);
        echo "<script type='text/javascript'>alert('deletePhone rows affected: $outcome ');</script>";
        // Check and report the result
        if($outcome === 1){
            $message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                            <strong>Success!</strong> Phone number deleted
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                            </div>";
            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=edit&id=$memberID");
            exit();

        }else{

            $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
            <strong>Something Went Wrong!</strong> Phone number was not deleted!
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=edit&id=$memberID");
            exit();
        }
        
    break;

    case 'delete':
        $memberID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                  <strong>Delete Not Allowed!</strong> Member ID $memberID can not be deleted at this time!
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                    </button>
                    </div>";

        //put message in session variable
        $_SESSION["message"] =  $message;

        //redirect
        header("Location: " .$_SERVER['PHP_SELF']);
        exit();
        
        //include $_SERVER['DOCUMENT_ROOT'].'/view/member-delete.php';
        
    break;

    default:
        // future check if logged in and role
        $memberDirectory = getMemberDirectory();
   
        include $_SERVER['DOCUMENT_ROOT'].'/view/members.php';
}