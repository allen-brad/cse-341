<?php
/* 
 * created by Brad R. Allen
 */

function format_phone_us($phone) {
  // note: making sure we have something
  if(empty($phone)) { return ''; }
  // note: strip out everything but numbers 
  $phone = preg_replace("/[^0-9]/", "", $phone);
  $length = strlen($phone);
  switch($length) {
    case 7:
      return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
      break;
    case 10:
      return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
      break;
    case 11:
      return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3-$4", $phone);
      break;
    default:
      return $phone;
      break;
  }
}

function getUsStates() {
  $db = dbConnection();
  $sql = "SELECT s.stateid, s.state, s.abbreviation
          FROM usStates s;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $usStateData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $usStateData;
}

function getPhoneType() {
  $db = dbConnection();
  $sql = "SELECT t.phonetypeid, t.phonetype
          FROM PhoneType t;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $phoneTypeData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $phoneTypeData;
}

function validMemberStatus($memberStatusID) {
  $db = dbConnection();
  $sql = "SELECT memberStatusID
          FROM MemberStatus
          WHERE memberStatusID = :memberStatusID";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':memberStatusID', $memberStatusID, PDO::PARAM_INT);
  $stmt->execute();
  $status = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  if (!$status){
    return true;
  }
  return null;
}