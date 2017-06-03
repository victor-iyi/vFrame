<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title> <?= isset($this->title) ? $this->title . " &bull; vFrame" : "vFrame"; ?> </title>
  <!-- Stylesheet -->
  <link rel="stylesheet" href="<?= ASSET_PATH . 'css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="<?= ASSET_PATH . 'css/style.css'; ?>">

  <!-- fonts here -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Open+Sans:300,400" rel="stylesheet">

  <?php
  if ( isset($this->css) )
    foreach ($this->css as $css)
      echo '<link rel="stylesheet" href="' . ASSET_PATH . 'css/' . $css .'.css">';
  ?>
</head>
<body>
