<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jQerry.js"></script>
  <script src="js/script.js"></script>
</head>
<body>
<script>
    $.ajax({
        url : 'test.php',
        method : 'GET',
        dataType : 'json',
        success : function (result) {
            alert(result);
        },
        error : function () {
            alert("error");
        }
    })
</script>
</body>
</html>