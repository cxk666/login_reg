<?php  
    session_start();
    if(isset($_POST["submit"]) && $_POST["submit"] == "注册")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        $psw_confirm = $_POST["confirm"];  
        if($user == "" || $psw == "" || $psw_confirm == "")  
        {  
            echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";  
        }  
        else 
        {  
            if($psw == $psw_confirm)  
            {  
                $db = new PDO('mysql:host=localhost;dbname=todo_list', 'root', '');
                $sql = 'SELECT * FROM `login` WHERE `username`=:user';
                $p = $db->prepare($sql);
                $p->execute([':user' => $user]);
                $res = $p->fetchAll();
                if(count($res)>0) {
                    echo "<script>alert('用户名已存在！');history.go(-1);</script>";
                }
                else{
                    $psw1=hash('sha256',$psw);
                    $sql="INSERT INTO `login` (`username`,`password`) 
                    VALUE ('$user','$psw1')";    
                    $db->exec($sql);
                    echo "<script>alert('注册成功！');</script>";
                    $url="login.html";
                    echo "<script> window.location.href='$url';</script>";
                }
            }  
            else 
            {  
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";  
            }  
        }  
    }  
    else 
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  
?>