



<div class="limiter">
    <div class="container-table100" style="background-color: #fff;">
        <div class="container" >
            <div class="row">
                <div class="col-md-8">

                    <h2 class="comments"><?php
                        if (!empty($results[0])) {
                            echo $results[0]->name;
                        }
                        ?></h2>
                    <div class="coinTables">
                        <div class="table-coin" id="results">
                            <div class='theader'>
                                <div class='table_header'>Rank</div>
                                <div class='table_header'>Market Cap</div>
                                <div class='table_header'>Price</div>
                                <div class='table_header'>Calculating Supply</div>
                                <div class='table_header'>Change (24)</div>
                            </div>
                            <div class='table_row'>
                                <div class='table_small'>
                                    <div class='table_cell'>Rank</div>
                                    <div class='table_cell'><?php
                                        if (!empty($results[0])) {
                                            echo $results[0]->rank;
                                        }
                                        ?></div>
                                </div>
                                <div class='table_small'>
                                    <div class='table_cell'>Market Cap</div>
                                    <div class='table_cell'><?php
                                        if (!empty($results[0])) {
                                            echo $results[0]->market_cap_usd;
                                        }
                                        ?></div>
                                </div>
                                <div class='table_small'>
                                    <div class='table_cell'>Header Three</div>
                                    <div class='table_cell'><?php
                                        if (!empty($results[0])) {
                                            echo $results[0]->price_usd;
                                        }
                                        ?></div>
                                </div>
                                <div class='table_small'>
                                    <div class='table_cell'>Calculating Supply</div>
                                    <div class='table_cell'><?php
                                        if (!empty($results[0])) {
                                            echo $results[0]->total_supply." ". $results[0]->symbol;
                                        }
                                        ?></div>
                                </div>
                                <div class='table_small'>
                                    <div class='table_cell'>Header Four</div>
                                    <div class='table_cell'><?php
                                        if (!empty($results[0])) {
                                            echo $results[0]->percent_change_24h;
                                        }
                                        ?></div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <hr>
                    <div id="disqus_thread"></div>
                    <?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                    <script>
                        var disqus_config = function () {
                            this.page.url = "<?= $actual_link ?>";  // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = "<?= $actual_link ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };

                        (function () { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://daily-crypto-ratings-1.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>

                <div class="col-md-4 border">
                    <h4 class="comments" title="Recent Comments :">Recent Comments : </h4>
                    <div >
                        <script type="text/javascript" src="https://daily-crypto-ratings-1.disqus.com/recent_comments_widget.js?num_items=6&amp;hide_avatars=0&amp;avatar_size=40&amp;excerpt_length=200"></script>
                    </div>
                </div>
            </div>

        </div>
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
<script id="dsq-count-scr" src="//dailycryptoratings-com.disqus.com/count.js" async></script>
</body>
</html>