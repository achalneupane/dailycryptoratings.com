
<!--<a href="<?  base_url()?>Welcome/google_login"><img src="http://bladephp.co/projectdemo/google/img/glogin.png" alt=""></a>-->

<div class="container" style="background-color: #efefef;">

    <div class="login-box">
        <h2>Login With</h2>
        <a href="<?php echo $authUrl ?>" class="social-button" id="facebook-connect"> <span>Connect with Facebook</span></a>
        <a href="<?php echo base_url() ?>login/google" class="social-button" id="google-connect"> <span>Connect with Google</span></a>
    <!--    <a href="#" class="social-button" id="twitter-connect"> <span>Connect with Twitter</span></a>
        <a href="#" class="social-button" id="linkedin-connect"> <span>Connect with LinkedIn</span></a>-->
    </div>
</div>
<style>
    body{
        background-color: #efefef;
    }
</style>








<!--===============================================================================================-->	
<script src="<?= base_url() ?>include/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>include/vendor/bootstrap/js/popper.js"></script>
<script src="<?= base_url() ?>include/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>include/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>include/js/main.js"></script>
<script id="dsq-count-scr" src="//daily-crypto-ratings-1.disqus.com/count.js" async></script>
</body>
</html>