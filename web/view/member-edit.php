<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="WCSAR Members">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fafafa"><!-- this alters the google chrome toolbar color -->

  <title>WCSAR | Members</title>

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
    <main role="main" class="pb-3">
        <h1>Edit Member</h1>
        <?php echo "<h4>Member ID: $memberID</h4>";?>
        <hr />
        <?php if (isset($message)) { echo $message;}?>
        <div class="col-md-12 order-md-1">
            <form action="/members/?action=update&id=$memberID"  class="needs-validation" method="post" validate>
                <fieldset class="form-group">
                    <h4 class="mb-3">Personal Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="$firstName" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="preferredName">Preferred name</label>
                            <input type="text" class="form-control" name="preferredName" id="preferredName" placeholder="" value="$preferredName" required>
                            <div class="invalid-feedback">
                                Valid preferred name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="middleName">Middle name</label>
                            <input type="text" class="form-control" name="middleName" id="middleName" placeholder="" value="$middleName" required>
                            <div class="invalid-feedback">
                                Valid middel name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="$lastName" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="callSign">Call sign</label>
                            <input type="text" class="form-control" name="callSign" id="callSign" placeholder="" value="$callSign" required>
                            <div class="invalid-feedback">
                                Valid Call Sign name is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dob">Date of birth</label>
                            <input type="date" class="form-control" name="dob" id="dob" placeholder="" value="$dob" required>
                            <div class="invalid-feedback">
                                Valid DOB is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="ssnLastFour">SSN last four</label>
                            <input type="text" class="form-control" name="ssnLastFour" id="ssnLastFour" placeholder="" value="$ssnLastFour" required>
                            <div class="invalid-feedback">
                                Valid SSN last four is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dlNumber">Drivers license #</label>
                            <input type="text" class="form-control" name="dlNumber" id="dlNumber" placeholder="" value="$dlNumber" required>
                            <div class="invalid-feedback">
                                Valid drivers license number is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dlState">Drivers license state</label>
                            <select class="form-control" id="dlState" required>
                                <option>1</option>
                                <option>2</option>
                                <option selected="selected">UT</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <div class="invalid-feedback">
                                Valid drivers license state is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="memberStatus">Member status</label>
                            <select class="form-control" id="memberStatus" required>
                                <option selected="selected">Active</option>
                                <option>Probation</option>
                                <option>Retired</option>
                                <option>Training</option>
                            </select>
                            <div class="invalid-feedback">
                                Valid status license state is required.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="personalEmail">Personal email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" name="personalEmail" id="personalEmail" placeholder="" value="$personalEmail" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                    </div>
                </fieldset><!-- end fieldset -->

                <div class="mb-3">
                    <label for="address1">Address</label>
                    <input type="text" class="form-control" name="address1" id="address1" placeholder="1234 Main St" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="mb-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                    <div class="invalid-feedback">
                        Please enter your shipping city.
                    </div>
                </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" name="country" id="country" required>
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" name="state" id="state" required>
                  <option value="">Choose...</option>
                  <option>California</option>
                  <option>Utah</option>
                  <option>Idaho</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="zip" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <input type="hidden" name="action" value="completeOrder">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Complete Order</button>
            <a class="btn btn-secondary btn-lg btn-block" href="/assignmentW03.php">Coontinue Shopping</a>
          </form>
          <hr class="mb-4">
        </div>

            <a href="/members">Back to List</a>
        </div> 
    </main>
</div>

<footer class="border-top footer text-muted">
    <div class="container">
        &copy; 2020 - Brad R. Allen - <a href="/Privacy">Privacy</a>
    </div>
</footer>

<?php include $_SERVER['DOCUMENT_ROOT'].'/common/scripts.php';?>

</body>

</html>