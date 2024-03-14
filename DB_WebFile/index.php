<?php session_start(); 


require "dbcon.php";

//전체 디비 불러오기
$sql="select * from benefit";  

$result=oci_parse($db,$sql); 
oci_execute($result); 

$res = array();
$row_num = oci_fetch_all($result, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>공공혜택사업</title>
    <link rel="stylesheet" href="css/index_css.css">
  </head>
  <body>
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
      <form action = "search.php" method="get">
        <div id="search">
          <input type="search" name = "key" placeholder="궁금한 공공혜택을 검색해보세요.">
          <a href="search_result.php"><img id="search_img" src="img/search.png" ></a>
        </div>
        </form>
        <div id="latest">
          <p class="list_name">최근에 올라온 공고</p>
          <p class="list_plus"><a href="allBenefit.php">더보기 ></a></p>
          <hr>

          <!-- 혜택에서 위에서 4개 뽑기 -->
            <?php 
              for($i=0; $i<4; $i++ ){
                echo('
                <ul class="latest_list">
                  <li class="latest_item">
                    <a href="" class="latest_item_title">'.$res[$i]["BENEFITNAME"].'</a>
                    <div class="latest_item_info">- <span>주관부서 : '.$res[$i]["DIC"].'</span>, 신청기간 : '.$res[$i]["PERIOD"].' </div>
                  </li>
                </ul>
                ');            
              }
            
            ?>
          <!--<ul class="latest_list">
            <li class="latest_item">
              <a href="" class="latest_item_title">최신 공고 제목,누르면 혜택공고의 페이지로 이동</a>
              <div class="latest_item_info">- 공고 정보, 혜택사항, 지원방법 등</div>
            </li>
            <li class="latest_item">
              <a href="" class="latest_item_title">최신 공고 제목,누르면 혜택공고의 페이지로 이동</a>
              <div class="latest_item_info">- 공고 정보, 혜택사항, 지원방법 등</div>
            </li>
            <li class="latest_item">
              <a href="" class="latest_item_title">최신 공고 제목,누르면 혜택공고의 페이지로 이동</a>
              <div class="latest_item_info">- 공고 정보, 혜택사항, 지원방법 등</div>
            </li>
            <li class="latest_item">
              <a href="" class="latest_item_title">최신 공고 제목,누르면 혜택공고의 페이지로 이동</a>
              <div class="latest_item_info">- 공고 정보, 혜택사항, 지원방법 등</div>
            </li>
          </ul>
            -->
        </div>
      </main>
      <footer>
        <section id="bottomMenu">
          <ul id="bottomMenu_list">
            <li>C087031 최효은</li>
            <li>C089020 김지연</li>
            <li>C089075 문상준</li>
            <li><a href="officials.php">관계자</a></li>
          </ul>
        </section>
      </footer>
    </div>
  </body>
</html>


<?php
oci_free_statement($result);
oci_close($db);

?>