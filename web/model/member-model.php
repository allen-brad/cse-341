<?php
/* 
 * Member model
 */

function getMemberDirectory(){
  $db = dbConnection();
  $sql = "SELECT m.memberid , m.preferredname || ' ' || m.lastname AS fullname, m.callsign, m.saremail, p.phonenumber
          FROM Member m JOIN MemberPhone p ON m.memberid = p.memberid
          WHERE p.isprimary = true
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
            JOIN MemberEmergencyContact e ON m.memberid = e.memberid
            WHERE m.memberid = :memberID";
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



  // Update member info
function updateMemberDetails($lastName, $firstName, $middleName, $preferredName, $callSign, $dob, $personalEmail, $dlNumber, $dlState, $ssnLastFour, $memberStatusID){
  //create connection object
$db = acmeConnect();
//sql statement
$sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
//creates prepared statement
$stmt = $db->prepare($sql);
// swap out varialbes for actual values
//tell database the type of data
$stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
$stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
$stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

//use the prepared statement to insert data
$stmt->execute();
//check to see if it worked
$rowsChanged = $stmt->rowCount();
//close connection
$stmt->closeCursor();
// Return the indication of success (rows changed)
return $rowsChanged;
}




/* //check for existing client first
function checkExistingEmail($clientEmail){
  $db = acmeConnect();
  $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();
  if(empty($matchEmail)){
    return 0;
  } else {
    return 1;
  }
}
    
//Insert site visitor data to database
function regClient($clientFirstName, $clientLastName, $clientEmail,
        $clientPassword){
    //create connection object
    $db = acmeConnect();
    //sql statement
    $sql = 'INSERT INTO clients (clientFirstName, clientLastName, clientEmail,
            clientPassword) VALUES (:firstname, :lastname, :email, :password)';
    
   //creates prepared statement
    $stmt = $db->prepare($sql);
    // swap out varialbes for actual values
    //tell database the type of data
    $stmt->bindValue(':firstname', $clientFirstName, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $clientLastName, PDO::PARAM_STR);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':password', $clientPassword, PDO::PARAM_STR);
    
    //use the prepared statement to insert data
    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
// Update account info
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId){
      //create connection object
    $db = acmeConnect();
    //sql statement
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
   //creates prepared statement
    $stmt = $db->prepare($sql);
    // swap out varialbes for actual values
    //tell database the type of data
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    //use the prepared statement to insert data
    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
// Update account password
function updateClientPassword($clientId, $hashedPassword){
      //create connection object
    $db = acmeConnect();
    //sql statement
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
   //creates prepared statement
    $stmt = $db->prepare($sql);
    // swap out varialbes for actual values
    //tell database the type of data
    $stmt->bindValue(':clientPassword', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    //use the prepared statement to insert data
    $stmt->execute();
    //check to see if it worked
    $rowsChanged = $stmt->rowCount();
    //close connection
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get client data based on an email address
function getClient($clientEmail){
  $db = acmeConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}
// Get client data based on an email address
function getClientById($clientId){
  $db = acmeConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

function getPasswordById($clientId){
  $db = acmeConnect();
  $sql = 'SELECT clientPassword FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $currentPassword = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $currentPassword['clientPassword'];
}
// Get an UL of client name and email
function getClientList(){
  $clientList = '<ul id="clientDataList">';
  foreach ($_SESSION['clientData'] as $key => $value) {
    if ($key == 'clientFirstname') {
        $clientList .= "<li>First Name: " . $value . "</li>";
      } elseif ($key == 'clientLastname'){
        $clientList .= "<li>Last Name: " . $value . "</li>";
      }elseif ($key == 'clientEmail'){
        $clientList .= "<li>Email: " . $value . "</li>";
      }
    }
  $clientList .= '</ul>';
  return $clientList; 
}*/