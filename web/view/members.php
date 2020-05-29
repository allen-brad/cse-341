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
        <h1>WCSAR Member Directory</h1>
        <p>
            <a href="/members/?action=create">Create New</a>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Call Sign
                    </th>
                    <th>
                        Phone
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($memberDirectory as $member){
                    $fullName = $member['fullname'];
                    $callSign = $member['callsign'];
                    $phoneNumber = format_phone_us($member['phonenumber']);
                    $memberID = $member['memberid'];
                    echo "<tr>
                    <td>$fullName</td>
                    <td>$callSign</td>
                    <td>$phoneNumber</td>
                    <td>
                    <a href=\"/members/?action=details&id=$memberID\">Details</a> |
                    <a href=\"/members/?action=edit&id=$memberID\">Edit</a> |
                    <a href=\"/members/?action=delete&id=$memberID\">Delete</a>
                    </td>
                    </tr>";
                }
            ?>
            </tbody>
        </table>

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