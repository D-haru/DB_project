<?php

require 'dbcon.php'; //DB 연결//

if(isset($_POST['save']))   //저장버튼으로 빈칸이 있는지 확인//
{
    function input($pp) 
    {   

        $pp = trim($pp);
        $pp = stripslashes($pp);
        $pp = htmlspecialchars($pp);
    
        return $pp;
    }

    $name = input($_POST['name']);
    $id = input($_POST['id_input']);
    $pw = input($_POST['pw_input']);
    $RN = input($_POST['RN_input']);
    $email = input($_POST['email_input']);
    
    $info = "name=".$name."&id=".$pw."&pw=".$pw."&rrn=".$RN."&email=".$email;
    
    if(empty($name))
    {
        header("location: register_view.php?error=이름이 비어있습니다.&$info");
        exit();
    }else if(empty($id)) {

        header("location: register_view.php?error=아이디가 비어있습니다.&$info");
        exit();
        
    }
    else if(empty($pw)) {
        
        header("location: register_view.php?error=비밀번호가 비어있습니다.&$info");
        exit();

    }
    else if(empty($RN)) {
        
        header("location: register_view.php?error=주민번호가 비어있습니다.&$info");
        exit();

    }
    else if(empty($email)) {
        
        header("location: register_view.php?error=이메일이 비어있습니다.&$info");
        exit();

    }
    else {

        $pw = base64_encode($pw); //암호화

        /* id,email,주민번호 db에서 불러와서 유저가 입력한 id,email,주민번호 중복확인    */
        $sql_var = "SELECT* FROM customer where ID = '$id' or email = '$email' or RRN = '$RN'"; 
        $send = oci_parse($db,$sql_var);
        oci_execute($send);
        $row = oci_fetch_array($send,OCI_ASSOC);
        
        if($row['ID'] == $id ) {

            header("location: register_view.php?error=아이디가 중복입니다.");
            exit();
    
        } else if ($row['EMAIL'] == $email) {

            header("location: register_view.php?error=이메일이 중복입니다.");
            exit();

        }else if ($row['RRN'] == $RN) {

            header("location: register_view.php?error=주민등록번호가 중복입니다.");
            exit();
        }
        else {
            //모두 입력했다면 ID,PW,NAME,EMAIL,RRN을 DB에 저장
            $sql_save = "insert into customer(ID, PW, NAME, EMAIL, RRN) values('$id','$pw','$name','$email','$RN')";
            $result = oci_parse($db,$sql_save);
            oci_execute($result);
            oci_free_statement($result);


            if ($result) {
                
                echo "<script>alert('회원가입이 완료되었습니다.')
                location.href = 'login_view.php'
                </script>";
            }

            else 
            {
            header("location: register_view.php?error=가입에 실패했습니다.");
            exit();
            }
        }
    }
}

else {
    header("location: index_view.php");
    exit();
}
oci_free_statement($ret);
oci_close($db);

?>