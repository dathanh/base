<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
            WebFont.load({
                google: {"families": ["Montserrat:400,500,600,700", "Noto+Sans:400,700"]},
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="/backend/assets/img/logo.gif.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="/backend/assets/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="/backend/assets/vendors/css/base/elisyam-1.5.min.css">
        <link rel="stylesheet" href="/backend/assets/css/animate/animate.min.css">
        <?= $this->fetch('customCss') ?>
    </head>
    <body id="page-top">
        Begin Preloader 
        <div id="preloader">
            <div class="canvas">
                <img src="/backend/assets/img/logo.gif.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <div class="page">
            <!-- Begin Header -->
            <?= $this->element('header') ?>
            <!-- End Header -->
            <!-- Begin Page Content -->
            <div class="page-content d-flex align-items-stretch">
                <?= $this->Content->leftMenuBackend() ?>
                <!-- End Left Sidebar -->
                <div class="content-inner">
                    <div class="container-fluid">
                        <?= $this->element('breadcrumb') ?>
                        <?= $this->fetch('content') ?>
                    </div>
                    <!-- End Container -->
                    <!-- Begin Page Footer-->
                    <?= $this->element('footer') ?>
                    <!-- End Page Footer -->
                    <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
                </div>
            </div>
            <!-- End Page Content -->
        </div>
        <?= $this->Flash->render() ?>
        <!-- Begin Vendor Js -->
        <script src="/backend/assets/vendors/js/base/jquery.min.js"></script>
        <script src="/backend/assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <!--clear scrollbar if it long-->
        <script src="/backend/assets/vendors/js/nicescroll/nicescroll.min.js"></script>
        <script src="/backend/assets/vendors/js/noty/noty.min.js"></script>
        <?= $this->fetch('customJs') ?>
        <!--clear scrollbar if it long-->
        <script src="/backend/assets/vendors/js/app/app.min.js"></script>
        <!-- Begin Page Snippets -->
        <script src="/backend/js/underscore.js"></script>
        <script src="/backend/js/common.js"></script>
        <!-- End Page Snippets -->
        <!-- End Page Vendor Js -->
        <!-- Begin Page Snippets -->
        <!-- End Page Snippets -->
    </body>
</html>