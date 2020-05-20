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
        <h1>Index</h1>
        <p>
            <a href="/Movies/Create">Create New</a>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Title
                    </th>
                    <th>
                        ReleaseDate
                    </th>
                    <th>
                        Genre
                    </th>
                    <th>
                        Price
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Test Movie
                    </td>
                    <td>
                        1/21/2020
                    </td>
                    <td>
                        Drama
                    </td>
                    <td>
                        2.99
                    </td>
                    <td>
                        <a href="/Movies/Edit?id=2">Edit</a> |
                        <a href="/Movies/Details?id=2">Details</a> |
                        <a href="/Movies/Delete?id=2">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</div>

<footer class="border-top footer text-muted">
    <div class="container">
        &copy; 2020 - RazorPagesMovie - <a href="/Privacy">Privacy</a>
    </div>
</footer>

<?php include $_SERVER['DOCUMENT_ROOT'].'/common/scripts.php';?>

</body>

</html>