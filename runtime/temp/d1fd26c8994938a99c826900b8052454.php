<?php /*a:1:{s:41:"/www/wwwroot/short.com/view/api/pass.html";i:1630236098;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no,user-scalable=no">
    <title>QAw-验证</title>
    <meta name="keywords" content="qaw">
    <meta name="description" content="qaw">
    <meta property="og:description" content="qaw">
    <meta property="og:type" content="acticle">
    <meta property="og:locale" content="zh-CN" />
    <meta property="og:site_name" content="qaw">
    <meta property="og:title" content="qaw">
    <link rel="shortcut icon" href="./api/css/favicon.ico" />
    <!--     Fonts and icons     -->
    <!--//  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />-->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.13.1/css/all.min.css" rel="stylesheet">
    <!-- <link href="./ajax/libs/font-awesome/5.13.1/css/all.min.css" rel="stylesheet"> 本地css,经测不稳定    Nucleo Icons  https://cdn.bootcdn.net/ajax/libs/font-awesome/5.13.1/css/all.min.css-->
    <link href="/api/assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="/api/assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />

</head>

<body class="index-page">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="https://qaw.bio/">
<!--                <span>QAW •</span> 短网址-->
            </a>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a>
                            QAW•bio
                        </a>
                    </div>
                    <div class="col-6 collapse-close text-right">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>
<!-- BODY -->
<div class="wrapper">
    <div class="page-header header-filter">
        <div class="squares square1"></div>
        <div class="squares square2"></div>
        <div class="squares square3"></div>
        <div class="squares square4"></div>
        <div class="squares square5"></div>
        <div class="squares square6"></div>
        <div class="squares square7"></div>
        <div class="container">
            <div class="content-center brand">


                <div class="card card-profile shadow mb-0">
                    <div class="h1 text-neutral my-3">验证 PASSWD</div>
                    <div class="form-group row  justify-content-center mx-0">

                        <div class="form-check form-check-radio mx-2">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio"name="urlType" id="exampleRadios1" value="local" checked>
                                <span class="form-check-sign"></span>
                                check
                            </label>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text "><i class="fa fa-link"></i></span>
                        </div>
                        <input type="text" id="inputContent" class="form-control " placeholder="请输入需要验证passwd">
                        <input type="hidden" id="inputContentb" class="form-control " placeholder="请输入需要验证passwd" value="<?php echo htmlentities($link); ?>">
                    </div>
                </div>

                <div class="justify-content-between row mx-0 px-3 mb-2">
                    <button class="btn  btn-primary col-md-5 col-12" type="button" onclick="checkUrl(document.getElementById('inputContent').value,document.getElementById('inputContentb').value)" data-container="body" data-animation="true" title="将长链接还原成短链接">马上提交</button>
                </div>
                <script>
                </script>
                <div class="row justify-content-center mx-0 px-2 col-12" id='resultBox' style="display:none">
                    <div class="text-center  col-12">
                        <div class="h4 text-success my-3">转换结果</div>
                        <h4 class="description" id="resultLink"></h4>
                    </div>
                    <div class="text-center mb-3 col-12">
                        <div class="btn btn-primary btn-round" id="copyLink" data-clipboard-target="#resultLink" data-clipboard-action="copy"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="errPop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
                <h4 class="title title-up">温馨提示</h4>
            </div>

            <div class="modal-body text-center">

                <p id="errTip"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary col-12" data-dismiss="modal">确 定</button>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!---这三条本地有备份js-->
<script src="/api/assets/js/popper.min.js" type="text/javascript"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/api/assets/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script type="text/javascript" src="/api/assets/js/checkpass.js"></script>
<script>
    $(document).ready(function() {
        blackKit.initDatePicker();
        blackKit.initSliders();
    });

    function scrollToDownload() {
        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }
</script>

</body>

</html>