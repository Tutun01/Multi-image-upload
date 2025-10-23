<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image upload</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <div class="upload-card">
    <h1>Upload Your Images</h1>
    <p>Select one or more images to upload to your gallery.</p>

    <form method="POST" action="upload.php" enctype="multipart/form-data">
      <div class="file-input" onclick="document.getElementById('fileInput').click()">
        <label for="fileInput">Click or drag files here</label>
        <input type="file" id="fileInput" name="profileImage[]" multiple />
      </div>
      <input type="submit" class="btn" value="Upload Images" />
    </form>
  </div>
</body>
</html>
