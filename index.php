<?php
  require_once './user/access.class.php';
  require_once 'General.class.php';




?>


<html>
<head>
  <title>
    Emblem
  </title>
</head>
<body>



<div class="signup">
  <form method="POST" action="index.php">
メールアドレス：<input type="text" name="mail"><br>
パスワード：<input type="password" name="pass"><br>
名前：<input type="text" name="name"><br>
誕生日：<input type="text" name="birth"></br>
<input type="submit" name="signup">
  </form>
</div>


<?php
function register() {
  $user = new flexibleAccess();
  $data = array(
      'mail' => $_POST['mail'],
      'pass' => $_POST['pass'],
      'name' => $_POST['name'],
      'birth' => $_POST['birth'],
    );
  $id = $user->insertUser($data);
  if ($id==0) {
    echo 'User not registered';
  } else {
    echo 'User registered with user id' . $id;
  }
}

if(isset($_POST['signup'])){
  $error = "";
  if($_POST['mail']==""){ $error = "メールアドレス未入力<br>"; }
  if($_POST['pass']==""){ $error = "パスワード未入力<br>"; }
  if($_POST['name']==""){ $error = "名前未入力<br>"; }
  if($_POST['birth']==""){ $error = "誕生日未入力<br>"; }
  if($error){
    echo $error;
  }else{
    register();
  }
}




?>


</body>
</html>
