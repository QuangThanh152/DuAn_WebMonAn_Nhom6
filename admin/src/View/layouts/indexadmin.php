<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

</head>

<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>
    <div class="content-wrapper">
        <?php include __DIR__ . '/../partials/sidebar.php'; ?>
        <!-- <div class="main-content"> -->
            <?php include __DIR__ . '/../partials/home.php'; ?>
            <?php include __DIR__ . '/../partials/menuCRUD.php'; ?>
        <!-- </div> -->
    </div>
    <script src="<?php echo BASE_URL; ?>/admin/assets/js/scripts.js"></script>
</body>

</html>