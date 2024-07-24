<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jQerry.js"></script>
</head>
<body>
<script>
    $.ajax(
        'index.php',
        {
            success: function(data) {
                alert('AJAX call was successful!');
                alert('Data from the server' + data);
            },
            error: function() {
                alert('There was some error performing the AJAX call!');
            }
        }
    );
</script>
</body>
</html>