<?php

    $username = @$_POST["username"];
    $password = @$_POST["password"];


    if($username == "" || $password == ""){
        // 只要php碰到了die ，其后代码不执行
        die("参数不全，缺少账号或密码");
    }


    $con = mysql_connect("localhost","root","123");

    if(!$con){

        die( "数据库连接失败" . mysql_error());
    }

    mysql_select_db("userlist",$con);
    if(mysql_error()){
        die( "数据库选中失败" . mysql_error());
    }

    // 如果用户名重复，因为我们没有逻辑进行判断，所以同用户名的数据可以重复插入；
    // 辨别用户名是否存在，如果存在，阻止写入数据库

    $sql_select_all = "SELECT username FROM detaillist where username ='$username'";

    // 查询结果 ;
    $select_res = mysql_query($sql_select_all);
    // die($select_res);

    // 遍历数据库资源方式
    while($row = mysql_fetch_array($select_res)){
        // Array => json(字符串);
        // echo json_encode($row) . "<br />";
        // echo $row["username"] . "<br />";
        if($row["username"] == $username){
            die("用户名重名");
        }
    }


    $password = md5($password);
    $sql_insert_item = "INSERT INTO detaillist (username , password)
                                  VALUES 
                                  ('$username' , '$password');";

    $insert_res = mysql_query($sql_insert_item);

    if(!$insert_res){
        echo "数据库插入错误" . mysql_error();
    }
    echo $insert_res;

    mysql_close($con);
