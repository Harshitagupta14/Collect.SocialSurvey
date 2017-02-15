<footer>
    <div class="container">

        <div class="row">
            <div class="col-sm-8 margin-20">
                <ul class="list-inline social">
                    <li>Connect with us on</li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>

            <div class="col-sm-4 text-right">
                <p><small>Copyright &copy; 2017. All rights reserved. <br>
                        Created by <a href="http://designscrazed.org/">Universal E-Solution PVt. Ltd.</a></small></p>
            </div>
        </div>

    </div>
</footer>


<!-- Javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?= $this->config->item('frontassets') ?>video-parralax/js/jquery-1.11.0.min.js"><\/script>')</script>
<script src="<?= $this->config->item('frontassets') ?>video-parralax/js/wow.min.js"></script>
<script src="<?= $this->config->item('frontassets') ?>video-parralax/js/bootstrap.min.js"></script>
<script src="<?= $this->config->item('frontassets') ?>video-parralax/js/main.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?= $this->config->item('frontassets') ?>video-parralax/js/modernizr.js"></script>
<script src="<?= $this->config->item('frontassets') ?>video-parralax/js/script.js?v1.1"></script>
<script>
    $(document).ready(function () {
        $('.header-video').each(function (i, elem) {
            headerVideo = new HeaderVideo({
                element: elem,
                media: '.header-video__media',
                playTrigger: '.header-video__play-trigger',
                closeTrigger: '.header-video__close-trigger'
            });
        });
    });
</script>
</body>
</html>