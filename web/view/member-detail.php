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
  
</head>

<body>
<header>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/common/nav.php'; ?>
</header>
<div class="container">
    <main role="main" class="pb-3">
        <h1>Member Details</h1>
        
           <?php
           if (isset($message)) {
               echo $message;
            }else{
                //var_dump ($memberDetail);
                if (!empty($memberDetail)) {
                    echo  "<div><h4>Member ID: $memberID</h4><hr /><dl class=\"row\">";
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
                    $eContactCell = format_phone_us($memberDetail['contactcellphone']);
                    $eContactHome = format_phone_us($memberDetail['contacthomephone']);

                    echo "  <dt class=\"col-sm-2\">
                                First Name
                            </dt>
                            <dd class=\"col-sm-10\">
                                $firstName
                            </dd>
                            <dt class=\"col-sm-2\">
                                Middle Name
                            </dt>
                            <dd class=\"col-sm-10\">
                                $middleName
                            </dd>
                            <dt class=\"col-sm-2\">
                                Last Name
                            </dt>
                            <dd class=\"col-sm-10\">
                                $lastName
                            </dd>
                            <dt class=\"col-sm-2\">
                                Preferred Name
                            </dt>
                            <dd class=\"col-sm-10\">
                                $preferredName
                            </dd>
                            <dt class=\"col-sm-2\">
                                Call Sign
                            </dt>
                            <dd class=\"col-sm-10\">
                                $callSign
                            </dd>
                            <dt class=\"col-sm-2\">
                                DOB
                            </dt>
                            <dd class=\"col-sm-10\">
                                $memberDOB
                            </dd>
                            <dt class=\"col-sm-2\">
                                SAR eMail
                            </dt>
                            <dd class=\"col-sm-10\">
                                $sarEmail
                            </dd>
                            <dt class=\"col-sm-2\">
                                Personal eMail
                            </dt>
                            <dd class=\"col-sm-10\">
                                $personalEmail
                            </dd>
                            <dt class=\"col-sm-2\">
                                Drivers License
                            </dt>
                            <dd class=\"col-sm-10\">
                                #:$dlNumber State:$dlState 
                            </dd>
                            <dt class=\"col-sm-2\">
                                SSN Last Four
                            </dt>
                            <dd class=\"col-sm-10\">
                                $ssnLastFour
                            </dd>
                            <dt class=\"col-sm-2\">
                                Status
                            </dt>
                            <dd class=\"col-sm-10\">
                                $memberStatus
                            </dd>
                            <hr />
                            <dt class=\"col-sm-2\">
                                Emergency Contact
                            </dt>
                            <dd class=\"col-sm-10\">
                                $eContactName
                            </dd>
                            <dt class=\"col-sm-2\">
                                Emergency Cell #
                            </dt>
                            <dd class=\"col-sm-10\">
                                $eContactCell
                            </dd>
                            <dt class=\"col-sm-2\">
                                Emergency Home #
                            </dt>
                            <dd class=\"col-sm-10\">
                                $eContactHome
                            </dd>                           
                            ";
                    
                    echo "</dl></div><div>
                            <a href=\"/members/?action=edit&id=$memberId\">Edit</a> |
                            <a href=\"/members\">Back to List</a>
                        </div>";
                }

            }  ?>

                
            <!-- <dl class="row">
                <dt class="col-sm-2">
                    Title
                </dt>
                <dd class="col-sm-10">
                    Test Movie
                </dd>
                <dt class="col-sm-2">
                    ReleaseDate
                </dt>
                <dd class="col-sm-10">
                    1/21/2020
                </dd>
                <dt class="col-sm-2">
                    Genre
                </dt>
                <dd class="col-sm-10">
                    Drama
                </dd>
                <dt class="col-sm-2">
                    Price
                </dt>
                <dd class="col-sm-10">
                    2.99
                </dd>
            </dl>
            </div>
            <div>
            <a href="/members/?action=edit&id=$memberID">Edit</a> |
            <a href="/members">Back to List</a>
            </div> -->
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