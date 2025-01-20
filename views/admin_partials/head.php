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
  <link
    href="<?= ROOT_URL ?>public/admin/css/app.min.css"
    rel="stylesheet"
    type="text/css"
    id="app-style" />

  <!-- Icons -->
  <link href="<?= ROOT_URL ?>public/admin/css/icons.min.css" rel="stylesheet" type="text/css" />

  <script src="<?= ROOT_URL ?>public/admin/js/head.js"></script>
</head>

<!-- body start -->

<?php
$username_email = $_SESSION['signin-data']['username_email'] ?? ''; // Using null coalescing operator to avoid undefined index errors
$password = $_SESSION['signin-data']['password'] ?? '';
$submit = $_SESSION['signin-data']['submit'] ?? '';

$user_logged_in = $_SESSION['user_logged_in'] ?? false;
$user_id = $_SESSION['user_id'] ?? '';
$first_name = $_SESSION['first_name'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
$email = $_SESSION['email'] ?? '';
$contact_number = $_SESSION['contact_number'] ?? '';
$blood_type = $_SESSION['blood_type'] ?? '';
$street_address_1 = $_SESSION['street_address_1'] ?? '';
$street_address_2 = $_SESSION['street_address_2'] ?? '';
$city = $_SESSION['city'] ?? '';
$area = $_SESSION['area'] ?? '';
$last_donated_date = $_SESSION['last_donated_date'] ?? '';
$weight = $_SESSION['weight'] ?? '';
$donated_before = $_SESSION['donated_before'] ?? ''; // This is returning NULL, so check why
$registration_type = $_SESSION['registration_type'] ?? '';
?>

<body data-menu-color="light" data-sidebar="default">
  <!-- Begin page -->
  <div id="app-layout">