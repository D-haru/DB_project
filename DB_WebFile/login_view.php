<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>공공혜택사업</title>
    <link rel="stylesheet" href="css/login_css.css">
  </head>
  <body>
  <form action="login_server.php" method="post">
    <div id="container">
      <header>
        <div id="logo">
          <a href="index.php">
            <h1>공공혜택사업</h1>
          </a>
        </div>
        <nav>
          <ul id="topMenu">
          <?php if(isset($_SESSION['ID']))  { ?>
            <li><a href="logout.php">로그아웃</a></li>
            <li><a href="signout.php">회원탈퇴</a></li>
            <li><a href="mypage.php">마이페이지</a></li>
            <li><a href="allBenefit.php">전체혜택</a></li>
            <?php } else {?>
            <li><a href="login_view.php">로그인</a></li>
            <li><a href="register_view.php">회원가입</a></li>
            <li><a href="mypage.php">마이페이지</a></li>
            <li><a href="allBenefit.php">전체혜택</a></li>
            <?php }
          ;?>
          </ul>
        </nav>
      </header>
      <main class="contents">
        <div id="login_title">
          <p>로그인</p>
        </div>

        <?php if(isset($_GET['error'])) { ?>
        <p class = "error"><?php echo $_GET['error'];?></p> 
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?>
        <p class = "success"><?php echo $_GET['success'];?></p> 
        <?php } ?>

        <hr style="border: 0; margin-left: 70px; width: 1000px; height: 2px; background-color: #44546A;">
        <fieldset>
          <legend>로그인정보입력</legend>
          <div >
            <input type="text" name ="login_id" class="account" placeholder="아이디를 입력하세요">
          </div>
          <div>
            <input type="password" name ="login_pw" class="account" placeholder="비밀번호를 입력하세요">
          </div>
          <button id="login_btn" class="account" name = "login"><b>로그인</b></button>
        </fieldset>
      </main>
      <footer>
        <section id="bottomMenu">
          <ul id="bottomMenu_list">
            <li>C087031 최효은</li>
            <li>C089020 김지연</li>
            <li>C089075 문상준</li>
          </ul>
        </section>
      </footer>
    </div>
</form>
  </body>
</html>