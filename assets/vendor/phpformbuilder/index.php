<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP Form Builder - Bootstrap Form Generator - 20+ jQuery plugins</title>
<meta name="description" content="PHP Form Builder is a PHP Class to create any Bootstrap, Material Design and Foundation form. Add any plugin with a single line of code: datepicker, file uploader, recaptcha, ...">
<meta name="author" content="Gilles Migliori">
<meta name="copyright" content="Gilles Migliori">
<meta name="msvalidate.01" content="E3AF40C058E0C40A855426AF92C86F46" />
<link rel="canonical" href="https://www.phpformbuilder.pro/" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
<link rel="preload" href="documentation/assets/stylesheets/pace-theme-minimal.min.css" as="style" onload="this.rel='stylesheet'">
<link rel="preload" href="documentation/assets/stylesheets/bootstrap.css" as="style" onload="this.rel='stylesheet'">
<link rel="preload" href="documentation/assets/stylesheets/project.css" as="style" onload="this.rel='stylesheet'">
<link rel="preload" href="documentation/assets/stylesheets/prism.min.css" as="style" onload="this.rel='stylesheet'">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet">
<noscript>
    <link rel="stylesheet" href="documentation/assets/stylesheets/pace-theme-minimal.min.css" media="screen">
    <link rel="stylesheet" href="documentation/assets/stylesheets/bootstrap.css" media="screen">
    <link rel="stylesheet" href="documentation/assets/stylesheets/project.css" media="screen">
    <link rel="stylesheet" href="documentation/assets/stylesheets/prism.min.css" media="screen">
