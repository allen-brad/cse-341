<?php
/* 
 * Member model
 */

function getMemberDirectory(){
  $db = dbConnection();
  $sql = "SELECT m.memberid , m.preferredname || ' ' || m.lastname AS fullname, m.callsign, m.saremail, p.phonenumber
          FROM Member m
          LEFT JOIN MemberPhone p ON m.memberid = p.memberid AND p.isprimary = true
          ORDER BY m.lastname, m.firstname DESC";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $memberData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $memberData; 
}

 function getMemberDetail($memberID){
    $db = dbConnection();
    $sql = "SELECT m.memberid , m.firstname, m.middlename, m.lastname, m.preferredname, m.callsign, m.dob,
                   m.saremail, m.personalemail, m.dlnumber, m.dlstate, m.ssnlastfour, s.memberstatustype, e.contactfullname, e.contactcellphone, e.contacthomephone
            FROM Member m
            JOIN MemberStatus s ON m.memberstatusid = s.memberstatusid
            JOIN MemberEmergencyContact e ON m.memberid = e.memberid AND m.memberid = :memberID";
            
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
    $stmt->execute();
    $memberDetailData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $memberDetailData;
  }

  function getMemberPhone($memberID){
    $db = dbConnection();
    $sql = "SELECT t.phonetype, p.memberphoneid, p.phonenumber, p.isprimary, p.phonetypeid
            FROM MemberPhone p
            JOIN Member m ON p.memberid = m.memberid
            JOIN PhoneType t ON p.phonetypeid = t.phonetypeid
            WHERE m.memberid = :memberID
            ORDER BY p.isprimary DESC;";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
    $stmt->execute();
    $memberPhoneData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $memberPhoneData; 
  }

  function getMemberAddress($memberID){
    $db = dbConnection();
    $sql = "SELECT a.memberaddressid, a.street1, a.street2, a.street3, a.city, a.state, a.zip
            FROM MemberAddress a 
            JOIN Member m ON a.memberid = m.memberid
            WHERE m.memberid = :memberID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
    $stmt->execute();
    $memberAddressData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $memberAddressData; 
  }

  function getMemberStatusData(){
    $db = dbConnection();
    $sql = "SELECT s.memberstatusid, s.memberstatustype
            FROM MemberStatus s";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $memberStatusData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $memberStatusData; 
  }


  function getEmergencyContact($memberID){
    $db = dbConnection();
    $sql = "SELECT c.memberEmergencyContactID, c.contactFullName, c. contactCellPhone, c.contactHomePhone
            FROM MemberEmergencyContact c
            WHERE c.memberid = :memberID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
    $stmt->execute();
    $eContactData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $eContactData; 
  }

  function updateMemberDetail($memberID,$firstName,$preferredName,$middleName,$lastName,$callSign,$dob,$ssnLastFour,$dlNumber,$dlState,$memberStatus,$personalEmail){
    $db = dbConnection();
    $sql = 'UPDATE Member
            Set firstName = :firstName, preferredName = :preferredName, middleName = :middleName, lastName = :lastName, callSign = :callSign, dob = :dob,
                ssnLastFour = :ssnLastFour, dlNumber = :dlNumber, dlState = :dlState, memberStatusID = :memberStatus, personalEmail = :personalEmail
            WHERE memberid = :memberID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
    $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindValue(':preferredName', $preferredName, PDO::PARAM_STR);
    $stmt->bindValue(':middleName', $middleName, PDO::PARAM_STR);
    $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindValue(':callSign', $callSign, PDO::PARAM_STR);
    $stmt->bindValue(':dob', $dob, PDO::PARAM_STR);
    $stmt->bindValue(':ssnLastFour', $ssnLastFour, PDO::PARAM_INT);
    $stmt->bindValue(':dlNumber', $dlNumber, PDO::PARAM_STR);
    $stmt->bindValue(':dlState', $dlState, PDO::PARAM_STR);
    $stmt->bindValue(':memberStatus', $memberStatus, PDO::PARAM_INT);
    $stmt->bindValue(':personalEmail', $personalEmail, PDO::PARAM_STR);

    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
  }
  function updateMemberAddress($addressID, $address1, $address2, $address3,$city, $state, $zip){
    $db = dbConnection();
    $sql = 'UPDATE MemberAddress
            Set street1 = :address1, street2 = :address2, street3 = :address3, city = :city, state = :state, zip = :zip
            WHERE memberAddressID = :addressID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':addressID', $addressID, PDO::PARAM_INT);
    $stmt->bindValue(':address1', $address1, PDO::PARAM_STR);
    $stmt->bindValue(':address2', $address2, PDO::PARAM_STR);
    $stmt->bindValue(':address3', $address3, PDO::PARAM_STR);
    $stmt->bindValue(':city', $city, PDO::PARAM_STR);
    $stmt->bindValue(':state', $state, PDO::PARAM_STR);
    $stmt->bindValue(':zip', $zip, PDO::PARAM_STR);

    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
  }

  function addMember($firstName,$preferredName,$middleName,$lastName,$callSign,$dob,$ssnLastFour,$dlNumber,$dlState,$memberStatus,$sarEmail, $personalEmail){
    $db = dbConnection();

    $sql = 'INSERT INTO Member (lastName, firstName, middleName, preferredName, callSign, dob, sarEmail, personalEmail, dlNumber, dlState, ssnLastFour, memberStatusID)
            VALUES (:lastName, :firstName, :middleName, :preferredName, :callSign, :dob, :sarEmail, :personalEmail, :dlNumber, :dlState, :ssnLastFour, :memberStatusID)';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindValue(':middleName', $middleName, PDO::PARAM_STR);
    $stmt->bindValue(':preferredName', $preferredName, PDO::PARAM_STR);
    $stmt->bindValue(':callSign', $callSign, PDO::PARAM_STR);
    $stmt->bindValue(':dob', $dob, PDO::PARAM_STR);
    $stmt->bindValue(':sarEmail', $sarEmail, PDO::PARAM_STR);
    $stmt->bindValue(':personalEmail', $personalEmail, PDO::PARAM_STR);
    $stmt->bindValue(':dlNumber', $dlNumber, PDO::PARAM_STR);
    $stmt->bindValue(':dlState', $dlState, PDO::PARAM_STR);
    $stmt->bindValue(':ssnLastFour', $ssnLastFour, PDO::PARAM_INT);
    $stmt->bindValue(':memberStatusID', $memberStatus, PDO::PARAM_INT);

    $stmt->execute();

    //check to see if it worked
    $id = $db->lastInsertId();
    //close connection
    $stmt->closeCursor();

    if ($id){
      return $id;
    }

  }


  function addMemberAddress($memberID, $street1, $street2, $street3, $city, $state, $zip){
    $db = dbConnection();
  
    $sql = 'INSERT INTO MemberAddress (memberID, street1, street2, street3, city, state, zip, createdBy, lastUpdateBy)
            VALUES (:memberID, :street1, :street2, :street3, :city, :state, :zip, :createdBy, :lastUpdateBy)';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
    $stmt->bindValue(':street1', $street1, PDO::PARAM_STR);
    $stmt->bindValue(':street2', $street2, PDO::PARAM_STR);
    $stmt->bindValue(':street3', $street3, PDO::PARAM_STR);
    $stmt->bindValue(':city', $city, PDO::PARAM_STR);
    $stmt->bindValue(':state', $state, PDO::PARAM_STR);
    $stmt->bindValue(':zip', $zip, PDO::PARAM_STR);
    $stmt->bindValue(':createdBy', $memberID, PDO::PARAM_INT);
    $stmt->bindValue(':lastUpdateBy', $memberID, PDO::PARAM_INT); 

    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
  }

  function unSetPrimaryPhoneID($memberID){
    $db = dbConnection();
    $sql = 'UPDATE memberphone SET isPrimary = false WHERE memberid = :memberID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
  }

  function deleteMemberPhone($memberphoneID){
    $db = dbConnection();
    $sql = 'DELETE FROM memberphone WHERE memberphoneid = :memberphoneID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberphoneID', $memberphoneID, PDO::PARAM_INT);
    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
  }

  function deleteEmergencyContact($emergencyContactID){
    $db = dbConnection();
    $sql = 'DELETE FROM MemberEmergencyContact WHERE memberEmergencyContactID = :memberEmergencyContactID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberEmergencyContactID', $emergencyContactID, PDO::PARAM_INT);
    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
  }
  function deleteAddress($memberAddressID){
    $db = dbConnection();
    $sql = 'DELETE FROM MemberAddress WHERE memberAddressID = :memberAddressID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memberAddressID', $memberAddressID, PDO::PARAM_INT);
    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
  }

  //Insert emergency contact
