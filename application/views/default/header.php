<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="utf-8">
        <title>Snow Landing Page Theme </title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <meta property="og:title" content="">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:site_name" content="">
        <meta property="og:description" content="">

        <!-- Styles -->
        <link rel="stylesheet" href="<?= $this->config->item('frontassets') ?>video-parralax/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= $this->config->item('frontassets') ?>video-parralax/css/animate.css">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900|Montserrat:400,700' rel='stylesheet' type='text/css'>


        <link rel="stylesheet" href="<?= $this->config->item('frontassets') ?>video-parralax/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= $this->config->item('frontassets') ?>video-parralax/css/main.css">

        <script src="<?= $this->config->item('frontassets') ?>video-parralax/js/modernizr-2.7.1.js"></script>
        <style>
            .header-video {
                position: relative;
                overflow: hidden;
            }

            .header-video iframe,
            .header-video video {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }

            .header-video iframe {
                height: 100%;
                width: 100%;
            }

            .header-video video {
                width: 100%;
            }

            .header-video__teaser-video {
                width: 100%;
                height: auto;
            }

            .header-video__media {
                width: 100%;
                height: auto;
            }
        </style>
    </head>