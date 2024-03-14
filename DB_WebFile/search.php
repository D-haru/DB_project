<?php
session_start();
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

require('dbcon.php');//db연결

//검색어('key')를 주관부서,혜택명에 맞는 데이터 가져오기  
$searchword = $_GET['key'];
$sc = "SELECT * from benefit where upper(BENEFITNAME) like '%'||upper('$searchword')||'%'or upper(DIC) like '%'||upper('$searchword')||'%' order by bn";
$result = oci_parse($db,$sc);
oci_execute($result);


$array = array();
$row = oci_fetch_all($result, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);



?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8" />
     <title>공공혜택사업</title>
     <link rel="stylesheet" href="css/search.css">
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
         <h1>- 검색한 '<?php echo $searchword?>' 이 포함된 공공혜택사업 목록 -</h1>
         <div class="board_info">
           <span id="notice_allcount">- 총 게시물 : <?php echo $row ?>건</span>
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
             <?php 
             if (count($array) >= 1) {
              for($i=0; $i<$row; $i++ ){  //불러온 데이터 출력
                 echo ('
                <tr>
                  <td> ' . $array[$i]["BN"] . ' </td>
                  <td>
                  <div class="benefit_subject">
                    <a href="">
                    <span>  ' . $array[$i]["BENEFITNAME"] . ' </span>
                    </a>
                  </div>
                  </td>
                  <td> ' . $array[$i]["DIC"] . ' </td>
                  <td> ' . $array[$i]["PERIOD"] . '  </td>
                </tr>
                ');
                 }
                } else { 
                
                echo "<script>alert('검색 결과가 없습니다.')
                location.href = 'index.php'
                </script>";
                
               }           
              ?>
              <!---
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

oci_close($db);
?>