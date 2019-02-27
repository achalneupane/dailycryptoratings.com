<div class="container-table100">



<div class="container">
    <div>
    <h3>Contact</h3>
    <p>For advertisements, please contact us at: <b>info@dailycryptoratings.com</b></p>
    <hr>
    <p><b>Donate BTC:</b> 1HWV1vJnMAHw1qNngEhhYB7RMTzbVmqRdf</p>
    <hr>
    <p><b>Donate LTC:</b> LUBMtJbc9JTZuAYkDMFncd2i5aJgXJSyG6</p>
    <hr>
    <p><b>Donate ETH:</b> 0x0993e9300add9380c725cb5a28265d991b306c57</p>

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