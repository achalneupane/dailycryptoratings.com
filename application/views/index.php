<?php
$search = isset($_GET['search']) ? $_GET['search'] : '0';

$order = '';
$cloume = '';

$asc = $this->input->get('asc');
$desc = $this->input->get('desc');
if (!empty($asc)) {
    $order = 'asc';
    $cloume = $asc;
} else if (!empty($desc)) {
    $order = 'desc';
    $cloume = $desc;
} else {
    $order = 'asc';
    $cloume = 'rank';
}
?>

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <?php if (!empty($results)) { ?>
                <div class="table100">
                    <table id="sort-table">
                        <thead>
                            <tr class="table100-head">
                                <th class="column1 option-heading">
                                    <a href="<?php
                                    if (!empty($this->input->get('desc'))) {
                                        echo base_url() . "?asc=rank";
                                    } else {
                                        echo base_url() . "?desc=rank";
                                    }
                                    ?>" <?php if ($cloume == 'rank') { ?>class="sort-by<?php
                                           if (empty($this->input->get('desc'))) {
                                               echo '-asc';
                                           } else {
                                               echo "-desc";
                                           }
                                           ?>" <?php } ?>>No</a>
                                </th>
                                <th class="column2">
                                    <a href="<?php
                                    if (!empty($this->input->get('desc'))) {
                                        echo base_url() . "?asc=name";
                                    } else {
                                        echo base_url() . "?desc=name";
                                    }
                                    ?>" <?php if ($cloume == 'name') { ?>class="sort-by<?php
                                           if (empty($this->input->get('desc'))) {
                                               echo '-asc';
                                           } else {
                                               echo "-desc";
                                           }
                                           ?>" <?php } else { ?> class="sort-by"<?php } ?>>Name</a>
                                </th>
                                <th class="column3"><a href="<?php
                                    if (!empty($this->input->get('desc'))) {
                                        echo base_url() . "?asc=market_cap_usd";
                                    } else {
                                        echo base_url() . "?desc=market_cap_usd";
                                    }
                                    ?>" <?php if ($cloume == 'market_cap_usd') { ?>class="sort-by<?php
                                                           if (empty($this->input->get('desc'))) {
                                                               echo '-asc';
                                                           } else {
                                                               echo "-desc";
                                                           }
                                                           ?>" <?php } else { ?> class="sort-by"<?php } ?>>Market Cap</a></th>
                                <th class="column4">
                                    <a href="<?php
                                    if (!empty($this->input->get('desc'))) {
                                        echo base_url() . "?asc=price_usd";
                                    } else {
                                        echo base_url() . "?desc=price_usd";
                                    }
                                    ?>" <?php if ($cloume == 'price_usd') { ?>class="sort-by<?php
                                           if (empty($this->input->get('desc'))) {
                                               echo '-asc';
                                           } else {
                                               echo "-desc";
                                           }
                                           ?>" <?php } else { ?> class="sort-by"<?php } ?>>Price</a>
                                </th>
                                <th class="column5">
                                    <a href="<?php
                                    if (!empty($this->input->get('desc'))) {
                                        echo base_url() . "?asc=total_supply";
                                    } else {
                                        echo base_url() . "?desc=total_supply";
                                    }
                                    ?>" <?php if ($cloume == 'total_supply') { ?>class="sort-by<?php
                                           if (empty($this->input->get('desc'))) {
                                               echo '-asc';
                                           } else {
                                               echo "-desc";
                                           }
                                           ?>" <?php } else { ?> class="sort-by"<?php } ?>>Circulating Supply</a>
                                </th>
                                <th class="column6">

                                    <a href="<?php
                                    if (!empty($this->input->get('desc'))) {
                                        echo base_url() . "?asc=percent_change_24h";
                                    } else {
                                        echo base_url() . "?desc=percent_change_24h";
                                    }
                                    ?>" <?php if ($cloume == 'percent_change_24h') { ?>class="sort-by<?php
                                           if (empty($this->input->get('desc'))) {
                                               echo '-asc';
                                           } else {
                                               echo "-desc";
                                           }
                                           ?>" <?php } else { ?> class="sort-by"<?php } ?>>Change (24h)</a>
                                </th>
                                <th class="column7">

                                    <a href="<?php
                                    if (!empty($this->input->get('desc'))) {
                                        echo base_url() . "?asc=rating";
                                    } else {
                                        echo base_url() . "?desc=rating";
                                    }
                                    ?>" <?php if ($cloume == 'rating') { ?>class="sort-by<?php
                                           if (empty($this->input->get('desc'))) {
                                               echo '-asc';
                                           } else {
                                               echo "-desc";
                                           }
                                           ?>" <?php } else { ?> class="sort-by"<?php } ?>>Ratings</a>
                                </th>
                                <th class="column9">Discussions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($results)) {
                                foreach ($results as $value) {
//                                    echo "<pre>";
//                                    print_r($ratings);
//                                    exit();
                                    $rating24 = '0';
                                    $rating7 = '0';
                                    $ratingMonth = '0';
                                    $ratingOverAll = '0';
                                    if(!empty($ratings[$value->id]['avg24'])){ $rating24 = $ratings[$value->id]['avg24'];  }else { $rating24 = '0';};
                                    if(!empty($ratings[$value->id]['avg7'])){ $rating7 = $ratings[$value->id]['avg7'];  }else { $rating7 = '0';};
                                    if(!empty($ratings[$value->id]['avgMonth'])){ $ratingMonth = $ratings[$value->id]['avgMonth'];  }else { $ratingMonth = '0';};
                                    if(!empty($ratings[$value->id]['avgOverAll'])){ $ratingOverAll = $ratings[$value->id]['avgOverAll'];  }else { $ratingOverAll = '0';};

                                    ?>
                                    <tr>
                                        <td class="column1"><?= $value->rank ?></td>
                                        <td class="column2">
                                            <img src="https://files.coinmarketcap.com/static/img/coins/16x16/<?= $value->id ?>.png" alt="">
                                            <?= $value->name ?>
                                        </td>
                                        <td class="column3"><span class="color-blue">$</span><?= number_format($value->market_cap_usd) ?></td>
                                        <td class="column4"><span class="color-blue">$</span><?= number_format($value->price_usd, 6, '.', ',') ?></td>
                                        <td class="column5"><?= number_format($value->total_supply) . " " . $value->symbol ?></td>
                                        <td class="column6 <?php
                                        if ($value->percent_change_24h < 0) {
                                            echo "down_value";
                                        }else{
                                            echo 'color-green';
                                        }
                                        ?>" ><?= $value->percent_change_24h ?>%</td>
                                        <td class="column7">
                                            
                                            <div class="ratings_wrapper">
                                                <div class="Rating24">

                                                    <span>24 hour</span>
                                                    <div class="ratingValue" title="<?=$rating24."/10 Rating" ?>">
                                                        <div class="stars-outer">
                                                            <div class="stars-inner" style="width:<?= $rating24 * 10 ?>%;"></div>
                                                        </div>
                                                        <!-- <strong><span class="ratingValue"><? $ratings[$value->id]['avg24'] ?></span></strong>
                                                            <span class="grey">/</span>
                                                            <span class="grey" itemprop="bestRating">10</span>              -->
                                                    </div>
                                                    <span class="medium ratingCount color-blue"><i class="fa fa-user"></i> <?= $ratings[$value->id]['totalReview24'] ?></span>
                                                </div>

                                                <div class="Rating7">
                                                    <span>7 Days</span>
                                                    <div class="ratingValue">
                                                        <div class="stars-outer" title="<?=$rating7."/10 Rating"?>">
                                                            <div class="stars-inner" style=" width:<?= $rating7*10 . '%;'?>"></div>
                                                        </div>
                                                    </div>
                                                    <span class="medium ratingCount color-blue"><i class="fa fa-user"></i> <?= $ratings[$value->id]['TotalReview7'] ?></span>
                                                </div>
                                                <div class="Rating30">
                                                    <span>Monthly</span>
                                                    <div class="ratingValue">
                                                        <div class="stars-outer" title="<?= $ratingMonth."/10 Rating"?>">
                                                            <div class="stars-inner" style=" width:<?=$ratingMonth*10 . '%;'?>"></div>
                                                        </div>
<!--                                                        <strong><span class="ratingValue"><? $ratings[$value->id]['avgMonth'] ?></span></strong>
                                                        <span class="grey">/</span><span class="grey" itemprop="bestRating">10</span>          -->
                                                    </div>
                                                   <span class="medium ratingCount color-blue"><i class="fa fa-user"></i> <?= $ratings[$value->id]['totalReviewMonthly'] ?></span>
                                                </div>
                                                <div class="RatingOverAll">
                                                    <span>Over All</span>
                                                    <div class="ratingValue">
                                                        <div class="stars-outer" title="<?=$ratingOverAll."/10 Rating" ?>">
                                                            <div class="stars-inner" style=" width:<?= $ratingOverAll*10 . '%;' ?>"></div>
                                                        </div>
<!--                                                        <strong> <span class="ratingValue"><? $ratings[$value->id]['avgOverAll'] ?></span></strong>
                                                        <span class="grey">/</span>
                                                        <span class="grey" itemprop="bestRating">10</span>    -->
                                                    </div>
                                                    <span class="medium ratingCount color-blue"><i class="fa fa-user"></i> <?= $ratings[$value->id]['totalReviewOverAll'] ?> </span>
                                                </div>
                                                <div class="star-rating">
                                                    <button id="id_<?= $value->coin_id ?>" type="button" data-name='<?= $value->name ?>' <?php if ($this->session->userdata('userEmail') != '' && $ratings[$value->id]['rating_allow'] == 0) { ?>onclick="setModelTitle(this.id)"<?php } elseif ($this->session->userdata('userEmail') == '') { ?> onclick="document.location.href = '<?= base_url() . "login" ?>'"<?php } else { ?> onclick='alertMessage(this.id);' <?php } ?> >
                                                        <span class="star-rating-star no-rating"> </span>
                                                        <span class="star-rating-text">Rate This</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="column9">
                                            <a href="<?= base_url() . "discussions?coin=" . $value->id ?>">Comment</a>
                                        </td>
                                    </tr>  
                                    <?php
                                }
                            } else {
                                ?>
                            <div class="row">
                                <div class="col-md-12" style="    text-align: center;">
                                    <span class="alert alert-danger" style="margin: auto;"> No recourd Found!</span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                    <input type="hidden"  id="curentStart" value="51">
                    <?php if (!empty($results) && empty($search)) { ?>
                        <div class="ajax-load text-center" style="display:none">
                            <p>
                                <img alt="Brand" src="<?= base_url() . 'include/images/loader.gif' ?>">Loading More Data</p>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-md-12" style="    text-align: center;">
                        <span class="alert alert-danger" style="margin: auto;"> No recourd Found!</span>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span id="coinName"></span>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="container-fluid" style="background-color: #f3f3f3;">
                    <!-- RATING - Form -->
                    <form class="rating-form" action="review" method="POST" id="rating-form">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <legend class="form-legend">Rating:</legend>
                                    <div class="form-item">
                                        <input id="rating-10" name="rating" type="radio" value="10" />
                                        <label for="rating-10" data-value="10">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">10</span>
                                        </label>
                                        <input id="rating-9" name="rating" type="radio" value="9" />
                                        <label for="rating-9" data-value="9">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">9</span>
                                        </label>
                                        <input id="rating-8" name="rating" type="radio" value="8" />
                                        <label for="rating-8" data-value="8">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">8</span>
                                        </label>

                                        <input id="rating-7" name="rating" type="radio" value="7" />
                                        <label for="rating-7" data-value="7">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">7</span>
                                        </label>
                                        <input id="rating-6" name="rating" type="radio" value="6" />
                                        <label for="rating-6" data-value="6">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">6</span>
                                        </label>
                                        <input id="rating-5" name="rating" type="radio" value="5" />
                                        <label for="rating-5" data-value="5">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">5</span>
                                        </label>
                                        <input id="rating-4" name="rating" type="radio" value="4" />
                                        <label for="rating-4" data-value="4">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">4</span>
                                        </label>
                                        <input id="rating-3" name="rating" type="radio" value="3" />
                                        <label for="rating-3" data-value="3">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">3</span>
                                        </label>
                                        <input id="rating-2" name="rating" type="radio" value="2" />
                                        <label for="rating-2" data-value="2">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">2</span>
                                        </label>
                                        <input id="rating-1" name="rating" type="radio" value="1" />
                                        <label for="rating-1" data-value="1">
                                            <span class="rating-star">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="ir">1</span>
                                        </label>

                                        <div class="form-action">
                                            <input class="btn-reset form-control"  type="reset" value="Reset" />   
                                        </div>

                                        <div class="form-output">
                                            ? / 5
                                        </div>

                                    </div>

                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Name:</label>
                                    <input type="text" name="userName" value="<?= $this->session->userdata('userName') ?>" class="form-control">
                                </div>
                                <input type="hidden" name="userEmail" value="<?= $this->session->userdata('userEmail') ?>">
                                <input type="hidden" id="CoinNameInput" name="coinName" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Modal -->
<div id="myalertModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span id="coinNamealert"></span>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h4>Sorry! You have already rated this coin. Please come back after 24 hours.</h4>
                </div>
            </div>

        </div>

    </div>
</div>



<a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up"></i></a>

<script type="text/javascript">
//    var $j = jQuery.noConflict();
//     function setModelTitle(id)
//    {
//        var d = $('#' + id).data('name');
//        $('#coinName').text(d);
//        $('#CoinNameInput').val(d);
//        $('#myModal').modal();
//    }
</script>
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
<script type="text/javascript">
$('#rating-form').submit(function () {
        if ($('input:radio', this).is(':checked')) {
            // everything's fine...
        } else {
            alert('Please select Rating!');
            return false;
        }
    });

    function setModelTitle(id)
    {
        var d = $('#' + id).data('name');
        $('#coinName').text(d);
        $('#CoinNameInput').val(d);
        $('#myModal').modal();
    }
    function alertMessage(coinid)
    {
        var coinName = $('#' + coinid).data('name');
        $('#coinNamealert').text(coinName);
        $('#myalertModal').modal();
    }

    var page = 0;
<?php if (!empty($results) && empty($search)) { ?>
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
<?php } ?>


    function loadMoreData(page) {
//        alert("page" + page);$order = '';
//        $cloume = '';
        $.ajax({
            url: '<?php echo base_url() . "index.php/welcome/getAjaxData"; ?>',
            type: "POST",
            data: {page: page, col: '<?= $cloume ?>', ord: '<?= $order ?>', rand: Math.random()},
            beforeSend: function ()
            {
                $('.ajax-load').show();
            }
        })
                .done(function (data)
                {
                    if (data == " ") {
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("tbody").append(data);

                })
                .fail(function (jqXHR, ajaxOptions, thrownError)
                {
                    alert('server not responding...');
                });
    }
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
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
</script>
<script id="dsq-count-scr" src="//daily-crypto-ratings-1.disqus.com/count.js" async></script>
</body>
</html>