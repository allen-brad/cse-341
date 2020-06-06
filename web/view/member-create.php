<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="WCSAR Create Member">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fafafa"><!-- this alters the google chrome toolbar color -->

  <title>WCSAR | Create Member</title>

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
        <h1>Create Member</h1>
        <hr />
        <?php
            if (!empty($_SESSION['message'])){
                echo $_SESSION['message'];
                unset ($_SESSION['message']);
            }      
        ?>
        <div class="col-md-12 order-md-1">
            <form action="/members/"  class="needs-validation" method="post" novalidate>
                <fieldset class="form-group">
                    <h4 class="mb-3">Personal Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First name" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="preferredName">Preferred name</label>
                            <input type="text" class="form-control" name="preferredName" id="preferredName" placeholder="Preferred name" required>
                            <div class="invalid-feedback">
                                Valid preferred name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="middleName">Middle name</label>
                            <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Middle name" required>
                            <div class="invalid-feedback">
                                Valid middel name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last name" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="callSign">Call sign</label>
                            <input type="text" class="form-control" name="callSign" id="callSign" placeholder="Call sign" required>
                            <div class="invalid-feedback">
                                Valid Call Sign name is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dob">Date of birth</label>
                            <input type="date" class="form-control" name="dob" id="dob" placeholder="" required>
                            <div class="invalid-feedback">
                                Valid DOB is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="ssnLastFour">SSN last four</label>
                            <input type="text" class="form-control" name="ssnLastFour" id="ssnLastFour" placeholder="SSN last four" required>
                            <div class="invalid-feedback">
                                Valid SSN last four is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dlNumber">Drivers license #</label>
                            <input type="text" class="form-control" name="dlNumber" id="dlNumber" placeholder="DL number" required>
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
                                        echo '<option value="'.$state['abbreviation'].'"</option>';
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
                                        echo '<option value="'.$type['memberstatusid'].'">'.$type['memberstatustype'].'</option>';
                                    }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Valid status is required.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sarEmail">SAR email</label>
                            <input type="email" class="form-control" name="sarEmail" id="sarEmail" placeholder="SAR Email" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="personalEmail">Personal email</label>
                            <input type="email" class="form-control" name="personalEmail" id="personalEmail" placeholder="Personal Email" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="addMember">
                    <button class="btn btn-primary btn-lg float-left" type="submit">Add Member Details</button>
                    <a class="btn btn-secondary btn-lg float-right" href="/members">Back to List</a>
                </fieldset>
            </form>
            
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