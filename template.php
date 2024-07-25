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
        url: 'js/hexCoords.json',
        dataType: 'json',

        success: function (data) {
            test(data)
        }
    });
</script>
<div id="hex">

</div>
</body>
</html>