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
        <h1>Details</h1>
        <div>
            <h4>Movie</h4>
            <hr />
            <dl class="row">
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
            <a href="/Movies/Edit?id=2">Edit</a> |
            <a href="/Movies">Back to List</a>
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