function addEmergencyContact($memberID, $contactFullName, $contactCellPhone, $contactHomePhone){
  $db = dbConnection();
  $sql = 'INSERT INTO MemberEmergencyContact (memberID, contactFullName, contactCellPhone, contactHomePhone, createdBy, lastUpdateBy)
          VALUES (:memberID, :contactFullName, :contactCellPhone, :contactHomePhone, :createdBy, :lastUpdateBy)';
  
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
  $stmt->bindValue(':contactFullName', $contactFullName, PDO::PARAM_STR);
  $stmt->bindValue(':contactCellPhone', $contactCellPhone, PDO::PARAM_INT);
  $stmt->bindValue(':contactHomePhone', $contactHomePhone, PDO::PARAM_STR);
  $stmt->bindValue(':createdBy', $memberID, PDO::PARAM_INT);
  $stmt->bindValue(':lastUpdateBy', $memberID, PDO::PARAM_INT); 
  
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

//update member e contact
function updateEmergencyContact($memberEmergencyContactID, $contactFullName, $contactCellPhone, $contactHomePhone){
  $db = dbConnection();  
  $sql = 'UPDATE MemberEmergencyContact
          SET contactFullName = :contactFullName, contactCellPhone = :contactCellPhone, contactHomePhone = :contactHomePhone
          WHERE memberEmergencyContactID = :memberEmergencyContactID';
  
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':memberEmergencyContactID', $memberEmergencyContactID, PDO::PARAM_INT);
  $stmt->bindValue(':contactFullName', $contactFullName, PDO::PARAM_STR);
  $stmt->bindValue(':contactCellPhone', $contactCellPhone, PDO::PARAM_INT);
  $stmt->bindValue(':contactHomePhone', $contactHomePhone, PDO::PARAM_INT);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();

  $stmt->closeCursor();

  return $rowsChanged;
}


