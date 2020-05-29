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
                var_dump ($memberDetail);

                //if (isset($memberId)) {
                    // echo  "<div><h4>Member ID:$memberId</h4><hr /><dl class=\"row\">";}

                    // foreach($memberDetail as $detail){
                    //     $firstName = $detail['firstName'];
                    //     $middleName = $detail['middleName'];
                    //     $lastName = $detail['lastName'];
                    //     $preferredName = $detail['preferredName'];
                    //     $callSign = $detail['callsign'];
                    //     $memberDOB = $detail['dob'];
                    //     $sarEmail = $detail['saremail'];
                    //     $personalEmail = $detail['personalemail'];
                    //     $dlNumber = $detail['dlNumber'];
                    //     $ssnLastFour = $detail['ssnLastFour'];
                    //     $memberStatus = $detail['memberstatustype'];
                    //     $eContactName = $detail['contactFullName'];
                    //     $eContactCell = format_phone_us($detail['contactcellphone']);
                    //     $eContactHome = format_phone_us($detail['contacthomephone']);
                    //     echo "  <dt class=\"col-sm-2\">
                    //                 First Name
                    //             </dt>
                    //             <dd class=\"col-sm-10\">
                    //                 $firstName
                    //             </dd>
                    //             <dt class=\"col-sm-2\">
                    //                 Middle Name
                    //             </dt>
                    //             <dd class=\"col-sm-10\">
                    //                 $middleName
                    //             </dd>
                    //             <dt class=\"col-sm-2\">
                    //                 Last Name
                    //             </dt>
                    //             <dd class=\"col-sm-10\">
                    //                 $lastName
                    //             </dd>
                    //             <dt class=\"col-sm-2\">
                    //                 Preferred Name
                    //             </dt>
                    //             <dd class=\"col-sm-10\">
                    //                 $preferredName
                    //             </dd>
                    //             <dt class=\"col-sm-2\">
                    //                 Call Sign
                    //             </dt>
                    //             <dd class=\"col-sm-10\">
                    //                 $callSign
                    //             </dd>
                    //             <dt class=\"col-sm-2\">
                    //                 DOB
                    //             </dt>
                    //             <dd class=\"col-sm-10\">
                    //                 $memberDOB
                    //             </dd>
                    //             <dt class=\"col-sm-2\">
                    //                 SAR eMail
                    //             </dt>
                    //             <dd class=\"col-sm-10\">
                    //                 $sarEmail
                    //             </dd>
                    //             <dt class=\"col-sm-2\">
                    //                 Personal eMail
                    //             </dt>
                    //             <dd class=\"col-sm-10\">
                    //                 $personalEmail
                    //             </dd>
                    //     ";
                    // }
                    // echo "</dl></div><div>
                    //         <a href=\"/members/?action=edit&id=$memberID\">Edit</a> |
                    //         <a href=\"/members\">Back to List</a>
                    //     </div>";

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