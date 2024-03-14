<?php
  session_start();

  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );

  require "dbcon.php";

  $sessid=$_SESSION['ID'];

  // 내 혜택을 찾기 위해서 전체 혜택 가져오기
  $sql_all="select * from benefit ";  
  $result_all=oci_parse($db,$sql_all); 
  oci_execute($result_all); 

  $res_all = array();
  $row_num_all = oci_fetch_all($result_all, $res_all, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

  // 내 혜택만을 뽑기위해 아이디에 맞는 정보 가져오기
  $sql_my="select * from persdata where id='$sessid'";  

  $result_my=oci_parse($db,$sql_my); 
  oci_execute($result_my); 

  $res_my = array();
  $row_num_my = oci_fetch_array($result_my,OCI_ASSOC);

  // 내 정보랑 맞는 혜택 뽑아내기
  $j=0;
  $res_mybene= array();
  for ($i=0 ; $i<$row_num_all; $i++){
    if(($res_all[$i]["GENDER"] == $row_num_my["GENDER"] or $res_all[$i]["GENDER"] =='None') 
    and ($res_all[$i]["AGE"]==$row_num_my["AGEG"] or $res_all[$i]["AGE"] =='None') 
    and ($res_all[$i]["INCB"]==$row_num_my["INCB"] or $res_all[$i]["INCB"] =='None') 
    and ($res_all[$i]["HT"]==$row_num_my["HT"] or $res_all[$i]["HT"] =='None')
    and ($res_all[$i]["LOCATION"]==$row_num_my["RESIDENCE"] or $res_all[$i]["LOCATION"] =='None'))
    {

      $res_mybene[$j]=$res_all[$i];
      $j++;
    };
  }

  // 내 정보랑 맞는 혜택만 C_B테이블에 넣기 위해 연결
  $sql_cb="select * from C_B where id='$sessid'";  
  $result_cb=oci_parse($db,$sql_cb); 
  oci_execute($result_cb);
  $res_cb = array();
  $row_num_cb = oci_fetch_all($result_cb, $res_cb, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

  // 이미 C_B에 있다면 삭제하고 다시 저장한다. 개수가 달라져서 삭제후 저장 다시
if(count($res_cb)){

  // 삭제
 $sql_delete = "delete from C_B where id='$sessid'";
 $_result_del = oci_parse($db, $sql_delete);
 oci_execute($_result_del);
 oci_free_statement($_result_del);
}
// 저장
 for ($k=0; $k<count($res_mybene); $k++){
 $numbn = $res_mybene[$k]["BN"];
 $sql_savecb = "insert into C_B( id, bn) values( '$sessid','$numbn')";
 $_result5 = oci_parse($db, $sql_savecb);
 
 oci_execute($_result5);
oci_free_statement($_result5);

}

  


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
        <nav>
          <ul id="topMenu">
          <?php if(isset($_SESSION['ID']))  { ?>
            <li><a href="logout.php">로그아웃</a></li>
            <li><a href="signout.php">회원탈퇴</a></li>
            <li><a href="mypage.php">마이페이지</a></li>
            <li><a href="allBenefit.php">전체혜택</a></li>
            <?php } else {?>
            <li><a href="logout.php">로그인</a></li>
            <li><a href="signout.php">회원가입</a></li>
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
        <div class="board_info">
            <span id="notice_allcount">- 내가 지원받을 수 있는 공공혜택사업 : <?php echo count($res_mybene); ?>건</span>
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

              <!-- 내정보랑 맞는 혜택 for문으로 돌려서 뽑기 -->

            <?php 
              for($i=0; $i<count($res_mybene); $i++ ){
                echo('
                <tr>
                  <td> '.$res_mybene[$i]["BN"].' </td>
                  <td>
                  <div class="benefit_subject">
                    <a href="">
                    <span>  '.$res_mybene[$i]["BENEFITNAME"].' </span>
                    </a>
                  </div>
                  </td>
                  <td> '.$res_mybene[$i]["DIC"].' </td>
                  <td> '.$res_mybene[$i]["PERIOD"].'  </td>
                </tr>
                ');
            }
            
            ?>
            <!--
                <tr>
                    <td>1</td>
                    <td>
                        <div class="benefit_subject">
                            <a href="">
                                <span>국가장학금 1유형(학생직접지원형)</span>
                            </a>
                        </div>
                    </td>
                    <td>국가장학부</td>
                    <td>2022. 8. 17 ~ 2022. 9 15</td>
                </tr>
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
          </ul>
        </section>
      </footer>
    </div>
  </body>
</html>
<?php


oci_free_statement($result_cb);
oci_free_statement($result_all);
oci_free_statement($result_my);
oci_close($db);

?>