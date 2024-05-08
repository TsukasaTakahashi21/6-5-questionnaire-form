<?php
$name = $_POST['name'];
$food = $_POST["food"];
$hobby = $_POST["hobby"]; 

$errors = [];
if (empty($name) || empty($food) || empty($hobby)) {
  $errors[] = '「回答者名」「好きな食べ物」「趣味」のどれかが記入されていません!';
}

// データベース接続
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=questionnaireform; charset=utf8',
  $dbUserName,
  $dbPassword
);

// データ追加
$stmt = $pdo->prepare("INSERT INTO bookings (
	name, food_answer, hobby_answer
) VALUES (
	:name, :food, :hobby
)");

$stmt->bindParam( ':name', $name, PDO::PARAM_STR);
$stmt->bindParam( ':food', $food, PDO::PARAM_STR);
$stmt->bindParam( ':hobby', $hobby, PDO::PARAM_STR);

$res = $stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
 
<body>

  <div>
    <!-- エラーの場合 -->
    <?php if (!empty($errors)): ?>
      <?php foreach ($errors as $error): ?>
        <p><?php echo $error."\n"; ?></p>
      <?php endforeach; ?>
      <a href="index.php">アンケート画面へ</a>
    <?php endif; ?>

    <!-- エラーでない場合 -->
    <?php if (empty($errors)): ?>
      <h2>アンケート完了</h2>
      <a href="index.php">アンケート画面へ</a>
    <?php endif; ?>

  </div>
</body>
    
</html>