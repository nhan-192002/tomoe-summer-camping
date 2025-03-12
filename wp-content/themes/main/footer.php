<?php
    $copyright = get_field('copyright', get_the_ID());
?>
<footer id="footer" class="footer-custom position-relative">
    <div class="footer-copyright">
        <h4 class="copyright"><?php echo $copyright;?> © <?php echo date('Y'); ?></h4>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo theme_uri()?>/assets/scripts/jquery.min.js"></script>
<script src="<?php echo theme_uri()?>/assets/scripts/bootstrap.bundle.min.js"></script>
<script src="<?php echo theme_uri()?>/assets/scripts/popper.min.js"></script>
<script src="<?php echo theme_uri()?>/assets/scripts/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="<?php echo theme_uri()?>/assets/scripts/script.js"></script>
</body>
</html>