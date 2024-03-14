<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
session_start();

require "dbcon.php"; //db에 연결

$idch = $_SESSION['ID'];

//customer 테이블에 id 와 로그인 id같으면 삭제 
$sql_d = "delete from customer where ID = '$idch'";
$result = oci_parse($db,$sql_d);
oci_execute($result);

require "logout.php";

echo "<script>alert('회원탈퇴가 완료되었습니다.')
location.href = 'register_view.php'
</script>";

oci_free_statement($result);
oci_close($db);
?>