<?php
session_start();

error_reporting( E_ALL );
ini_set( "display_errors", 1 );


require "dbcon.php";

// 로그인 했는지 확인 
$sessid=$_SESSION['ID'];

// 안했으면 여기 들어가서 경고문 뛰움
if ($sessid==NULL){
  echo "<script>alert('로그인을 하세요.')
        location.href = 'login_view.php'
        </script>";
}

$sql1="select name, rrn from customer where id='$sessid'";  

  $result1=oci_parse($db,$sql1); 
  oci_execute($result1); 

  $row_num1 = oci_fetch_array($result1, OCI_ASSOC);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>공공혜택사업</title>
    <link rel="stylesheet" href="css/mypage_css.css">
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
        <h1>마이페이지</h1>
        <hr style="border: 0; margin-left: 70px; width: 1000px; height: 2px; background-color: #44546A;">
        <div id="info_title">- 개인정보입력 -</div>
        

        <form name="insert" action="mypagesave.php" method="POST">
          <fieldset>
            <div>
              <label for="name_input">이름</label>
              <span><?php echo($row_num1["NAME"]); ?></span>
              
            </div>
            <div>
              <!-- 내 정보중에서 rrn 주민번호 불러와서 출력 -->
            <?php $_rrn=(0);
            $_rrn=$row_num1["RRN"]; ?>
              <label for="name_input">주민등록번호</label>
              <span><?php echo ($row_num1["RRN"]); ?></span>
            </div>
            <div>
              <label for="gender_input">성별</label>
              <input type="radio" name="gender" value="male" checked/><span>m</span>
              <input type="radio" name="gender" value="female"/><span>f</span>
            </div>
            <div>
              <label for="age_input">연령대</label>
              <select name="age">
                <option value="teenager"> ~ 만 18세</option>
                <option value="youth"> 만 19세 ~ 만 29세</option>
                <option value="middle_age"> 만 30세 ~ 만 49세</option>
                <option value="old_age"> 만 50세 ~ 만 64세</option>
                <option value="advanced_age"> 만 65세 ~</option>
              </select>
            </div>
            <div>
              <label for="IQ_input">소득분위</label>
              <select name="income">
                <option value="Section1">1구간</option>
                <option value="Section2">2구간</option>
                <option value="Section3">3구간</option>
                <option value="Section4">4구간</option>
                <option value="Section5">5구간</option>
                <option value="Section6">6구간</option>
                <option value="Section7">7구간</option>
                <option value="Section8">8구간</option>
                <option value="Section9">9구간</option>
                <option value="Section10">10구간</option>
              </select>
            </div>
            <div>
              <label for="IQ_input">가구유형</label>
              <select name="income2">
                <option value="None">해당없음</option>
                <option value="CrossCulture">다문화가구</option>
                <option value="multichild">다자녀가구</option>
                <option value="singleparent">한부모가구</option>
              </select>
            </div>
            <div>
              <label for="residence_input">주민등록상 지역</label>
              <select name="residence">
                <option value="Gangwon">강원도</option>
                <option value="Gyeonggi">경기도</option>
                <option value="Gyeongsangnam">경상남도</option>
                <option value="Gyeongsangbuk">경상북도</option>
                <option value="Gwangju">광주광역시</option>
                <option value="Daegu">대구광역시</option>
                <option value="Busan">부산광역시</option>
                <option value="Seoul">서울특별시</option>
                <option value="Sejong">세종특별자치시</option>
                <option value="Ulsan">울산광역시</option>
                <option value="Incheon">인천광역시</option>
                <option value="Jeollanam">전라남도</option>
                <option value="Jeollabuk">전라북도</option>
                <option value="Jeju">제주특별자치도</option>
                <option value="Chungcheongnam">충청남도</option>
                <option value="Chungcheongbuk">충청북도</option>
              </select>
            </div>

          </fieldset>


          <div class="info_btn">
          <td colspan="2">
          <span class="info_submit"><a href="mypage_sub.html"><input type="submit" name="저장" value="저장"></a></span>
          </td>
          <span class="info_cancle"><a href="index.html"><input type="submit" value="취소"></a></span>
          </div>
        
      
      </form>



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
  </body>
</html>


<?php
oci_free_statement($result1);
oci_close($db);

?>