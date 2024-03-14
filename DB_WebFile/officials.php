<?php 

require "dbcon.php";

$sql="select * from C_B";  //C_B 가져오기

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
    <link rel="stylesheet" href="css/mypage_sub.css">
  </head>
  <body>
    <div id="container">
      <header>
        <div id="logo">
          <a href="index.php">
            <h1>공공혜택사업</h1>
          </a>
        </div>
      </header>
      <main class="contents">
        <h1>관계자 확인용 페이지</h1>
        <hr style="border: 0; margin-left: 70px; width: 1000px; height: 2px; background-color: #44546A;">
        <div class="board_info">
            <span id="notice_allcount">- 회원과 혜택 관리</span>
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
                    <th>회원</th>
                    <th>사업번호</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              for($i=0; $i<$row_num; $i++ ){
                echo('
                <tr>
                  <td> '.$res[$i]["ID"].' </td>
                  <td>
                  <div class="benefit_subject">
                    <a href="">
                    <span>  '.$res[$i]["BN"].' </span>
                    </a>
                  </div>
                  </td>
                </tr>
                ');            
              }
            
            ?>
            </tbody>
          </table>
          <div class="pagination">
            <div class="page">
              <span class="page_link-group">
                <strong title="현재 1페이지" class="page_link active">
                  "1"
                </strong>
                <a href="" title="2페이지 이동" class="page_link">2</a>
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
            <li><a href="Officials.php">관계자</a></li>
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
