
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<form action="certiVerifier.php" method="post" enctype="multipart/form-data">
  <div class = "form-group">
    <label for="exampleFormControlFile1">Select The Index file which you have: </label>
    <input type="file" class="form-control-file" name="indexFile"> <br>

    <label for="exampleFormControlFile1">Select the certificate which you want to verify: </label>
    <input type="file" class="form-control-file" name="certificate"> <br>

    <label for="name">Enter the block number from the index file:  </label>
    <input type="text" class="form-control" name="blockNum" placeholder="Enter the block Number"> <br>

    <button type="submit" class="btn btn-default">Submit</button>
  </div>
</form>
</body>
</html>
