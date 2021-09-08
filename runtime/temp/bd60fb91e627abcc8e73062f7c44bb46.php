<?php /*a:1:{s:40:"/www/wwwroot/short.com/view/api/faq.html";i:1631004168;}*/ ?>

<!DOCTYPE html>
<html class="full" lang="zh">

<head>
  <base href="https://vwlin.cn//" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>使用许可 - shorturl</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- Custom CSS for the Template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">

  <link href="https://fonts.loli.net/css?family=Fjalla+One" rel="stylesheet">
  <link rel="stylesheet" href="css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <style>
    body {
      background-color: #f1f1f1;
    }        </style>
</head>

<body>
<nav class="navbar navbar-fixed-bottom navbar-inverse" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
<!--      <a class="navbar-brand" href="index.php">-->
<!--        小苏苏shorturl</a>-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
<!--      <ul class="nav navbar-nav">-->
<!--        <li><a href="about">关于我们</a></li>-->
<!--        <li><a href="api-about">Api接口</a></li>-->
<!--        <li><a href="tos">使用许可</a></li>-->
<!--        <li><a href="http://wpa.qq.com/msgrd?v=3&uin=改成你的QQ号&site=qq&menu=yes">联系我们</a></li>-->
<!--        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#bookmarklet-modal">快捷缩短</a></li>-->
<!--        <li><a href="https://beian.miit.gov.cn">京ICP备2021027473号-1</a></li>-->




<!--      </ul>-->
<!--      <ul class="nav navbar-nav navbar-right">-->
<!--        <li class="active"><a href="statics.php">统计</a></li>-->
<!--      </ul>-->
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>
<div id="bookmarklet-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">收藏夹快捷功能</h4>
      </div>
      <div class="modal-body">
        <p>小苏苏shorturl 书签帮助您快速生成短网址而不离开您的网站。</p>
        <p>将下面的链接拖动到书签栏以安装书签。</p>
        <p><a href="javascript:(async () => {if (!window.shorturl) {const poop = await fetch('https://vwlin.cn//api.php?url=' + encodeURI(location.href)).then(x => x.json());window.shorturl = poop.shorturl ? poop.shorturl : poop.error;}console.log(window.shorturl);const elements = {}; elements.container = document.createElement('div');elements.container.style.cssText = 'z-index:10000;';elements.modal = document.createElement('div');elements.modal.style.cssText = 'z-index:10000;position:fixed;box-shadow: 0 5px 15px -5px rgba(0,0,0,0.8);display:inline-block;color:black;padding:24px;background-color:white;bottom:12px;left:12px;border-radius:12px;font-size:18px;transition:all 250ms ease;opacity:0';elements.a = document.createElement('a');elements.a.innerText = window.shorturl;elements.a.href = window.shorturl;elements.a.addEventListener('click',(e)=>{e.preventDefault();});elements.p = document.createElement('p');elements.p.style.cssText = 'padding:0;margin:0;';elements.p.innerHTML = `<br>功能由 <a href='https://vwlin.cn/'>小苏苏shorturl 提供</a>`;elements.modal.appendChild(elements.a);elements.modal.appendChild(elements.p);elements.container.appendChild(elements.modal);const body = document.querySelector('body');body.appendChild(elements.container);requestAnimationFrame(()=>{requestAnimationFrame(()=>{elements.modal.style.opacity = 1;})});setTimeout(()=>{elements.modal.style.opacity = 0;setTimeout(()=>{elements.container.remove();},260);},5000);})();">缩短当前网址</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<script>
  const bookmarklet = () => {
    alert("Here I am!")
  }
</script>
<div class="container">
  <div class="row logo">
    <div class="col-lg-12" style="text-align:center">
      <a class="logo-text" style="color: inherit;" href="" ><p class="font"><strong>小苏苏shorturl</strong></p></a><a id="dark-mode-btn" title="Toggle night mode" href="javascript:void(0)" onclick="toggleNightMode(this)"><i class="fas fa-moon"></i></a>
      <script>
        toggleNightMode("cookies")

        function toggleNightMode(e) {
          const body = document.querySelector("body");
          const button = document.querySelector("#dark-mode-btn");
          const logo = document.querySelector("#main-logo");
          if (window.innerWidth < 650) {
            body.append(button);
          }
          if (e == "cookies") {
            // HERE GOES IDB STUFF
            let now = document.cookie.split("dark=");
            now = now[1].split(";");
            if (Boolean(Number(now[0]))) {
              body.classList.add("dark-mode");
              button.classList.add("active");
              if (logo) {
                logo.src = "img/logo-dark.png";
              }
            };

            return;
          };
          if (body.classList.toggle("dark-mode")) {
            document.cookie = "dark=1";
            if (logo) {
              logo.src = "img/logo-dark.png";
            }
          } else {
            document.cookie = "dark=0";
            if (logo) {
              logo.src = "img/logo-light.png";
            }
          }
          button.classList.toggle("active");
        }
      </script>                </div>
  </div>
</div>
<div class="container  animated fadeIn">

  <div class="row" style="margin-top: -25px;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="myModalLabel">使用许可</h2>
        </div>
        <div class="modal-body" style="min-height:10%; max-height:350px; overflow-y:scroll; overflow-x:none; position:relative;">
          <P>不要垃圾邮件的网站</p>
          <p>不要短暂的病毒，恶意软件的链接</p>
          <p>不要短，不合法的链接</p>
          <p>不要垃圾邮件的网站，不要垃圾邮件的网站，不要垃圾邮件的网站，不要垃圾邮件的网站</p>
          <p>不要垃圾邮件的网站</p>
          <p>不要短的病毒，恶意软件的链接</p>
          <p>使用服务你应该知道：…………</P>
        </div>

      </div><!-- /.modal-content -->
    </div>
  </div>


</div>
<!-- JavaScript -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>
