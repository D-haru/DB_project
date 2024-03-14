<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>공공혜택사업</title>
    <link rel="stylesheet" href="css/join_css.css">
  </head>
  <body>
    <form action="register_server.php" method="post">

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
        <h1>회원가입</h1> 
        <!-- header 사용(중요X) -->
        <?php if(isset($_GET['error'])) { ?>
        <p class = "error"><?php echo $_GET['error'];?></p> 
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?>
        <p class = "success"><?php echo $_GET['success'];?></p> 
        <?php } ?>

        <hr style="border: 0; margin-left: 70px; width: 1000px; height: 2px; background-color: #44546A;">
        <div id="join_picture"><img src="img/join.png"></div>
        
        <fieldset>
          <legend>기본정보입력(필수)</legend>
          <div>
            <label for="name_input">이름 <span>*</span></label>
            <?php if(isset($_GET['name'])) { ?> 
            <input type="text" name="name" maxlength="30" value="<?php echo $_GET['name']; ?>">
            <?php } else {?>
            <input type="text" name="name" maxlength="30">
            <?php } ?>
          </div>
          <div>
            <label for="id_input">아이디 <span>*</span></label>
            <?php if(isset($_GET['in_input'])) { ?> 
            <input type="text" name="id_input" maxlength="20" value="<?php echo $_GET['id_input']; ?>">
            <?php } else {?>
            <input type="text" name="id_input" maxlength="20">
            <?php } ?>
          </div>
          <div>
            <label for="pw_input">비밀번호 <span>*</span></label>
            <?php if(isset($_GET['pw_input'])) { ?> 
            <input type="password" name="pw_input" maxlength="30" value="<?php echo $_GET['pw_input']; ?>">
            <?php } else {?>
            <input type="password" name="pw_input" maxlength="30">
            <?php } ?>
          </div>
          <div>
            <label for="RN_input">주민등록번호 <span>*</span></label>
            <?php if(isset($_GET['RN_input'])) { ?> 
            <input type="text" name="RN_input" maxlength="30" value="<?php echo $_GET['RN_input']; ?>">
            <?php } else {?>
            <input type="text" name="RN_input" maxlength="30">
            <?php } ?>
          </div>
          <div>
            <label for="email_input">이메일 <span>*</span></label>
            <?php if(isset($_GET['email_input'])) { ?> 
            <input type="text" name="email_input" maxlength="40" value="<?php echo $_GET['email_input']; ?>">
            <?php } else {?>
            <input type="text" name="email_input" maxlength="40">
            <?php } ?>
          </div>
        </fieldset>
        
        <div class="join_btn">
        <span class="join_submit"><input type="submit" name = "save" value="저장"></span>
          <span class="join_cancle"><a href="index_view.php"><input type="submit" name = "back" value="취소"></a></span>
        </div>
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