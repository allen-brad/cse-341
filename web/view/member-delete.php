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
        <h1>Delete Member</h1>
        <?php echo "<h4>Member ID: $memberID</h4>";?>
        <hr />
        <?php if (isset($message)) { echo $message;}?>
        <!-- <div class="row">
            <div class="col-md-4">
                <form method="post">
                    <input type="hidden" data-val="true" data-val-required="The ID field is required." id="Movie_ID" name="Movie.ID" value="2" />
                    <div class="form-group">
                        <label class="control-label" for="Movie_Title">Title</label>
                        <input class="form-control" type="text" id="Movie_Title" name="Movie.Title" value="Test Movie" />
                        <span class="text-danger field-validation-valid" data-valmsg-for="Movie.Title" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Movie_ReleaseDate">ReleaseDate</label>
                        <input class="form-control" type="date" data-val="true" data-val-required="The ReleaseDate field is required." id="Movie_ReleaseDate" name="Movie.ReleaseDate" value="2020-01-21" />
                        <span class="text-danger field-validation-valid" data-valmsg-for="Movie.ReleaseDate" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Movie_Genre">Genre</label>
                        <input class="form-control" type="text" id="Movie_Genre" name="Movie.Genre" value="Drama" />
                        <span class="text-danger field-validation-valid" data-valmsg-for="Movie.Genre" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Movie_Price">Price</label>
                        <input class="form-control" type="text" data-val="true" data-val-number="The field Price must be a number." data-val-required="The Price field is required." id="Movie_Price" name="Movie.Price" value="2.99" />
                        <span class="text-danger field-validation-valid" data-valmsg-for="Movie.Price" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                <input name="__RequestVerificationToken" type="hidden" value="CfDJ8Ij_CcvMZaxChWQ7xxy43_rJ7E3ZwhN44GRc1FptRRCIHSi-5Mg_dOtFWUxvWOi61zgH3NUEzlyAhe7gtEZJmzYOA10Yt9a8WJbztNo21Zjd1I6Mf-4Nt_SU7FhHmxrdmJh-AfHi2fRAViZufCYHiVA" /></form>
            </div>
        </div>
        <div>
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