</noscript>
<script>
    /*! loadCSS rel=preload polyfill. [c]2017 Filament Group, Inc. MIT License */
    !function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(t){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){var e=t.media||"all";function a(){t.media=e}t.addEventListener?t.addEventListener("load",a):t.attachEvent&&t.attachEvent("onload",a),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(a,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
</script>
<script type='application/ld+json'>
{
    "@context": "http://www.schema.org",
    "@type": "WebPage",
    "name": "PHP Form Builder",
    "image": "https://www.phpformbuilder.pro/documentation/assets/images/phpformbuilder-preview.png",
    "description": "PHP Form Builder - Form Generator including 20+ jQuery plugins, Live validation + Server-side validation, Email and Database features.",
    "aggregateRating": {
        "@type": "aggregateRating",
        "ratingValue": "4.82",
        "reviewCount": "158"
    }
}

</script>
<script type='application/ld+json'>
{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "Miglisoft",
    "url": "https://www.miglisoft.com",
    "logo": "https://www.miglisoft.com/assets/images/migli-logo.png",
    "sameAs": [
        "https://www.facebook.com/miglicodecanyon/",
        "https://twitter.com/miglisoft",
        "https://plus.google.com/+GillesMiglioriMigli",
        "https://www.linkedin.com/in/gilles-migliori-ab661626/"
    ]
}

</script>
<!-- adaptative-images -->
<script>
document.cookie = 'resolution=' + Math.max(screen.width, screen.height) + ("devicePixelRatio" in window ? "," + devicePixelRatio : ",1") + '; path=/';

</script>
</head>

<body style="padding-top:76px;" data-spy="scroll" data-target="#navbar-left-wrapper" data-offset="180">
    <!-- Main navbar -->
    <nav id="website-navbar" class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
        <div class="container-fluid px-0">
            <a class="navbar-brand mr-3" href="index.html"><img src="documentation/assets/images/phpformbuilder-logo.png" width="60" height="60" class="mr-3" alt="PHP Form Builder" title="PHP Form Builder">PHP Form Builder</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">

                    <!-- https://www.phpformbuilder.pro navbar -->

                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.html">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="documentation/wordpress-cms-users.html">Wordpress &amp; CMS users</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="documentation/quick-start-guide.html">Quick Start Guide</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="templates/index.php">Form Templates</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="documentation/plugins.php">Plugins</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="documentation/code-samples.php">Code Samples</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="documentation/class-doc.html">Class Doc.</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="documentation/functions-reference.html">Functions Reference</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="documentation/help-center.html">Help Center</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main sidebar -->
    <div class="navbar-light p-2 d-lg-none d-xlg-none">
        <button id="navbar-left-toggler" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
    </div>
    <div id="navbar-left-wrapper" class="w3-animate-left">
        <a href="#" id="navbar-left-collapse" class="d-inline-block d-lg-none d-xlg-none float-right text-white p-4"><i class="fas fa-times"></i></a>
        <ul id="navbar-left" class="nav nav-pills flex-column pt-1 mb-4" role="tablist" aria-orientation="vertical">
            <li class="nav-item"><a class="nav-link active" href="#overview">Overview</a></li>
            <li class="nav-item"><a class="nav-link" href="#package-structure">Package structure</a></li>
            <li class="nav-item"><a class="nav-link" href="#where-to-start">Where to start ?</a></li>
            <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
            <li class="nav-item"><a class="nav-link" href="#themes">Themes</a></li>
            <li class="nav-item"><a class="nav-link" href="#upgrade-phpformbuilder">Upgrade PHP Form Builder</a></li>
            <li class="nav-item"><a class="nav-link" href="#changelog">Changelog</a></li>
            <li class="nav-item"><a class="nav-link" href="#credits">Sources &amp; Credits</a></li>
            <li class="nav-item"><a class="nav-link" href="#miglisoft">Other Projects</a></li>
            <li class="nav-item"><a class="nav-link" href="#subscribe">Stay tuned (<small>Mailing List</small>)</a></li>

        </ul>
        <div class="text-center mb-xs"><a href="//www.dmca.com/Protection/Status.aspx?ID=93cc7d61-a9d4-4474-a327-a29620d661fb" title="DMCA.com Protection Status" class="dmca-badge"> <img src="//images.dmca.com/Badges/dmca-badge-w100-1x1-01.png?ID=93cc7d61-a9d4-4474-a327-a29620d661fb" alt="DMCA.com Protection Status"></a> <script defer src="//images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script></div>
        <div class="text-center">
            <a href="https://www.hack-hunt.com" title="Send DMCA Takedown Notice" class="text-white">www.hack-hunt.com</a>
        </div>
        <!-- navbar-left -->
    </div>
    <!-- /main sidebar -->

    <div class="container">
        <section class="py-6">
            <div class="w-100 px-2 d-flex justify-content-between align-items-center">
                <a href="https://1.envato.market/c/1261532/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fphp-form-builder%2F8790160" class="btn btn-danger text-white">Buy PHP Form Builder<span class="icon-circle ml-2 bg-white"><i class="fas fa-dollar-sign text-danger"></i></span></a>
                <form id="siq_searchForm">
                     <input type="search" placeholder="Type here to search..." value="" name="s" class="form-control" />
                </form>
            </div>
        </section>

        <section>
            <h1>Welcome to PHP Form Builder<br><small class="text-muted">PHP Form Generator Class - Save tons of programming hours</small></h1>
            <p class="lead">PHP Form Builder is a complete library that is based on a PHP class, allowing you to program any kind of form and layout them using some simple functions.</p>
            <a href="https://1.envato.market/c/1261532/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fphp-form-builder%2F8790160">
                <img src="https://www.phpformbuilder.pro/assets/images/phpformbuilder-mockup-small.jpg" class="img-thumbnail img-responsive" alt="PHP Form Builder preview">
            </a>
            <p>PHP Form Builder is conceived for use with the most popular frameworks: Bootstrap 4, Bootstrap 3, Material Design, Foundation and can be configured for any other use.</p>
            <p>It allows you to build any form from scratch or by customizing one of the 120+ templates provided</p>
            <p class="mb-5">Optimized for very fast loading and maximum security.</p>
            <ul class="inline-list mb-5">
                <li class="w-50">20<sup>+</sup> jQuery plugins</li>
                <li class="w-50">160<sup>+</sup> Form Templates</li>
                <li class="w-50">Live validation</li>
                <li class="w-50">Server side validation</li>
                <li class="w-50">Email sending</li>
                <li class="w-50">customizable html/css email templates</li>
                <li class="w-50">Database recording</li>
                <li class="w-50"><strong>Bootstrap 4</strong> Forms</li>
                <li class="w-50"><strong>Bootstrap 3</strong> Forms</li>
                <li class="w-50"><strong>Material Design</strong> Forms</li>
                <li class="w-50"><strong>Foundation Forms</strong></li>
                <li class="w-50">Contact Forms</li>
                <li class="w-50">Login Forms</li>
                <li class="w-50">Step Forms</li>
                <li class="w-50">Modal Forms</li>
                <li class="w-50">Popover Forms</li>
                <li class="w-50">Dynamic fields</li>
                <li class="w-50">Highly customizable layouts</li>
                <li class="w-50">Icons, tooltips &amp; helpers</li>
                <li class="w-50">Image picker</li>
                <li class="w-50">Date picker</li>
                <li class="w-50">Timepicker</li>
                <li class="w-50">Tinymce</li>
                <li class="w-50">Recaptcha V2</li>
                <li class="w-50">Invisible Recaptcha</li>
                <li class="w-50">Bootstrap Select plugin</li>
                <li class="w-50">ICheck jQuery checkbox plugin</li>
                <li class="w-50">Conditional fields</li>
                <li class="w-50">Color picker</li>
                <li class="w-50">File uploader</li>
                <li class="w-50">... and a lot more</li>
            </ul>
            <div class="text-center mb-5">
                <h3><i class="material-icons left pink-text">favorite</i>Loved by <strong class="pink-text">2000<sup>+</sup></strong> users</h3>
                <h3 class="mb-5"><i class="material-icons amber-text">star</i><i class="material-icons amber-text">star</i><i class="material-icons amber-text">star</i><i class="material-icons amber-text">star</i><i class="material-icons amber-text left">star</i> 5 stars rating on <a href="https://codecanyon.net/item/php-form-builder/8790160?ref=migli">Codecanyon</a> (130+ ratings)</h3>
                <a href="https://1.envato.market/c/1261532/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fphp-form-builder%2F8790160" class="btn btn-primary btn-lg">Buy PHP Form Builder Now</a>
            </div>
        </section>
    </div>
















    <div class="container">
        <div class="row">

            <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                <p>&nbsp;</p>

                <section>
                    <h2 class="mb-5">Customer Reviews</h2>
                    <div id="google-reviews"></div>
                </section>
                <!-- Overview -->
                <section>
                    <h2 id="overview">Overview</h2>
                    <p>PHP Form Builder is a simple but powerful PHP Form class with which you can create complex forms easily.</p>
                    <p>PHP Form Builder is ready to use with <a href="#themes">Bootstrap, Foundation and Material Design themes</a>, but can be easily adapted for other frameworks or as standalone.
                        <br>All you need is to match <a href="documentation/class-doc.html#options-overview">Form options</a> with your framework.</p>
                    <p>Documentation is well-adapted for all types of users: PHP beginners as well as confirmed programmers.</p>
                    <p class="text-danger"><strong>Please see <a href="#where-to-start">Where to start ?</a> section to find the best place to start depending on your skills.</strong></p>
                    <div id="buyer-contact" class="mb-lg">
                        <h4 class="mt-lg">For any question or request</h4>
                        <p>Please </p>
                        <ul>
                            <li>Take a look at the <a href="documentation/help-center.html">Help Center</a></li>
                            <li>Contact me through <a href="http://codecanyon.net/item/php-form-builder/8790160/comments">PHP Form Builder's comments on Codecanyon</a></li>
                            <li>E-mail me at <a href="https://www.miglisoft.com/#contact">https://www.miglisoft.com/#contact</a></li>
                            <li>Chat on <a href="https://www.phpformbuilder.pro">www.phpformbuilder.pro</a></li>
                        </ul>
                        <div class="alert alert-warning has-icon">
                            <p><strong>If you feel lost or have any trouble, please contact me before dropping any rating</strong></p>
                            <ul>
                                <li>I can build you a form for free, or for a small fee if your form is really complex</li>
                                <li>I can propose a refund if PHP Form Builder doesn't match what you intended</li>
                            </ul>
                        </div>
                    </div>
                    <div id="home-overview-features">
                        <div class="row">
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Build Bootstrap Forms</h4>
                                <p class="text-justify grey-text">PHP Form Builder's default settings are Bootstrap ready.</p>
                                <p class="text-justify grey-text">PHP Form Builder is fully compatible with Both
                                    <br><strong>Bootstrap 4</strong> and <strong>Bootstrap 3</strong>.</p>
                            </div>
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Build Material Forms</h4>
                                <p class="text-justify grey-text">Material forms are part of PHP Form Builder's package.
                                    <br>Switch from Bootstrap to Material with a single line of code.</p>
                            </div>
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Build Foundation Forms</h4>
                                <p class="text-justify grey-text">Foundation now added to PHP Form Builder's package.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Build Standalone Forms</h4>
                                <p class="text-justify grey-text">PHP Form Builder can adapt generated html to any framework,
                                    <br>or generate simple standard HTML5 elements.</p>
                            </div>
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">120<sup>+</sup> Form Templates</h4>
                                <p class="text-justify grey-text">Each template is given with code you can easily copy / paste.
                                    <br>Code includes Live &amp; Server side Validation and Email sending</p>
                            </div>
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Email Sending</h4>
                                <p class="text-justify grey-text">Built-in function to send posted values easily.
                                    <br>Support for attachments and Custom E-Mail templates</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Easy Contact Form</h4>
                                <p class="text-justify grey-text">Shortcut function to build contact form in 2 minutes</p>
                            </div>
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Powerful jQuery plugins integration</h4>
                                <p class="text-justify grey-text">Don't waste your time to include css &amp; js files, generate js code, ...
                                    <br>PHP Form Builder will add any jQuery plugin in a very easy way and do all this job for you.</p>
                            </div>
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">20<sup>+</sup> jQuery plugins included</h4>
                                <p class="text-justify grey-text">Best jQuery Form plugin included in package and ready to use to enhance your forms with file uploader, custom radio, checkboxes, select, pickers (date, time, color), captcha, ...</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Maximum Security</h4>
                                <p class="text-justify grey-text">Automatic XSS and CSRF protection - maximum level security</p>
                            </div>
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Server-side validation</h4>
                                <p class="text-justify grey-text">Validate any field with any condition.
                                    <br>Your page will automagically scroll to user error if fields are not filled correctly.</p>
                            </div>
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Conditional logic</h4>
                                <p class="text-justify grey-text">Show / Hide fields depending on user's choices
                                    <br>One easy function for all logic. Conditional fields can be nested.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-4 mb-5">
                                <h4 class="h4 has-icon has-icon-success">Special forms</h4>
                                <p class="text-justify grey-text">Ajax forms, Step forms, Modal forms, Popover forms, Accordion forms: Simple and easy integration with templates and full documentation.</p>
                            </div>
                            <div class="col-xs-12 col-md-8 mb-5">
                                <h4 class="h4 has-icon has-icon-success">- Fast &amp; Efficient Professional Support -</h4>
                                <p class="text-justify grey-text">We take care of each customer
                                    <br>and do our best to give efficient help.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!--=======================================
                =            START COMMON PART            =
                ========================================-->

                <!-- License and Registration -->
                <section>
                    <h2 id="license-registration">License and Registration</h2>
                    <h3>License</h3>
                    <p class="alert alert-info has-icon">1 License = 1 project</p>
                    <p>If you want to use PHP Form Builder on several websites you've got to buy a new license for each one.</p>
                    <h4>Standard license vs. extended license</h4>
                    <ul class="mb-5">
                        <li>If you use PHP Form Builder for a personal project or for a work (ie: website) sold to a single client, a standard license is sufficient.</li>
                        <li>If you include PHP Form Builder into a sold package (ie: theme, plugin) you must purchase an extended license and <a href="https://www.miglisoft.com/#contact">contact me</a> to have my agreement.</li>
                    </ul>
                    <h3>Registration</h3>
                    <p><strong>Before using PHP Form Builder you must <a href="documentation/quick-start-guide.html#registration" title="register your copy">register your copy</a>.</strong></p>
                    <p>Registration is for lifetime &amp; just have to be done once for each installation (localhost/production server).</p>
                    <div class="alert alert-info has-icon">
                        <p>If you change your installation directory:</p>
                        <ol>
                            <li>open <code class="language-php">phpformbuilder/register.php</code> to unregister your copy</li>
                            <li>move your folders where you want to</li>
                            <li>open <code class="language-php">phpformbuilder/register.php</code> to register your new path</li>
                        </ol>
                    </div>
                </section>
                <!-- Package Structure -->
                <section>
                    <h2 id="package-structure">Package Structure</h2>
                    <p>PHP Form Builder's package includes the Form Builder itself, the documentation and all the templates.</p>
                    <p class="alert alert-warning has-icon">You don't have to upload all the files and folders on your production server.</p>
                    <p><strong>Documentation and Templates are available online at <a href="https://www.phpformbuilder.pro/">https://www.phpformbuilder.pro/</a>.<br>There's no need to upload them on your production server.</strong></p>
                    <p class="lead pink-text"><strong>You only have to upload the following directories on your server:</strong></p>
                    <div class="tree">
                        <ul>
                            <li><a href="#" class="folder">your-project-root</a>
                                <ul>
                                    <li><a href="#" class="folder">assets</a> <span class="text-muted left">Contains images used in some email templates</span></li>
                                    <li><a href="#" class="folder">file-uploads</a> <span class="text-muted left">Upload folder used with the file upload plugin</span></li>
                                    <li><a href="#" class="folder">phpformbuilder</a> <span class="text-muted left">Main form builder files including all the plugins</span></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <ul>
                        <li>The <em>assets</em> folder is not required if you don't use the styled email templates</li>
                        <li>The <em>file-uploads</em> folder is not required if you don't use the <em>file-upload</em> plugin or choose to upload your files elsewhere</li>
                    </ul>
                    <h3>The <em>phpformbuilder</em> folder structure</h3>
                    <div class="tree">
                        <ul>
                            <li><a href="#" class="folder">your-project-root</a>
                                <ul>
                                    <li>
                                        <a href="#" class="folder">phpformbuilder</a> <span class="text-muted left">Main form builder files including all the plugins</span>
                                        <ul>
                                            <li><a href="#" class="folder">database</a> <span class="text-muted left">Contains Mysql class. Not required if you have no database.</span></li>
                                            <li><a href="#" class="folder">mailer</a> <span class="text-muted left">Contains <em>phpmailer</em> class, the email templates and utilities to sanitize the emails contents and inline the emails css.</span></li>
                                            <li><a href="#" class="folder">plugins</a> <span class="text-muted left">Contains all the plugins. You can remove the ones you don't use in your forms.</span></li>
                                            <li><a href="#" class="folder">plugins-config</a> <span class="text-muted left">Contains all the plugins configuration files ("domready" codes stored into xml files). You can remove the ones you don't use in your forms.</span></li>
                                            <li><a href="#" class="folder">plugins-config-custom</a> <span class="text-muted left">Empty folder to store your plugin configurations files if you customize.</span></li>
                                            <li><a href="#" class="folder">Validator</a> <span class="text-muted left">PHP Validation class.</span></li>
                                            <li><a href="#" class="file">Form.php</a> <span class="text-muted left">PHP Form Builder's main class.</span></li>
                                            <li><a href="#" class="file">FormatHtml.php</a> <span class="text-muted left">PHP Class to beautify HTML output code</span></li>
                                            <li><a href="#" class="file">FormExtended.php</a> <span class="text-muted left">Extends PHP Form Builder's main class with useful shortcut functions.</span></li>
                                            <li><a href="#" class="file">register.php</a> <span class="text-muted left">required to register & activate your PHP Form Builder copy..</span></li>
                                            <li><a href="#" class="file">server.php</a> <span class="text-muted left">file used for debugging purpose if you encounter paths issues on your server.</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- Where to start ? -->
                <section>
                    <h2 id="where-to-start">Where to start ?</h2>
                    <p class="lead">Depending on your php knowledge:</p>
                    <article>
                        <h3>PHP Beginners</h3>
                        <dl class="dl-horizontal">
                            <dt><a href="documentation/beginners-guide.html" class="btn btn-primary">Beginners Guide</a></dt>
                            <dd>Tutorial for PHP beginners including full detailed explanations</dd>
                        </dl>
                        <h3>PHP Programmers</h3>
                        <dl class="dl-horizontal">
                            <dt><a href="documentation/quick-start-guide.html" class="btn btn-primary">Quick start Guide</a></dt>
                            <dd>Quick and easy start with minimum required.</dd>
                        </dl>
                        <h3>About functions and how to</h3>
                        <dl class="dl-horizontal">
                            <dt><a href="documentation/class-doc.html" class="btn btn-primary">Class documentation</a></dt>
                            <dd>Full class documentation.</dd>
                            <dd class="line-break"></dd>
                            <dt><a href="documentation/code-samples.php" class="btn btn-primary">Code Samples</a></dt>
                            <dd>F.A.Q. with code examples to help with layout, icons, plugins, dependent fields and so on.</dd>
                            <dd class="line-break"></dd>
                            <dt><a href="documentation/functions-reference.html" class="btn btn-primary">Functions reference</a></dt>
                            <dd>All functions &amp; arguments.</dd>
                        </dl>
                        <h3>Build a fully-working contact form in 2 minutes without any knowledge</h3>
                        <dl class="dl-horizontal">
                            <dt><a href="documentation/contact-form-in-2-minutes.php" class="btn btn-primary">Contact form in 2 minutes</a></dt>
                            <dd>If you don't want to learn, just want a working contact form.</dd>
                        </dl>
                    </article>
                </section>
                <!-- Features -->
                <section>
                    <h2 id="features">Features</h2>
                    <ul>
                        <li>
                            <p>Form generation with complex layout capabilities (horizontal, vertical, inline)
                                <br>PHP Form Builder generates clean HTML5 markup, with separates functions to render form, generate CSS and JS code, so you can render them separately (generaly in &lt;head&gt; or just before &lt;/body&gt;).</p>
                        </li>
                        <li>
                            <p>Bootstrap 4 Forms, Bootstrap 3 Forms, Material Design Forms, Compatible with any framework or can be used as Standalone.</p>
                        </li>
                        <li>
                            <p>Accepts any HTML5 form elements, including fieldsets, multiple selects, optgroups, button groups, ...</p>
                        </li>
                        <li>
                            <p>Allows to customize HTML with wrappers, IDs, classes and attributes, Javascript events, custom code almost anywhere.</p>
                        </li>
                        <li>
                            <p>Server-side validation can be done on any destination page ; errors are stored in session</p>
                        </li>
                        <li>
                            <p>Send your emails with simple or advanced function - detects and replaces posted values in default or custom html/css template. Uses PHPMailer and Emogrifier to inline css.</p>
                        </li>
                        <li>
                            <p>XSS / CSRF Protection</p>
                        </li>
                        <li>
                            <p>Database class included to easily prefill fields with values from your database, Insert/Update/Delete elements using posted values.</p>
                        </li>
                        <li>
                            <p><strong>Numerous jQuery plugins included:</strong></p>
                            <ul class="inline-list">
                            </ul>
                            <p><strong>Checkboxes &amp; Selects</strong></p>
                            <ul class="inline-list">
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#select2-example">Select2</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#bootstrap-select-example-redirect">Bootstrap Select</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#icheck-example">iCheck</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#nice-check-example">Nice Check</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#lcswitch-example">LC-Switch</a></li>
                            </ul>
                            <p><strong>Pickers</strong></p>
                            <ul class="inline-list">
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#colorpicker-example">Colorpicker</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#datepicker-example">Datepicker</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#timepicker-example">Timepicker</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#pickadate">Pickadate</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#pickadate-material">Pickadate for Material Design</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#image-picker">Image picker</a></li>
                            </ul>
                            <p><strong>Validation &amp; Captcha</strong></p>
                            <ul class="inline-list">
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#jquery-validation-getting-started">Formvalidation</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#recaptcha-example">Recaptcha V2</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#invisible-recaptcha-example">Invisible Recaptcha</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#captcha-example">Captcha</a></li>
                            </ul>
                            <p><strong>Modal &amp; Popover</strong></p>
                            <ul class="inline-list">
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#modal-example">Modal</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#popover-example">Popover</a></li>
                            </ul>
                            <p><strong>Uploaders</strong></p>
                            <ul class="inline-list">
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#fileupload">File Upload</a></li>
                            </ul>
                            <p><strong>Text Editors</strong></p>
                            <ul class="inline-list">
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#tinymce-example">Tinymce</a></li>
                            </ul>
                            <p><strong>Others</strong></p>
                            <ul class="inline-list">
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#autocomplete-example">Autocomplete</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#startDependentFields">Dependent Fields</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#intl-tel-input-example">Intl Tel Input (International Phone Numbers)</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#passfield-example">Passfield</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#tooltip-example">Tooltip</a></li>
                                <li class="w-50"><a class="white-text bg-primary display-block pad-5" href="documentation/class-doc.html#wordcharactercount-example">Wordcharactercount</a></li>
                            </ul>
                        </li>
                        <li>
                            <p>Memorization / recall of any custom configuration for each plugin</p>
                        </li>
                        <li>
                            <p>You can easily add any other external plugin (see <a href="documentation/class-doc.html#plugins">plugins</a> section).
                                <br>When you activate a plugin, the needed css and js files will be automaticaly added to your page.</p>
                        </li>
                        <li>
                            <p><a href="https://github.com/migliori/sublime-phpformbuilder">Sublime-text 3 plugin</a> available on Github</p>
                        </li>
                        <li>
                            <p><a href="https://github.com/chuyik/brackets-snippets">Bracket plugin</a> available on Github</p>
                        </li>
                    </ul>
                </section>
                <!-- Themes (Frameworks) -->
                <section>
                    <h2 id="themes">Themes (Frameworks)</h2>
                    <h3>Bootstrap 3</h3>
                    <p>Default'theme is Bootstrap 3.</p>
                    <p>All options are ready to use, and will generate all Bootstrap's markup and classes.</p>
                    <h3>Bootstrap 4</h3>
                    <p>Create your forms with Bootstrap 4 markup and classes.</p>
                    <h3>Foundation</h3>
                    <p>Create your forms with Foundation markup and classes.</p>
                    <h3>Material Design</h3>
                    <p>Material Design forms are based on Bootstrap 3.</p>
                    <p>Markup and options are <strong>exactly the same for both</strong>.</p>
                    <p>To switch from Bootstrap to Material Design, just <a href="documentation/class-doc.html#material-design">add bootstrap-material-design plugin</a></p>
                </section>
                <!-- Upgrade PHP Form Builder -->
                <section>
                    <h2 id="upgrade-phpformbuilder">Upgrade PHP Form Builder</h2>
                    <ol class="mb-5">
                        <li>Backup your <code class="language-php">phpformbuilder</code> folder</li>
                        <li>Replace your old <code class="language-php">phpformbuilder</code> folder with the new one</li>
                        <li>Copy your <code class="language-php">license.php</code> from your old installation to the new one</li>
                        <li>Copy your <code class="language-php">phpformbuilder/database/db-connect.php</code> from your old installation to the new one</li>
                        <li>If you customized the following files/folders, copy them from your old installation to the new one:
                            <ul>
                                <li><code class="language-php">phpformbuilder/mailer/email-templates-custom</code></li>
                                <li><code class="language-php">phpformbuilder/plugins-config-custom</code></li>
                                <li><code class="language-php">phpformbuilder/FormExtended.php</code></li>
                            </ul>
                        </li>
                    </ol>
                    <hr>
                    <h3>Upgrade from V 2.x to V 3.x</h3>
                    <p>More efficient &amp; simple than ever, this release contains some code simplifications, new features and new syntax to send emails.</p>
                    <p><strong>All V 2.x features are still available using old V 2.x syntax, except for email sending.</strong></p>
                    <p><code>sendMail()</code> and <code>sendAdvancedMail()</code> functions have been merged into a single <code>sendMail()</code> function (see details below)</p>
                    <p>&nbsp;</p>
                    <h4>Plugins path</h4>
                    <p>No need to setup plugins path anymore (it's now automagically detected).
                        <br>(phpformbuilder/plugins-path.php has been removed)</p>
                    <p>&nbsp;</p>
                    <h4>Server-side validation</h4>
                    <p>No need to include Validator files
                        <br>Required fields can now be validated automagically</p>
                    <pre><code class="language-php">
    /* OLD CODE V 2.x */

    include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpformbuilder/Validator/Validator.php';
    include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpformbuilder/Validator/Exception.php';
    $validator = new Validator($_POST);
    $required = array('user-name', 'user-first-name', 'user-email', 'user-phone', 'message');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->maxLength(100)->validate('message');
    $validator->email()->validate('user-email');

    /* NEW CODE V 3.x */

    // create validator &amp; auto-validate required fields
    $validator = Form::validate('contact-form-1');

    // additional validation
    $validator->maxLength(100)->validate('message');
    $validator->email()->validate('user-email');
</code></pre>
                    <p>&nbsp;</p>
                    <h4>Email sending</h4>
                    <p>SendMail() function has now full capabilities to send attachments, add cc/bcc and a lot more.
                        <br>See <a href="documentation/class-doc.html#sendMail"></a> for complete features list.</p>
                    <pre><code class="language-php">
    /* OLD CODE V 2.x */

    $from_email = 'contact@phpformbuilder.pro';
    $adress = addslashes($_POST['user-email']);
    $subject = 'phpformbuilder - Contact Form 1';
    $filter_values = 'contact-form-1, submit-btn, token';
    $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);

    /* NEW CODE V 3.x */

    $email_config = array(
        'sender_email'    => 'contact@phpformbuilder.pro',
        'sender_name'     => 'PHP Form Builder',
        'recipient_email' => addslashes($_POST['user-email']),
        'subject'         => 'PHP Form Builder - Contact Form',
        'filter_values'   => 'contact-form-1'
    );
    $sent_message = Form::sendMail($email_config);</code></pre>
                </section>
                <!-- Changelog -->
                <section>
                    <h2 id="changelog">Changelog</h2>
                    <!-- A PUBLIER
<h4>version 3.6.2 (08/2018)</h4>
<pre><code class="language-php">
New Features:
        - new Material forms - use with Bootstrap 4 OR materialize framework as standalone
          more informations: https://www.phpformbuilder.pro/documentation/class-doc.html#frameworks
        - new material-datepicker plugin for Material forms + Bootstrap 4 forms
        - add Select2 Material theme
        - new adAddon function to add button & text addons to input & select dropdowns
        - add templates with addons examples: phpformbuilder/templates/[framework]/input-with-addons.php
        - update Bootstrap Select plugin to latest - now compatible with Bootstrap 4
Improvements:
        - remove the smtp option from sendMail function
            now smtp is automatically enabled when $smtp_settings are filled.
Bug Fix:
        - solve plugins URL detection with paths containing uppercase letters
        - update Emogrifier to latest version 2.0 (email inline css)
        - edit phpformbuilder/mailer/phpmailer/extras/htmlfilter.php to remove php7 warning
Misc.:
        - remove the old Material Design forms based on Bootstrap 3 + old version of Materialize
        - remove deprecated templates which used the deprecated jQuery File Upload plugin
        - remove deprecated jQuery File Upload plugin
</code></pre>
END A PUBLIER -->
                    <h4>version 3.6.2 (08/2018)</h4>
<pre><code class="language-php">
Improvements:
        - update server-side validation functions to accept empty values,
            except for the validators whose internal logic make values required.
            Details available here: https://www.phpformbuilder.pro/documentation/class-doc.html#php-validation-methods
Bug Fix:
        - fix licensing system timeshift issue
        - fix invalid feedback message with iCheck + bs4
        - fix Ladda plugin behaviour with grouped buttons
</code></pre>
                    <h4>version 3.6.1 (07/2018)</h4>
<pre><code class="language-php">
Improvements:
        - improve html parsing
        - disable onload live validation
        - improve dynamic fields template 2 behaviour
        - improve dependent fields selectors parsing with regex
Bug Fix:
        - fix centered button groups with Foundation grid
</code></pre>
                    <h4>version 3.6 (06/2018)</h4>
<pre><code class="language-php">
New Features:
        - add required registration
        - add LC-Switch plugin
Improvements:
        - update documentation
        - update PHPMailer to latest (6.0.5) - (wrong version numbers in src files, same issue in PHPMailer github)
</code></pre>
                    <h4>version 3.5.2 (05/2018)</h4>
<pre><code class="language-php">
Improvements:
        - Add support for PHP without mbstring extension
Bug Fix:
        - recaptcha server-side validation errors now display correctly with bs4 (they where hidden by bs4's display:none css)
        - fix server-side Recaptcha validation (which always returned true before)
        - fix server-side validation errors markup inside input groups
</code></pre>
                    <h4>version 3.5.1 (04/2018)</h4>
<pre><code class="language-php">
Bug Fix:
        - fix live validation issue with invisible recaptcha
</code></pre>
                    <h4>version 3.5 (04/2018)</h4>
<pre><code class="language-php">
New Features:
        - switch Foundation forms to Foundation 6.4+
          older versions are still available as 'foundation-float-grid' framework
          doc: /documentation/class-doc.html#frameworks
        - add Invisible Recaptcha plugin
          replace all recaptcha v2 in templates with invisible recaptcha except with ajax forms & multiple modals
        - add new "deferScripts" option to defer the loading of the plugins scripts
          default value: true
Improvements:
        - all scripts are now loaded with defer
        - add code to reload uploaded files if forms are sent with errors in fileupload templates
Bug Fix:
        - fix plugins loading with ajax and forms reloaded with errors
</code></pre>
                    <h4>version 3.4 (04/2018)</h4>
                    <p><strong>IMPORTANT</strong></p>
                    <p>This release includes a new <strong>fileuploader plugin</strong> with awesome new features.</p>
                    <p><strong>The old fileupload plugin is now deprecated and will be removed in the next incoming version.</strong></p>
                    <pre><code class="language-php">
New Features:
        - add new awesome fileuploader plugin including image crop/resize tools
Improvements:
        - switched Bootstrap 4.0.0-beta.3 to 4.1
        - improve plugins code if several forms are using the same selectors & same plugins
        - Add Bootstrap 4 Form Validation (live jQuery) i18n support in phpformbuilder/plugins-config/formvalidation.xml
        - Rewrite step forms code
Bug Fix:
        - fix php 7.2 warning with email sending - Parameter must be an array or an object that implements Countable
        - Formvalidation now works fine with intl-tel-input and i18n (custom languages)
        - Email sending will no more fail with empty css file template
</code></pre>
                    <h4>version 3.3 (12/2017)</h4>
                    <pre><code class="language-php">
New Features:
        -   add ajax option (easy Ajax loading to load the forms in any html file)
            Plays well with any CMS (Wordpress, Joomla, Drupal, ...)
        -   add Documentation and screencast to use with CMS
        -   add Image Picker plugin
        -   add Image Picker Templates
Improvements:
        -   upgrade PHP Mailer to the latest version
        -   auto-filter token and submit buttons from email contents
Bug Fix:
        - several minor fixes
</code></pre>
                    <h4>version 3.2 (12/2017)</h4>
                    <pre><code class="language-php">
New Features:
        -   add Bootstrap 4 support
        -   add 40 Bootstrap 4 Templates
        -   add Select2 plugin - https://select2.github.io/
        -   add Ladda plugin - https://github.com/hakimel/Ladda
        -   add intl tel input plugin - https://github.com/jackocnr/intl-tel-input coupled with formvalidation
        -   add centerButtons(boolean) function
        -   add new options:
                buttonWrapper                   (element)
                centeredButtonWrapper           (element)
                centerButtons                   (boolean)
                verticalCheckboxLabelClass      (classname)
                verticalRadioLabelClass         (classname)
Improvements:
        -   upgrade all plugins to the latest version
        -   upgrade PHPMailer to latest 6.0 (required PHP 5.5+)
        -   improve documentation
        -   improve the use of several recaptchas on the same page
        -   reopen modal if the form has been posted with recaptcha error
        -   validate all generated code with Bootlint & W3C
            note: some of the included plugins (Bootstrap select, iCheck, jQuery file upload) generate Bootlint non-valid html
        -   add Russian and Ukrainian languages to the server Validator (thanks to Ramstud)
        -   update dynamic fields form 1 template with required dynamic fields and server + live validation
Bug Fix:
        - php warning with button group + label
        - php warning with inline forms
</code></pre>
                    <h4>version 3.1 (07/2017)</h4>
                    <pre><code class="language-php">
New Features:
        - add $combine_and_compress argument to printIncludes() function to combine and minify all plugin dependancies (css & js files)
          (default: true) - details at https://www.phpformbuilder.pro/documentation/class-doc.html#printIncludes
        - add Foundation framework options and templates
        - add Nice Check plugin to style Radio buttons and Checkboxes
        - add templates theme switcher for Bootstrap & Material forms
Improvements:
        - auto combine and minify all plugin dependancies (css & js files)
        - make recaptcha fully responsive
        - allow to wrap radiobuttons with addInputWrapper function
        - switched setPluginsUrl() function to public and add "$forced_url = ''" optional argument to allow manual plugins URL configuration if user's server is misconfigured.
        - escaped commas now recognized in dependent fields (value with comma can be escaped)
        - rename "dependant fields" plugin to "dependent fields" (sorry ... confusion with French spelling ...)
Bug Fix:
        - fix issues with complex nested dependent fields and jQuery live validation
        - fix issue with custom class attribute and addCountrySelect function
        - fix issue with radio button attributes on material forms
        - fix css overflow with lists into dependent fields
</code></pre>
                    <h4>version 3.0 (Major release - 05/2017)</h4>
                    <p><strong>IMPORTANT</strong></p>
                    <p>More efficient &amp; simple than ever, this release contains some code simplifications, new features and new syntax to send emails.
                        <br>To upgrade from version 2.X, see <a href="#upgrade-phpformbuilder">Upgrade PHP Form Builder</a> section.</p>
                    <pre><code class="language-php">
New Features:
        - add static function Form::validate('form-id');
          Form::validate function instanciates validator and auto-validate required fields
        - merge sendAdvancedMail and sendMail function
        - add helperWrapper option
        - add addHelper($helper_text, $element_name) shorcut function
        - add "inverse" argument to Dependent fields
        - auto-disable dependent fields when they're hidden
        - add custom plugins config directory
        - public non-static methods can now be all chained
Improvements:
        - auto-locate plugins directory &amp; url (phpformbuilder/plugins-path.php has been removed)
        - add optional $fieldset_attr &amp; $legend_attr arguments to startFieldset() function
        - improved jQuery validation with Bootstrap collapsible panels
        - now up to 12 fields can be grouped into same container
        - add Validator Spanish language (Thanks Hugo)
        - minor performance improvements
Others:
        - add tooltip-form template
        - update templates according to new features
        - update documentation
</code></pre>
                    <h4>Version 2.3 (02/2017)</h4>
                    <pre><code class="language-php">
    New Features:
        - add jQuery real time validation plugin ($50 value)
    Improvements:
        - better errors management on plugins path errors
        - add support for several recaptchas on same page
    Bug Fix:
        - removed crossOrigin warning using wordcharcount plugin
        - solved z-index issue with selectpicker &amp; modal</code></pre>
                    <h4>Version 2.2.2 (01/2017)</h4>
                    <pre><code class="language-php">
    Improvements:
        - add support for several modal forms on same page
        - add support for several popover forms on same page
        - add several modal forms on same page templates (Bootstrap + material)
        - add several popover forms on same page templates (Bootstrap + material)
        - better errors management on plugins path errors
        - minor improvements in documentation</code></pre>
                    <h4>Version 2.2.1 (01/2017)</h4>
                    <pre><code class="language-php">
    Bug Fix:
        - add "phpformbuilder/mailer/phpmailer/extras" folder to package, missing in previous release</code></pre>
                    <h4>Version 2.2 (01/2017)</h4>
                    <pre><code class="language-php">
    Security:
        - update PHP Mailer Class to latest (5.2.21)
    Improvements:
        - auto-trigger dependent fields on form load
        - improve main form attributes compilation
    Bug Fix:
        - add one missing translation in de
        - remove php warning on selects with no option
        - fix missing line breaks in emails</code></pre>
                    <h4>Version 2.1 (10/2016)</h4>
                    <pre><code class="language-php">
    New Features:
        - add Recaptcha plugin
        - update Fileupload plugin to latest version
        - add new template default-db-values-form.php
        - add new template fileupload-test-form.php
        - add default values [from database|from variables] in 'how-to' documentation
        - add a 4th optional argument to group 4 inputs in same wrapper
    Bug Fix:
        - missing required sign with radio and no classname</code></pre>
                    <h4>Version 2.0.3 (08/2016)</h4>
                    <pre><code class="language-php">
    Improvements:
        - Rewritten Dynamic Fields Template javascript to match any field
        - update sendAdvancedMail() function to automagically convert posted arrays to comma separated lists in email</code></pre>
                    <h4>Version 2.0.2 (08/2016)</h4>
                    <pre><code class="language-php">
    Bug Fix:
        - fix dependent select with checkboxes
        - fix custom attributes with checkbox groups</code></pre>
                    <h4>Version 2.0.1 (08/2016)</h4>
                    <pre><code class="language-php">
    Improvements:
        - Add Dynamic Fields Templates
    Bug Fix:
        - fix php7 warning (upload button not shown) using addFileUpload() function</code></pre>
                    <h4>version 2.0 (Major release - 07/2016)</h4>
                    <p><strong>IMPORTANT</strong></p>
                    <p>All features are backward-compatible, except addCheckbox() function: 3rd argument ($name) has been removed.</p>
                    <ul>
                        <li>Previous versions: <code class="language-php">$form->addCheckbox($group_name, $label, $name, $value, $attr = '');</code></li>
                        <li>New version 2.0: <code class="language-php">$form->addCheckbox($group_name, $label, $value, $attr = '');</code></li>
                    </ul>
                    <p>(see examples or main class doc for more informations).</p>
                    <pre><code class="language-php">
    New Features:
        - add Material Design plugin
        - add Material Design templates
        - add Modal plugin
        - add Popover plugin
        - add Pickadate plugin + Pickadate Material
        - add XSS protection
        - add CSRF protection
                (documentation: https://phpformbuilder.pro/documentation/class-doc/index.html#security)
        - add 2 functions for dependent fields:
                -   startDependentFields($parent_field, $show_values) ;
                -   endDependentFields();
        - add Autocomplete plugin
        - add support for input grouped with button (ie: search input + btn)
        - automatic scroll to first field with error
        - add third argument to render function to allow returning form code instead of echo
    Improvements:
        - restructure package
        - rewrite all documentation
        - add php beginner's guide
        - rewrite &amp; optimize several Form functions
        - better error fields rendering for grouped fields
        - zero value will not be anymore considered as empty
        - checkboxes are automagically converted to an array of indexed values.
        - add new argument to render, printJsCode &amp; printIncludes functions to return code instead of echo.
        - beautify output if debug enabled
    Updates:
        - update Bootstrap Select plugin to latest version (v1.10.0)
    Bug Fix:
        - fix validation custom error message with 'between' function
        - fix validation errors with dates + hasSymbol function
        - fix wrong comma added in some cases with select option attr.</code></pre>
                    <h4>Version 1.3.1 (10/2015)</h4>
                    <pre><code class="language-php">
    Bug Fix:
    - fix reply_to issue in sendAdvancedMail function</code></pre>
                    <h4>Version 1.3 (05/2015)</h4>
                    <pre><code class="language-php">
    Improvement:
        - improve register / clear system
    New Features:
        - add Country select plugin
        - add Bootstrap select plugin
        - add Passfield plugin
        - add Icheck plugin</code></pre>
                    <h4>Version 1.2.7 (03/2015)</h4>
                    <pre><code class="language-php">
    Bug Fix:
        - fix word-char-count plugin used on the same page with tinyMce + word-char-count.</code></pre>
                    <h4>Version 1.2.6 (03/2015)</h4>
                    <pre><code class="language-php">
    Improvement:
        - register array fieldnames in session to keep values when validation fails.</code></pre>
                    <h4>Version 1.2.5 (02/2015)</h4>
                    <pre><code class="language-php">
    Improvement:
        - add word-char-count support with tinyMce</code></pre>
                    <h4>Version 1.2.4 (12/2014)</h4>
                    <pre><code class="language-php">
    New Features:
        - add support for select into input groups
    Improvements:
        - input groups documentation &amp; examples fully detailed</code></pre>
                    <h4>Version 1.2.3 (12/2014)</h4>
                    <pre><code class="language-php">
    New Features:
        - add database utilities with Myql class
        - add tinyMce (Rich Text Editor) plugin with responsivefilemanager
    Improvements:
        - add debug argument to print css/js includes &amp; js code on screen
        - support of multiple fileUploads on the same page</code></pre>
                    <h4>Version 1.2.2 (10/2014)</h4>
                    <pre><code class="language-php">
    New Feature:
        - add word / character count plugin
    Bug Fix:
        - Fix object context error with php &lt; 5.4
    </code></pre>
                    <h4>Version 1.2.1 (10/2014)</h4>
                    <pre><code class="language-php">
    Updates:
        - improve email sending with attached files</code></pre>
                    <h4>Version 1.2 (10/2014)</h4>
                    <pre><code class="language-php">
    New Features:
        - add sendMail function
        - add sendAdvancedMail function
        - add groupInputs function
        - add btnGroupClass option

    Updates:
        - update fileUpload plugin to last version

    Bugs Fixes:
        - Fix default checkbox wrapper html
        - Fix plugin path with only fileUploads</code></pre>
                    <h4>Version 1.1 (09/2014)</h4>
                    <pre><code class="language-php">
        Bugs Fixes:
        - Fix Validator compatibility with 32/64 bit systems
        - Fix object context error with php &lt; 5.4</code></pre>
                    <h4>Version 1.0 (09/2014)</h4>
                    <pre><code class="language-php">
        PSR2 Standard support
        Check for security vulnerabilities
        Add documentation</code></pre>
                </section>
                <!-- Sources &amp; Credits -->
                <section>
                    <h2 id="credits">Sources &amp; Credits</h2>
                    <p><strong>Thanks so much to:</strong></p>
                    <ul>
                        <li><a href="https://github.com/blackbelt/php-validation">blackbelt&#39;s php-validation class</a></li>
                        <li><a href="http://www.phpclasses.org/ultimatemysql">Jeff L. Williams&#39;s Mysql class</a></li>
                        <li><a href="http://www.responsivefilemanager.com/">http://www.responsivefilemanager.com/</a>*</li>
                        <li><a href="http://www.tinymce.com">http://www.tinymce.com</a></li>
                        <li><a href="http://colpick.com/plugin">https://github.com/josedvq/colpick-jQuery-Color-Picker/</a></li>
                        <li><a href="http://jqueryui.com/datepicker/">http://jqueryui.com/datepicker/</a></li>
                        <li><a href="https://github.com/jonthornton/jquery-timepicker">https://github.com/jonthornton/jquery-timepicker</a></li>
                        <li><a href="http://keith-wood.name/realPerson.html">http://keith-wood.name/realPerson.html</a></li>
                        <li><a href="https://github.com/blueimp/jQuery-File-Upload">https://github.com/blueimp/jQuery-File-Upload</a></li>
                        <li><a href="https://github.com/PHPMailer/PHPMailer/">https://github.com/PHPMailer/PHPMailer</a></li>
                        <li><a href="https://github.com/jjriv/emogrifier">https://github.com/jjriv/emogrifier</a></li>
                        <li><a href="http://silviomoreto.github.io/bootstrap-select/">http://silviomoreto.github.io/bootstrap-select/</a></li>
                        <li><a href="http://fronteed.com/iCheck/">http://fronteed.com/iCheck/</a></li>
                        <li><a href="http://antelle.github.io/passfield/index.html">http://antelle.github.io/passfield/index.html</a></li>
                        <li><a href="http://vodkabears.github.io/remodal/">http://vodkabears.github.io/remodal/</a></li>
                        <li><a href="https://github.com/sandywalker/webui-popover">https://github.com/sandywalker/webui-popover</a></li>
                        <li><a href="http://materializecss.com/">http://materializecss.com/</a></li>
                        <li><a href="http://formvalidation.io/">http://formvalidation.io/</a></li>
                    </ul>
                    <h4>About Responsive File Manager</h4>
                    <p>Responsive File Manager is under <strong>Creative Commons Attribution-NonCommercial 3.0 Unported License</strong>.
                        <br>The author kindly allowed me to include it with PHP Form Builder.
                        <br> PHP Form Builder users are allowed to use it <strong>without limitation for non-commercial projects</strong>.</p>
                    <p>If you want to use Responsive File Manager in <strong>commercial projects</strong>, please <a href="http://www.responsivefilemanager.com/">contact the author</a> and ask him for his agreement. A small donation is welcome.</p>
                </section>
                <!-- Other Projects -->
                <section>
                    <p>&nbsp;</p>
                    <h2 id="miglisoft">Other Projects</h2>
                    <p>I'm a french web developer ; I work on many enthusiastic project for clients as freelancer, mainly handmade websites or web applications.</p>
                    <p>I spend time each day helping people using PHP Form Builder all over the world</p>
                    <p>Feel free to <a href="https://www.miglisoft.com/#contact">contact me about any project / request</a></p>
                    <hr>
                    <p><strong>Other web tools sold on Codecanyon:</strong></p>
                    <div class="row mb-5">
                        <div class="col-sm-6">
                            <h3>PHP CRUD Generator</h3>
                            <figure>
                                <a href="https://www.phpcrudgenerator.com/">
                                        <img src="https://www.miglisoft.com/assets/images/phpcg-preview.png" class="img-responsive img-thumbnail" alt="PHP CRUD Generator">
                                    </a>
                                <figcaption><strong>PHP CRUD Generator</strong>
                                    <br>Simple application to build Bootstrap backoffice for your website</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-6">
                            <h3>Slider Maker - jQuery slideshow builder</h3>
                            <figure>
                                <a href="https://www.slider-maker.com/">
                                        <img src="https://www.miglisoft.com/assets/images/slider-maker-preview.jpg" class="img-responsive img-thumbnail" alt="jQuery Slideshow builder">
                                    </a>
                                <figcaption><strong>How to build jQuery slideshows &amp; galleries without coding</strong>
                                    <br>Login to admin panel and build high quality responsive slideshows in a visual way</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-6">
                            <h3>TinyMce Bootstrap plugin</h3>
                            <figure>
                                <a href="http://tinymce-bootstrap-plugin.creation-site.org/index.html">
                                        <img src="https://www.miglisoft.com/assets/images/tinymce-bootstrap-plugin-preview.png" class="img-responsive img-thumbnail" alt="Bootstrap toolbar for tinyMce">
                                    </a>
                                <figcaption><strong>TinyMce plugin to insert Bootstrap elements into your page</strong>
                                    <br>Wordpress &amp; Joomla versions available</figcaption>
                            </figure>
                        </div>
                    </div>
                    <p><strong>Others:</strong></p>
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>DMCA Sender - Anti-Piracy solution</h3>
                            <figure>
                                <a href="https://www.hack-hunt.com/">
                                        <img src="https://www.miglisoft.com/assets/images/dmca-sender-home-590-300.jpg" class="img-responsive img-thumbnail" alt="DMCA Sender - Anti-Piracy solution">
                                    </a>
                                <figcaption><strong>DMCA Sender - Online SaaS application to find illegal download links to your softwares &amp; applications.<br>Auto-send your DMCA Takedown Notice</strong></figcaption>
                            </figure>
                        </div>
                    </div>
                </section>

                <!--====  End of COMMON PART  ====-->

                <section id="subscribe">
                    <!-- Begin MailChimp Signup Form -->
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                    <style type="text/css">
                        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                    </style>
                    <div id="mc_embed_signup">
                    <form action="https://miglisoft.us12.list-manage.com/subscribe/post?u=5ada8aa8ad0c23f0f9b049033&amp;id=df3033ae20" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                        <h2>Subscribe to our mailing list<br><small>Keep informed of the latest updates - maximum 2 or 3 posts per year</small></h2>
                    <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
                    </label>
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-FNAME">First Name </label>
                        <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-LNAME">Last Name </label>
                        <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                    </div>
                        <div id="mce-responses" class="clear">
                            <div class="response" id="mce-error-response" style="display:none"></div>
                            <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_5ada8aa8ad0c23f0f9b049033_df3033ae20" tabindex="-1" value=""></div>
                        <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>
                    </form>
                    </div>
                    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                    <!--End mc_embed_signup-->
                </section>
            </div>
            <!-- col-sm-10 col-sm-offset-1 -->
        </div>
        <!-- row -->
        <p><small>&copy; Gilles Migliori - 2018</small> - Thanks for validating my DMCA Request.</p>
    </div>
    <!-- container-fluid -->

    <!-- jQuery -->
    <script src="documentation/assets/javascripts/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="documentation/assets/javascripts/popper.min.js"></script>
    <script src="documentation/assets/javascripts/bootstrap.min.js"></script>
    <!-- pace loader -->
    <script src="documentation/assets/javascripts/plugins/loaders/pace.min.js"></script>
    <!-- project -->
    <script src="documentation/assets/javascripts/project.js"></script>
    <!-- Syntax Highlighting -->
    <script defer src="documentation/assets/javascripts/prism.min.js"></script>
    <!-- nicescroll -->
    <script defer src="documentation/assets/javascripts/plugins/nicescroll/nicescroll.min.js"></script>
    <script src="documentation/assets/javascripts/fontawesome-free-5.0.12/svg-with-js/js/fontawesome-all.min.js"></script>
    <script type="text/javascript">
        (function () {
            window.siqConfig = {
                engineKey: "4008c66d1ca5621fc45dd9519306da1a",
            forceLoadSettings: false        // change false to true if search box on your site is adding dynamically
        };
        window.siqConfig.baseUrl = "//pub.searchiq.co/";
        var script = document.createElement("SCRIPT");
        script.src = window.siqConfig.baseUrl + '/js/container/siq-container-2.js?cb=' + (Math.floor(Math.random()*999999)) + '&engineKey=' + siqConfig.engineKey;
        script.id = "siq-container";
        document.getElementsByTagName("HEAD")[0].appendChild(script);
    })();
    </script>
</body>

</html>