//Insert member phone
function addMemberPhone($memberID, $phoneTypeID, $phoneNumber, $isPrimary){

    //There can be only one Primary nuber. If new number is primary, turn off other primary number
    if ($isPrimary==1){
        //turn off primary for all of this member's phone numbers
        unSetPrimaryPhoneID($memberID);
    }else{
      //isPrimary has a not null constraint, so force it to be false.
      $isPrimary = 0;
    }

    //create connection object
    $db = dbConnection();
    //sql statement
    $sql = 'INSERT INTO MemberPhone (memberID, phoneTypeID, phoneNumber, isPrimary, createdBy, lastUpdateBy)
                           VALUES (:memberID, :phoneTypeID, :phoneNumber, :isPrimary, :createdBy, :lastUpdateBy)';
    
   //creates prepared statement
   $stmt = $db->prepare($sql);

   // swap out varialbes for actual values
    //tell database the type of data
    $stmt->bindValue(':memberID', $memberID, PDO::PARAM_INT);
    $stmt->bindValue(':phoneTypeID', $phoneTypeID, PDO::PARAM_INT);
    $stmt->bindValue(':phoneNumber', $phoneNumber, PDO::PARAM_INT);
    $stmt->bindValue(':isPrimary', $isPrimary, PDO::PARAM_BOOL);
    $stmt->bindValue(':createdBy', $memberID, PDO::PARAM_INT);
    $stmt->bindValue(':lastUpdateBy', $memberID, PDO::PARAM_INT); 
    //use the prepared statement to insert data
    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//update member phone
function updateMemberPhone($memberphoneID, $memberID, $phoneTypeID, $phoneNumber, $isPrimary){

  //There can be only one Primary number. If updated number is primary, turn off other primary number
  if ($isPrimary==1){
    //turn off primary for all of this member's phone numbers
    unSetPrimaryPhoneID($memberID);
  }else{
    //isPrimary has a not null constraint, so force it to be false.
    $isPrimary = 0;
  }

  $db = dbConnection();
  
  $sql = 'UPDATE memberphone
          SET phoneTypeID = :phoneTypeID, phoneNumber = :phoneNumber, isPrimary = :isPrimary, lastupdateby = :lastUpdateBy
          WHERE memberphoneID = :memberphoneID';
  
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':memberphoneID', $memberphoneID, PDO::PARAM_INT);
  $stmt->bindValue(':phoneTypeID', $phoneTypeID, PDO::PARAM_INT);
  $stmt->bindValue(':phoneNumber', $phoneNumber, PDO::PARAM_INT);
  $stmt->bindValue(':isPrimary', $isPrimary, PDO::PARAM_BOOL);
  $stmt->bindValue(':lastUpdateBy', $memberID, PDO::PARAM_INT); 

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();

  $stmt->closeCursor();

  return $rowsChanged;
}