<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Dashboard | Blood Project</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta
    name="description"
    content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
  <meta name="author" content="Blood Bonds" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= ROOT_URL ?>public/images/fab.png" />

  <!-- Datatables css -->
  <link
    href="<?= ROOT_URL ?>public/admin/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
    rel="stylesheet"
    type="text/css" />
  <link
    href="<?= ROOT_URL ?>public/admin/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
    rel="stylesheet"
    type="text/css" />
  <link
    href="<?= ROOT_URL ?>public/admin/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css"
    rel="stylesheet"
    type="text/css" />
  <link
    href="<?= ROOT_URL ?>public/admin/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
    rel="stylesheet"
    type="text/css" />

  <!-- App css -->
  <!-- <link
    href="<?= ROOT_URL ?>public/admin/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" /> -->
  <link
    href="<?= ROOT_URL ?>public/admin/css/app.min.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/public/admin/css/app.min.css') ?>"
    rel="stylesheet" type="text/css" id="app-style" />

  <!-- Icons -->
  <link href="<?= ROOT_URL ?>public/admin/css/icons.min.css" rel="stylesheet" type="text/css" />

  <script src="<?= ROOT_URL ?>public/admin/js/head.js"></script>
</head>

<!-- body start -->

<?php
$username_email = $_SESSION['admin_signin-data']['username_email'] ?? ''; // Using null coalescing operator to avoid undefined index errors
$password = $_SESSION['admin_signin-data']['password'] ?? '';
$submit = $_SESSION['admin_signin-data']['submit'] ?? '';

$admin_logged_in = $_SESSION['admin_logged_in'] ?? false;
$admin_id        = $_SESSION['admin_id'] ?? '';
$admin_name      = $_SESSION['admin_name'] ?? '';
$admin_username  = $_SESSION['admin_username'] ?? '';
$admin_phone     = $_SESSION['admin_phone'] ?? '';
$admin_email     = $_SESSION['admin_email'] ?? '';
$admin_status    = $_SESSION['admin_status'] ?? '';
?>

<body data-menu-color="light" data-sidebar="default">
  <!-- Begin page -->
  <div id="app-layout">