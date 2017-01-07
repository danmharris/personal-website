<HTML>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Dan Harris">
    <meta name="author" content="Dan Harris">
    <meta name="description" content="Personal website for Dan Harris">
    <link href='css/font.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title><?php echo $title; ?></title>

    <script>
    window.onload = function(){
      var menuBtn = document.getElementsByClassName('nav-menu-btn')[0];
      menuBtn.onclick = function(){
        var menu = document.getElementsByClassName('nav-pages')[0];
        if (menu.style.display == ""){
          menu.style.display = "block";
        } else {
          menu.style.display = "";
        }
      };
    };
    </script>
  </head>

  <body>
    <div class="header">
      <div class="nav">
        <div class="nav-social">
        <a href="https://github.com/danh98" target="_blank">
          <svg height="40" width="40">
            <circle cx="20" cy="20" r="15" stroke="white" stroke-width="2" fill="none"/>
            <image width="24px" height="24px" x="8" y="8" xlink:href="assets/github.png" title="Github">
          </svg>
        </a>

        <a href="https://twitter.com/danh1606" target="_blank">
          <svg height="40" width="40">
            <circle cx="20" cy="20" r="15" stroke="white" stroke-width="2" fill="none"/>
            <image width="24px" height="24px" x="8" y="8" xlink:href="assets/twitter.png" title="Twitter">
          </svg>
        </a>
        </div>
        <div class="nav-menu-btn">&#9776</div>
          <ul class="nav-pages">
            <a href="./"><li>Home</li></a>
            <a href="./projects"><li>Projects</li></a>
          </ul>
      </div>
      <div class="banner">
          <a href="./"><div class="banner-title">DAN HARRIS</div></a>

      </div>
    </div>
    <div class="content">
      <?php
        foreach($files as $file){
          include ($file);
        }
      ?>
    </div>
    <div class="footer">
      <ul class="footer-nav">
        <a href="./downloads"><li>Downloads</li></a> |
        <a href="./sitemap"><li>Sitemap</li></a> |
        <a href="./contact"><li>Contact</li></a>
      </ul>
      <div class="copyright">&copy Dan Harris <?php echo date("Y"); ?></div>

    </div>
  </body>
</HTML>
