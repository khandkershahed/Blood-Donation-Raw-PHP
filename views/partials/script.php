<script src="<?= ROOT_URL ?>public/frontend/js/jquery.min.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/popper.min.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/bootstrap.min.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/wow.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/slick.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/fancybox.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/counterup.min.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/progress-bar.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/smooth-scroll.min.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/nice-select.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/waypoints.js"></script>
<script src="<?= ROOT_URL ?>public/frontend/js/script.js"></script>

<script>
    // Timeout for success message
    <?php if ($successMessage): ?>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 5000); // 5000 milliseconds = 5 seconds
    <?php endif; ?>

    // Timeout for error messages
    <?php if (!empty($errors)): ?>
        setTimeout(function() {
            document.getElementById('errorMessages').style.display = 'none';
        }, 5000); // 5000 milliseconds = 5 seconds
    <?php endif; ?>
</script>

</body>

</html>