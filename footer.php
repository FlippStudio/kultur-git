<section id="footer">
    <div class="container h-100">
        <div class="footer-container">
            <div id="copy">
                &copy; <?php the_field('copyright', 7); ?>
            </div>
            <div class="ms-sm-auto">
                Realizacja portalu Filip Głowski
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/accesibility.js"></script>
<script>
    $(document).ready(function(){
        checkContrast();

        $("#contrast img").on('click keypress', function(e){
            if($('link[href="<?php bloginfo('template_directory'); ?>/css/contrast.css"]').prop('disabled')){
                $('link[href="<?php bloginfo('template_directory'); ?>/css/contrast.css"]').prop('disabled', false);
                $.removeCookie("contrast");
                $.cookie("contrast", true, {path : "/"});
            }else{
                $('link[href="<?php bloginfo('template_directory'); ?>/css/contrast.css"]').prop('disabled', true);
                $.removeCookie("contrast");
                $.cookie("contrast", false, {path : "/"});
            }
        });

        function checkContrast(){
            if($.cookie("contrast") != null){
                if($.cookie("contrast") == 'true')
                    $('link[href="<?php bloginfo('template_directory'); ?>/css/contrast.css"]').prop('disabled', false);
            }
        }

    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php wp_footer(); ?>

</body>

</html>