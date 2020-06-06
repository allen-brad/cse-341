<?php
//Member Controller

// Create or access a Session
session_start();

//error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



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
    case 'memberDetails':
        $memberID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $memberDetail = getMemberDetail($memberID);

        if(empty($memberDetail)){
            $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                  <strong>Member ID $memberID</strong> was not found.
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                    </button>
                    </div>";
            //put message in session variable
            $_SESSION["message"] =  $message;
            //redirect
            header("Location: " .$_SERVER['PHP_SELF']);
            exit();
        }

        $memberPhoneNumbers = getMemberPhone($memberID);
        $memberAddresses = getMemberAddress($memberID);
        include $_SERVER['DOCUMENT_ROOT'].'/view/member-detail.php';
        
    break;

    case 'editMember':
        $memberID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $memberDetail = getMemberDetail($memberID);

        if(empty($memberDetail)){
            $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                        <strong>Editing Not Allowed!</strong> Member ID $memberID can not be found!
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                        </button>
                        </div>";
            //put message in session variable
            $_SESSION["message"] =  $message;
             //redirect
            header("Location: " .$_SERVER['PHP_SELF']);
            exit();
        }

        $memberPhoneNumbers = getMemberPhone($memberID);
        $memberAddresses = getMemberAddress($memberID);
        $memberEmegencyContacts = getEmergencyContact($memberID);
        include $_SERVER['DOCUMENT_ROOT'].'/view/member-edit.php';
            
    break;

    case 'updateMember':
        $memberID = filter_input(INPUT_POST, 'memberID', FILTER_SANITIZE_NUMBER_INT);	
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $preferredName = filter_input(INPUT_POST, 'preferredName', FILTER_SANITIZE_STRING);
        $middleName = filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $callSign = filter_input(INPUT_POST, 'callSign', FILTER_SANITIZE_STRING);
        $tempDOB = strtotime($_POST['dob']);
        if ($tempDOB) {
            $dob = date('Y-m-d', $tempDOB);
        }
        $ssnLastFour = filter_input(INPUT_POST, 'ssnLastFour', FILTER_SANITIZE_NUMBER_INT);
        $dlNumber = filter_input(INPUT_POST, 'dlNumber', FILTER_SANITIZE_STRING);
        $dlState = filter_input(INPUT_POST, 'dlState', FILTER_SANITIZE_STRING);
        $memberStatus = filter_input(INPUT_POST, 'memberStatus', FILTER_SANITIZE_NUMBER_INT);
        if (!validMemberStatus($memberStatus)){
            $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                        <strong>Invalid Member Status!</strong> Result: Member Status Type $memberStatus can not be found!
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                        </button>
                        </div>";
            //put message in session variable
            $_SESSION["message"] =  $message;
             //redirect
             header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
             exit();
        }
        $personalEmail = filter_input(INPUT_POST, "personalEmail", FILTER_VALIDATE_EMAIL);

        $outcome = updateMemberDetail($memberID,$firstName,$preferredName,$middleName,$lastName,$callSign,$dob,$ssnLastFour,$dlNumber,$dlState,$memberStatus,$personalEmail);
        // Check and report the result
        if($outcome === 1){
            $message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                            <strong>Success!</strong> Member personal information updated.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
            exit();

        }
        
        $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>Something Went Wrong!</strong> Member personal information not updated!
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>";

        //put message in session variable
        $_SESSION["message"] =  $message;

        //redirect
        header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
        exit();
    
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
                            <strong>Success!</strong> Phone number: ". format_phone_us($phoneNew)." added.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
            exit();

        }

        $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>Something Went Wrong!</strong> Phone number was not added!
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>";

        //put message in session variable
        $_SESSION["message"] =  $message;

        //redirect
        header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
        exit();
        
    break;
    
    case 'updateEmergencyContact':
        $memberID = filter_input(INPUT_POST, 'memberID', FILTER_SANITIZE_NUMBER_INT);
        $emergencyContactID = filter_input(INPUT_POST, 'eContactID', FILTER_SANITIZE_NUMBER_INT);
        $eContactCellPhone = preg_replace("/[^0-9]/","",(filter_input(INPUT_POST, 'eContactCellPhone', FILTER_SANITIZE_NUMBER_INT)));
        $eContactHomePhone = preg_replace("/[^0-9]/","",(filter_input(INPUT_POST, 'eContactHomePhone', FILTER_SANITIZE_NUMBER_INT)));
        $eContactFullName = filter_input(INPUT_POST, 'eContactFullName', FILTER_SANITIZE_STRING);

        

        $outcome = updateEmergencyContact($emergencyContactID,$eContactFullName, $eContactCellPhone, $eContactHomePhone);
        // Check and report the result
        if($outcome === 1){
            $message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                            <strong>Success!</strong> Emergency Contact: $emergencyContactID updated. Cell: $eContactCellPhone Home: $eContactHomePhone;
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
            exit();

        }

        $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>Something Went Wrong!</strong> Emergency Contact was not added!
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>";

        //put message in session variable
        $_SESSION["message"] =  $message;

        //redirect
        header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
        exit();

    break;

    case 'updateAddress':
        $memberID = filter_input(INPUT_POST, 'memberID', FILTER_SANITIZE_NUMBER_INT);
        $addressID = filter_input(INPUT_POST, 'addressID', FILTER_SANITIZE_NUMBER_INT);
        $address1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
        $address2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
        $address3 = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $zip = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);

        $outcome = updateMemberAddress($addressID, $address1, $address2, $address3,$city, $state, $zip);
        // Check and report the result
        if($outcome === 1){
            $message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                            <strong>Success!</strong> Address $addressID: updated.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                            </div>";

            //put message in session variable
            $_SESSION["message"] =  $message;

            //redirect
            header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
            exit();

        }

        $message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>Something Went Wrong!</strong> Address $addressID: not updated.
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>";

        //put message in session variable
        $_SESSION["message"] =  $message;

        //redirect
        header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
        exit();

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
            header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
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
            header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
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
            header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
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
            header("Location: " .$_SERVER['PHP_SELF']."?action=editMember&id=$memberID");
            exit();
        }
        
    break;

    case 'deleteMember':
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