<?php

session_start();

error_reporting( E_ALL );
ini_set( "display_errors", 1 );

require "dbcon.php";

$sessid=$_SESSION['ID'];


// 아이디랑 주민번호 따로 넣어주기 위해 불러옴
$sql1="select rrn from customer where id='$sessid'";  

  $result1=oci_parse($db,$sql1); 
  oci_execute($result1); 

  $row_num1 = oci_fetch_array($result1, OCI_ASSOC);


  // 정보가 이미 들어있다면 ubdate해줘야 한다 없을때만 insert 하기 위해 불러옴
$sql2="select * from persdata where id='$sessid'";

  $result2=oci_parse($db, $sql2);
  oci_execute($result2);

  $res2 = array();
  $row_num2 = oci_fetch_all($result2, $res2, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

  if(count($res2)){
    $id = $_SESSION['ID'];
    $rrn = $row_num1["RRN"];
    $gender = $_POST['gender'];
    $ageG = $_POST['age'];
    $incB = $_POST['income'];
    $ht = $_POST['income2'];
    $residence = $_POST['residence'];

    $sql_update = "update persdata set gender='$gender', ageG='$ageG', incB='$incB', ht='$ht', residence='$residence' where id='$sessid'";
    $_result3 = oci_parse($db, $sql_update);
    oci_execute($_result3);
    
    header("location: my_bene.php");
    
    oci_free_statement($_result3);
    
}else if( isset($_POST['gender']) && isset($_POST['age']) && isset($_POST['income']) && isset($_POST['income2']) && isset($_POST['residence'])){
    // 정보가 들어있지 않을땐 insert 하는 부분

    $id = $_SESSION['ID'];
    $rrn = $row_num1["RRN"];
    $gender = $_POST['gender'];
    $ageG = $_POST['age'];
    $incB = $_POST['income'];
    $ht = $_POST['income2'];
    $residence = $_POST['residence'];

 
    $sql_save = "insert into persdata( id, rrn, gender, ageG, incB, ht, residence) values( '$id','$rrn', '$gender', '$ageG', '$incB', '$ht', '$residence')";
    $_result = oci_parse($db, $sql_save);
    $re = oci_execute($_result);

    
  

    if($_result){
        
        header("location: my_bene.php");
    }else{ 
        echo("실패<br>");
    }
    oci_free_statement($_result);
}
oci_free_statement($result1);
oci_free_statement($result2);
oci_close($db);
?>