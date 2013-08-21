<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 11/08/13
 * Time: 01:23
 * To change this template use File | Settings | File Templates.
 */
include 'includes/header.php';
?>
<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img data-src="holder.js/1500x500/auto/#777:#7a7a7a/text:First slide" alt="">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-large btn-primary" href="/register">Créer votre compte dés aujourd'hui</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img data-src="holder.js/1500x500/auto/#777:#7a7a7a/text:Second slide" alt="">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Another example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img data-src="holder.js/1500x500/auto/#777:#7a7a7a/text:Third slide" alt="">
            <div class="container">
                <div class="carousel-caption">
                    <h1>One more for good measure.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-large btn-primary" href="#">Browse gallery</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->

<div class="container">

<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-4">
            <img class="img-circle" data-src="holder.js/140x140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="img-circle" data-src="holder.js/140x140">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="img-circle" data-src="holder.js/140x140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider" id="about">

    <div class="featurette">
        <img class="featurette-image img-circle pull-right" data-src="holder.js/512x512">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
    </div>

    <hr class="featurette-divider" id="tarifs">

    <div class="featurette-last">
        <h2 class="">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        <div class="row">
            <div class="col-lg-4">
                <div class="well">
                    <h2 class="muted">Silver</h2>
                    <p><span class="label">POPULAR</span></p>
                    <ul>
                        <li>10 users</li>
                        <li>Unlimited access</li>
                        <li>3TB of space</li>
                        <li>E-mail support</li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.</p>
                    <hr>
                    <h3>$15.99 / month</h3>
                    <hr>
                    <p><a class="btn btn-default btn-large" href="#"><i class="icon-ok"></i> Select plan</a></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="well">
                    <h2 class="text-warning">Bronze</h2>
                    <p><span class="label label-success">POPULAR</span></p>
                    <ul>
                        <li>20 users</li>
                        <li>Unlimited access with no limits</li>
                        <li>5TB of space</li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.</p>
                    <hr>
                    <h3>$10.99 / month</h3>
                    <hr>
                    <p><a class="btn btn-success btn-large" href="#"><i class="icon-ok"></i> Select plan</a></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="well">
                    <h2 class="text-info">Economy</h2>
                    <p><span class="label label-info">BUDGET</span></p>
                    <ul>
                        <li>10 users</li>
                        <li>5TB of space</li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.</p>
                    <hr>
                    <h3>$8.99 / month</h3>
                    <hr>
                    <p><a class="btn btn-info btn-large" href="#"><i class="icon-ok"></i> Select plan</a></p>
                </div>
            </div>
        </div>
    </div>

    <hr class="featurette-divider" id="contacts">

    <div class="featurette">
        <img class="featurette-image img-circle pull-left" data-src="holder.js/512x512">
        <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

<?php
include 'includes/footer.php';
?>