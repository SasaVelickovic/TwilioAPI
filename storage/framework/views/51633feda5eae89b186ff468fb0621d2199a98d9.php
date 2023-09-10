<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>Bulk SMS Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Pet Store Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('back/assets/images/sms.svg')); ?>">

    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('back/assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('back/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('back/assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
<?php echo $__env->yieldContent('styles'); ?>
</head>

<body data-sidebar="dark">

<!-- Begin page -->
<div id="layout-wrapper">


    <!-- ========== Header ========== -->
    <?php echo $__env->make('back.inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Header -->
    <!-- ========== Left Sidebar Start ========== -->
    <?php echo $__env->make('back.inc.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

       <?php echo $__env->yieldContent('content'); ?>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © REIFuze.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

 <!-- twilio-call-controls form. This will be hidden -->
 <main id="controls" class="d-none">
      <section class="left-column" id="info">
        <h2>Your Device Info</h2>
        <div id="client-name"></div>
            <div id="output-selection" class="hide">
            <label>Ringtone Devices</label>
            <select id="ringtone-devices" multiple></select>
            <label>Speaker Devices</label>
            <select id="speaker-devices" multiple></select
            ><br />
            <button id="get-devices">Seeing "Unknown" devices?</button>
            </div>
      </section>
      <section class="center-column">
        <h2 class="instructions">Make a Call</h2>
        <div id="call-controls" class="hide">
            <label for="phone-number"
              >Enter a phone number or client name</label
            >
            <input id="phone-number" type="text" placeholder="+15552221234" />
            <button id="button-call" type="submit">Call</button>
          
          
          <div id="volume-indicators" class="hide">
            <label>Mic Volume</label>
            <div id="input-volume"></div>
            <br /><br />
            <label>Speaker Volume</label>
            <div id="output-volume"></div>
          </div>
        </div>
      </section>
      <section class="right-column">
        <h2>Event Log</h2>
        <div class="hide" id="log"></div>
      </section>
    </main>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="<?php echo e(asset('back/assets/libs/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('back/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('back/assets/libs/metismenu/metisMenu.min.js')); ?>"></script>
<script src="<?php echo e(asset('back/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
<script src="<?php echo e(asset('back/assets/libs/node-waves/waves.min.js')); ?>"></script>

<!-- apexcharts -->


<!-- Saas dashboard init -->


<script src="<?php echo e(asset('back/assets/js/app.js')); ?>"></script>
<script src="<?php echo e(asset('back/assets/js/pages/twilio.min.js')); ?>"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH /home4/bbagnall/public_html/bulk/test/bulk_sms/resources/views/back/inc/master.blade.php ENDPATH**/ ?>