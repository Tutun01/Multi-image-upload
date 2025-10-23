<?php
session_start();
require_once "models/images.php";
$img= new Images();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="images.css" />
    </head>
   <body>
  <h1>📸 Image Gallery</h1>

  <?php if (!empty($_SESSION['errors'])): ?>
    <?php foreach ($_SESSION['errors'] as $error): ?>
      <div class="msg error"><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>
    <?php unset($_SESSION['errors']); ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['success'])): ?>
    <div class="msg success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <div class="gallery">
    <?php foreach ($img->getAllImages() as $image): ?>
      <div class="card">
        <img src="uploads/<?= htmlspecialchars($image['image']) ?>" alt="Uploaded image">
      </div>
    <?php endforeach; ?>
  </div>

  <footer>
    <p>Uploaded with ❤️ using PHP | <a href="index.php">Upload more</a></p>
  </footer>
</body>
</html>