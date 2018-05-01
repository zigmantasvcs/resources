<?php
    include_once 'header.php';
?>
<section class="main-container">
    <div class="main-wrapper-content">
        <h2>Home</h2>
        <?php
            if(isset($_SESSION['u_id'])) {
                echo "<p>Prisijungėte sėkmingai.</p>";
            }
        ?>
    </div>
</section>
<?php
    include_once 'footer.php';
?>

