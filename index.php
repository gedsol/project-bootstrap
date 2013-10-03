<?php
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$max_file_size = 15728640;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="cache-control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>Image upload</title>
    <script type="text/javascript">
        var small = true;
        function resize(){
            if (!small) {
                document.getElementById("image").style.width = "75%";
                document.getElementById("controls").style.display = "block";
                document.getElementById("header").style.display = "block";
                small = true;
            } else {
                document.getElementById("image").style.width = "100%";
                document.getElementById("controls").style.display= "none";
                document.getElementById("header").style.display = "none";
                small = false;

            }
        }

    </script>
</head>

<body>
<form id="Upload" action="upload.php" enctype="multipart/form-data" method="post">
    <h1 id="header">Upload your image</h1>
    <img id="image" src="images/file.jpg" onclick="resize();">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
    <p id="controls">
        <input id="file"  type="file" name="file" accept="image/*" >
        <input id="submit" type="submit" name="submit" value="Upload">
    </p>
</form>
</body>
</html>
