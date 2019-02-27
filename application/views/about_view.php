<div class="container-table100">
<div class="container">
    <h3>About</h3>
    <br>
    <p>
        About this site: This site allows users to rate any cryptocurrencies on a scale of 1 to 10 star ratings. Users have to authenticate their login using Google or Facebook account before they can vote for any coins. This site also allows users to register comments about any coins listed on this website by following the comment hyperlink specific to that coin. Users are limited to one vote per day, but can submit unlimited comments.
    </p>

</div>
</div>



<!--===============================================================================================-->	
<script src="<?= base_url() ?>include/vendor/jquery/jquery-3.2.1.min.js"></script>

<!--===============================================================================================-->
<script src="<?= base_url() ?>include/vendor/bootstrap/js/popper.js"></script>
<script src="<?= base_url() ?>include/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url() ?>include/vendor/select2/select2.min.js"></script>

<!--===============================================================================================-->
<script src="<?= base_url() ?>include/js/main.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>include/css/jquery-ui.css">

<script src="<?= base_url() ?>include/js/jquery-ui.js"></script>
<script>
    $(document).ready(function () {



        $("#suggest").autocomplete({
            delay: 100,
            source: function (request, response) {
                // delegate back to autocomplete, but extract the last term
                $.getJSON('<?php echo base_url() . "welcome/autocomplete"; ?>', {term: request.term}, response);
            },
            select: function (event, ui) {
                $("#coinSearch").submit();
            },
            change: function (event, ui) {
                //alert("change");
            }
        });

        $('#suggest').change(function () {
            // alert($('#suggest').val());
            // $( "#coinSearch" ).submit();
        });

    });
</script>
<script id="dsq-count-scr" src="//daily-crypto-ratings-1.disqus.com/count.js" async></script>
</body>
</html>