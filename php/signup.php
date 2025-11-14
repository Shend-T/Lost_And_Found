<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBT - Lost And Found</title>

    <!-- === Title Icon === -->
    <link rel="icon" href="../media/favicon.ico" type="image/x-icon" />

    <!-- === CSS Links === -->
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/auth.css">
    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />
</head>
<body>
    <div class="container flex center">
        <div class="paper glass flex">
            <div class="form-header flex center-h">
                <h1>Welcome!</h1>
                <p>Please create you're profile...</p>
            </div>
            <hr>

            <div class="form-container flex center">
                <form class="form flex center-v" action="">
                    <label for="id">Student ID: </label>
                    <input type="number" id="idInput" name="id" >

                    <label for="username">Username: </label>
                    <input type="text" name="username" >

                    <label for="password">Password:</label>
                    <input type="password" name="password">

                    <input type="submit" value="Log In">
                </form>

                <br />
                <p>Already Have An Account? <a href="#">Log In</a></p>
            </div>
        </div>
    </div>

    
<script>
  const numberInput = document.getElementById('idInput');

  numberInput.addEventListener('keypress', function(event) {
    if (event.key < '0' || event.key > '9') {
      event.preventDefault();
    }
  });
</script>
</body>
</html>