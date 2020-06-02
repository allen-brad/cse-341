<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="WCSAR Edit Member">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fafafa"><!-- this alters the google chrome toolbar color -->

  <title>WCSAR | Edit Member</title>

  <link rel="manifest" href="/site.webmanifest">
  <link rel="apple-touch-icon" href="/cropped-ba-192x192.png">

  <!-- Bootstrap core CSS -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/member.css">

  
</head>

<body>
<header>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/common/nav.php'; ?>
</header>
<div class="container">
    <main class="pb-3">
        <h1>Edit Member</h1>
        <?php echo "<h4>Member ID: $memberID</h4>";?>
        <hr />
        <?php
            if (isset($successMessage)) {
                echo $successMessage;
            }
            if (isset($message)) {
                 echo $message;
            }
        
            if (!empty($memberDetail)) {
                $firstName = $memberDetail['firstname'];
                $middleName = $memberDetail['middlename'];
                $lastName = $memberDetail['lastname'];
                $preferredName = $memberDetail['preferredname'];
                $callSign = $memberDetail['callsign'];
                $memberDOB = $memberDetail['dob'];
                $sarEmail = $memberDetail['saremail'];
                $personalEmail = $memberDetail['personalemail'];
                $dlNumber = $memberDetail['dlnumber'];
                $dlState = $memberDetail['dlstate'];
                $ssnLastFour = $memberDetail['ssnlastfour'];
                $memberStatus = $memberDetail['memberstatustype'];
                $eContactName = $memberDetail['contactfullname'];
            }        
        ?>
        <div class="col-md-12 order-md-1">
            <form action="/members/"  class="needs-validation" method="post" novalidate>
                <fieldset class="form-group">
                    <h4 class="mb-3">Personal Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $firstName; ?>" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="preferredName">Preferred name</label>
                            <input type="text" class="form-control" name="preferredName" id="preferredName" value="<?php echo $preferredName; ?>" required>
                            <div class="invalid-feedback">
                                Valid preferred name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="middleName">Middle name</label>
                            <input type="text" class="form-control" name="middleName" id="middleName" value="<?php echo $middleName; ?>" required>
                            <div class="invalid-feedback">
                                Valid middel name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $lastName; ?>" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="callSign">Call sign</label>
                            <input type="text" class="form-control" name="callSign" id="callSign" value="<?php echo $callSign; ?>" required>
                            <div class="invalid-feedback">
                                Valid Call Sign name is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dob">Date of birth</label>
                            <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $memberDOB; ?>" required>
                            <div class="invalid-feedback">
                                Valid DOB is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="ssnLastFour">SSN last four</label>
                            <input type="text" class="form-control" name="ssnLastFour" id="ssnLastFour" value="<?php echo $ssnLastFour; ?>" required>
                            <div class="invalid-feedback">
                                Valid SSN last four is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dlNumber">Drivers license #</label>
                            <input type="text" class="form-control" name="dlNumber" id="dlNumber" placeholder="" value="<?php echo $dlNumber; ?>" required>
                            <div class="invalid-feedback">
                                Valid drivers license number is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dlState">Drivers license state</label>
                            <select class="form-control" id="dlState" name="dlState" required>
                            <option value="">Choose...</option>
                                <?php $usStates = getUsStates();
                                    foreach ($usStates as $state){
                                        $selectedDlState =null;
                                        if ($state['abbreviation']==$dlState){
                                            $selectedDlState = 'selected="selected"';
                                        }
                                        echo '<option value="'.$state['abbreviation'].'" '.$selectedDlState.'>'.$state['state'].'</option>';
                                    }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Valid drivers license state is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="memberStatus">Member status</label>
                            <select class="form-control" id="memberStatus" name="memberStatus" required>
                            <option value="">Choose...</option>
                                <?php $memberStatusType = getMemberStatusData();
                                    foreach ($memberStatusType as $type){
                                        if ($type['memberstatustype']==$memberStatus){
                                            $selectedStatus = 'selected="selected"';
                                        }else{
                                            $selectedStatus =null;
                                        }
                                        echo '<option value="'.$type['memberstatusid'].'" '.$selectedStatus.'>'.$type['memberstatustype'].'</option>';
                                    }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Valid status is required.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="personalEmail">Personal email</label>
                            <input type="email" class="form-control" name="personalEmail" id="personalEmail" placeholder="" value="<?php echo $personalEmail; ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="updateMember">
                    <input type="hidden" name="memberID" value="$memberID">
                    <button class="btn btn-primary btn-lg float-left" type="submit">Update Member Details</button>
                    <a class="btn btn-secondary btn-lg float-right" href="/members">Back to List</a>
                </fieldset>
            </form>
            <fieldset class="form-group">
                <h4 class="mb-3">Phone Information</h4>
                <?php
                $phoneType = getPhoneType();
                $i=0;
                    foreach($memberPhoneNumbers as $phone){
                        $memberPhoneID = $phone['memberphoneid'];
                        $memberPhoneType = $phone['phonetype'];
                        $memberPhoneTypeID = $phone['phonetypeid'];
                        $memberPhoneNumber = $phone['phonenumber'];
                        $memberPhoneIsPrimary = $phone['isprimary'];
                        if ($memberPhoneIsPrimary == true){
                            $checked = 'checked';
                        }else{
                            $checked = null;
                        }
                        echo '<form action="/members/"  class="needs-validation mb-4" method="post" novalidate>
                                <div class="row">
                                <div class="col-md-4 mb-3">
                                <label for="phoneTypeID_'.$i.'">Phone type</label>
                                <select class="form-control" id="phoneTypeID_'.$i.'" name="phoneTypeID" required>
                                <option value="">Choose...</option>';
                        foreach ($phoneType as $type){
                            if ($type['phonetype'] == $memberPhoneType){
                                $selectedStatus = 'selected="selected"';
                            } else{
                                $selectedStatus =null;
                            }
                            echo '<option value="'.$type['phonetypeid'].'" '.$selectedStatus.'>'.$type['phonetype'].'</option>';
                        }

                        echo '  </select>
                                <div class="invalid-feedback">
                                    Valid phone type is required.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone'.$i.'">Phone</label>
                                <input type="tel" class="form-control" name="phone'.$i.'" id="phone'.$i.'" value="'.$memberPhoneNumber.'" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                                <div class="invalid-feedback">
                                    Please enter a valid phone number.
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="isPrimary'.$i.'" value="primary" '.$checked.'>
                                <label class="form-check-label" for="isPrimary'.$i.'">Primary</label>
                            </div>
                            <input type="hidden" name="action" value="updatePhone">
                            <input type="hidden" name="memberID" value="'.$memberID.'">
                            <input type="hidden" name="phoneID" value="'.$memberPhoneID.'">
                        </div>
                        <button class="btn btn-primary btn-sm mr-2" type="submit">Update Phone</button>
                        <a class="btn btn-outline-danger btn-sm" href="/members/?action=\'deletePhone\'&meberID=\''.$memberID.'\'&phoneID=\''.$memberPhoneID.'\'">Delete Phone</a>
                        </form>';
                        $i += 1;
                    }
                ?>
                    <form action="/members/"  class="needs-validation mb-4" method="post" novalidate>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="phoneTypeID">Phone type</label>
                            <select class="form-control" id="phoneTypeID" name="phoneTypeID" required>
                                <option value="">Choose...</option>
                                <?php
                                    foreach ($phoneType as $type){
                                        echo '<option value="'.$type['phonetypeid'].'">'.$type['phonetype'].'</option>';
                                    }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Valid phone type is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="phoneNew">Phone</label>
                            <input type="tel" class="form-control" name="phoneNew" id="phoneNew" placeholder="123-123-1234" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                            <div class="invalid-feedback">
                                Please enter a valid phone number.
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="isPrimary" name="isPrimary" value="1">
                            <label class="form-check-label" for="isPrimary">Primary</label>
                        </div>
                        <input type="hidden" name="action" value="addPhone">
                        <input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
                    </div>
                    <button class="btn btn-primary btn-sm mr-2" type="submit">Add Phone</button>
                    <a class="btn btn-secondary btn-lg float-right mr-2" href="/members">Back to List</a>
                    </form>
            </fieldset>
            <fieldset class="form-group">
                <h4 class="mb-3">Address Information</h4>
                <?php
                    $usStates = getUsStates();
                    $a=0;
                    foreach($memberAddresses as $address){
                        $memberAddressID = $address['memberaddressid'];
                        $memberStreet1 = $address['street1'];
                        $memberStreet2 = $address['street2'];
                        $memberStreet3 = $address['street3'];
                        $memberCity = $address['city'];
                        $memberState = $address['state'];
                        $memberZip = $address['zip'];
                        $memberPhoneIsPrimary = $phone['isprimary'];
                        echo '  <form action="/members/"  class="needs-validation mb-4" method="post" novalidate>
                                    <div class="mb-3">
                                        <label for="address1_'.$a.'">Address 1</label>
                                        <input type="text" class="form-control" name="address'.$a.'" id="address1'.$a.'" value="'.$memberStreet1.'" required>
                                        <div class="invalid-feedback">
                                            Please enter your street address.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address2_'.$a.'">Address 2 <span class="text-muted">(Optional)</span></label>
                                        <input type="text" class="form-control" name="address2_'.$a.'" id="address2_'.$a.'" value="'.$memberStreet2.'">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address3_'.$a.'">Address 3 <span class="text-muted">(Optional)</span></label>
                                        <input type="text" class="form-control" name="address3_'.$a.'" id="address3_'.$a.'" value="'.$memberStreet3.'">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label for="city'.$a.'">City</label>
                                            <input type="text" class="form-control" name="city'.$a.'" id="city'.$a.'" value="'.$memberCity.'" required>
                                            <div class="invalid-feedback">
                                                Please enter your city.
                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="state'.$a.'">State</label>
                                            <select class="custom-select d-block w-100" name="state'.$a.'" id="state'.$a.'" required>
                                            <option value="">Choose...</option>';
                                            foreach ($usStates as $state){
                                            if ($state['state'] == $memberState){
                                                    $selectedState = 'selected="selected"';
                                                } else{
                                                    $selectedState = null;
                                                }
                                                echo '<option value="'.$state['abbreviation'].'" '.$selectedState.'>'.$state['state'].'</option>';
                                            }
                                            echo '</select>
                                            <div class="invalid-feedback">
                                                Please provide a valid state.
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="zip'.$a.'">Zip</label>
                                            <input type="text" class="form-control" name="zip'.$a.'" id="zip'.$a.'" value="'.$memberZip.'" required>
                                            <div class="invalid-feedback">
                                                Zip code required.
                                            </div>
                                        </div>
                                    </div>
                                <input type="hidden" name="action" value="updateAddress">
                                <input type="hidden" name="memberID" value="'.$memberID.'">
                                <input type="hidden" name="addressID" value="'.$memberAddressID.'">
                            <button class="btn btn-primary btn-lg float-left mr-2" type="submit">Update Address</button>
                            <a class="btn btn-outline-danger btn-lg" href="/members/?action=\'deleteAddress\'&memberID=\''.$memberID.'\'&addressID=\''.$memberAddressID.'\'">Delete Address</a>
                            </form>';
                            $a += 1;
                        }
                    ?>
                
                <form action="/members/"  class="needs-validation mb-4" method="post" novalidate>
                    <div class="mb-3">
                        <label for="addressNew">Address 1</label>
                        <input type="text" class="form-control" name="addressNew" id="addressNew" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your street address.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address2New">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" name="address2New" id="address2New" placeholder="Apartment or suite">
                    </div>
                    <div class="mb-3">
                        <label for="address3New">Address 3 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" name="address3New" id="address3New" placeholder="Apartment or suite">
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="cityNew">City</label>
                            <input type="text" class="form-control" name="cityNew" id="cityNew" placeholder="City" required>
                            <div class="invalid-feedback">
                                Please enter your city.
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="stateNew">State</label>
                            <select class="custom-select d-block w-100" name="stateNew" id="stateNew" required>
                            <option value="">Choose...</option>
                            <?php
                                foreach ($usStates as $state){
                                    echo '<option value="'.$state['abbreviation'].'">'.$state['state'].'</option>';
                                }
                            ?>
                            </select>
                            <div class="invalid-feedback">
                                    Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" name="zip" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="addAddress">
                    <input type="hidden" name="memberID" value="$memberID">
                    <button class="btn btn-primary btn-lg float-left" type="submit" value="update">Add Address</button>
                    <a class="btn btn-secondary btn-lg float-right mr-2" href="/members">Back to List</a>
                </form>
            </fieldset>
            
            <hr class="mb-4">
        </div>
        <a href="/members">Back to List</a>
    </main>
</div>

<footer class="border-top footer text-muted">
    <div class="container">
        &copy; 2020 - Brad R. Allen - <a href="/Privacy">Privacy</a>
    </div>
</footer>

<?php include $_SERVER['DOCUMENT_ROOT'].'/common/scripts.php';?>
<script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
</body>

</html>