<?php
    session_start();
    if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        if($user == "" || $psw == "")  
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else 
        {  
            $db = new PDO('mysql:host=localhost;dbname=todo_list', 'root', '');
            $psw1=hash('sha256',$psw);
            $sql = 'SELECT * FROM `login` WHERE `username`=:user AND `password`=:psw1';
            $p = $db->prepare($sql);
            $p->execute([':user' => $user, ':psw1' => $psw1]);
            $res = $p->fetchAll();
            if(count($res)>0) {
                $_SESSION['user'] = $user;
                echo "<script> alert('登陆成功！');</script>";
                $url="https://www.baidu.com/";
                echo "<script> window.location.href='$url';</script>";
            }
            else {
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
            }
        }  
    }  
    else 
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  
?>