<?php
session_start();

require "dbcon.php";
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
  
$cnt = 1;
    
$sql="select * from benefit";
$result=oci_parse($db,$sql); 
oci_execute($result);
$res = array();
$row_num = oci_fetch_all($result, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

  
$list_num = 10;
  
$page_num = 5;

$page = isset($_GET['page'])? $_GET['page'] : 1; 

$total_page = ceil(count($res) / $list_num);

$total_block = ceil($total_page / $page_num);

$now_block = ceil($page / $page_num);

$s_pagenum = ($now_block - 1) * $page_num + 1;

//data 0
if ($s_pagenum == 0) {
    $s_pagenum = 1;
}
$e_pagenum = $now_block * $page_num;

if ($e_pagenum > $total_page) {
    $e_pagenum = $total_page;
}
$start = ($page - 1) * $list_num;
$cnt = $start + 1;

//혜택테이블에서 10개씩 데이터를 가져옴
$sql3 = "select * from (select rownum as seq, benefit.* from benefit) where seq between '$start' and '$start'+'$list_num'";
  
$resrt=oci_parse($db,$sql3); 
oci_execute($resrt);
?>
  

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>공공혜택사업</title>
    <link rel="stylesheet" href="css/allBenefit_css.css">
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
        <h1>진행중인 공공혜택사업 목록</h1>
        <hr style="border: 0; margin-left: 70px; width: 1000px; height: 2px; background-color: #44546A;">
        <div class="board_info">
          <span id="notice_allcount">- 총 게시물 : <?php echo $row_num; ?>건</span>
        </div>
        <table class="benefit_table">
          <colgroup>
            <col style="width:200px;"/>
            <col>
            <col style="width:200px;"/>
            <col style="width:240px;"/>
          </colgroup>
          <thead>
            <tr>
              <th>사업번호</th>
              <th>혜택이름</th>
              <th>부서</th>
              <th>진행기간</th>
            </tr>
          </thead>
          <tbody>
            <!--*질문 세로로 입력 가능??-->
            
            
            <?php 
            //10개씩 가져온 데이터 출력.
              while(($row = oci_fetch_array($resrt,OCI_ASSOC))!=false){
                echo('
                <tr>
                  <td> '.$cnt.' </td>
                  <td>
                  <div class="benefit_subject">
                    <a href="">
                    <span>  '.$row["BENEFITNAME"].' </span>
                    </a>
                  </div>
                  </td>
                  <td> '.$row["DIC"].' </td>
                  <td> '.$row["PERIOD"].'  </td>
                </tr>
                ');
              $cnt++;  
              }
            
            ?>
            <!--
            <tr>
              <td>2</td>
              <td>
                <div class="benefit_subject">
                  <a href="">
                    <span>국가장학금 2유형(대학연계지원형)</span>
                  </a>
                </div>
              </td>
              <td>국가장학부</td>
              <td>2022. 8. 17 ~ 2022. 9 15</td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="benefit_subject">
                  <a href="">
                    <span>학자금대출</span>
                  </a>
                </div>
              </td>
              <td>국가장학부</td>
              <td>2022. 8. 17 ~ 2022. 9 15</td>
            </tr>
            -->
          </tbody>
        </table>
        <div class="pagination">
          <div class="page">
            <span class="page_link-group">
            
              <?php
              //페이지 버튼
              if ($page <= 1) {
                echo "<a href='allBenefit.php?page=1'>이전</a>";
              } else {
                echo "<a href='allBenefit.php?page=" . ($page - 1) . "'>이전</a>";
              }
              for ($p = $s_pagenum; $p <= $e_pagenum; $p++) {
                echo "<a href='allBenefit.php?page=" . $p . "'>".$p."</a>";
              }
              if ($page >= $total_page) {
                echo "<a href='allBenefit.php?page=" . $total_page . "'>다음</a>";
              } else {
                echo "<a href='allBenefit.php?page=" . ($page + 1) . "'>다음</a>";
              }
              ?>
            
            </span>
          </div>
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
  </body>
</html>

<?php
oci_free_statement($result);
oci_free_statement($resrt);
oci_close($db);

?>