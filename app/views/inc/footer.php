<script>
        var isAuthor  = <?= isset($_SESSION['id_user']) && $_SESSION['role'] == 'Author' ? 'true' : 'false' ?>;
 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="<?php echo URLROOT; ?>/public/js/main.js"></script>
</body>
</html>


