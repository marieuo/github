<html>
 <body>

<form action="mission_4-1.php"method="post">

<div>
 <label for="name"></label>
 <input type="text" name="name" value="<?php echo $hensyu[1]; ?>"placeholder="名前">
</div>

<div>
 <label for="text"></label>
 <input type="text"name="text"value="<?php echo $hensyu[2]; ?>"placeholder="コメント">

	 <label for="name"></label>
	 <input type="hidden" name="toukou" value="<?php echo $hensyu[0]; ?>" placeholder="編集した投稿番号">

<div>
 <label for="password"></label>
 <input type="password" name="pass" value=""placeholder="パスワード">


	
	<input type="submit"value="送信">
	</div>


<br/>
		<form action="mission_4-1.php"method="post">

		<div>
 		<label for="text"></label>
 		<input type="text"name="delete"value=""placeholder="削除対象番号">
		<div>
		<label for="password"></label>
 		<input type="password" name="pass2" value=""placeholder="パスワード">

		<input type="submit"value="削除">
		</div>
<br/>

		<form action="mission_4-1.php"method="post">

		<div>
 		<label for="text"></label>
 		<input type="text"name="edit"value="" placeholder="編集対象番号">
		<div>
 		<label for="password"></label>
 		<input type="password" name="pass3" value=""placeholder="パスワード">

		<input type="submit"value="編集">
		</div>

</form>
 </body>
</html>

<?php
//接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);

/*if (!$pdo) {
    die('接続失敗です。'.mysql_error());
}
print('<p>接続に成功しました。</p>');
*/

$sql="CREATE TABLE tb" 
//testという名前のテーブル作成
."("
."id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,"
//primary keyは自動で投稿番号を追加する

."name char(32),"
."comment TEXT,"
."created DATETIME"
.");";
$stmt = $pdo->query($sql);

$sql="SHOW CREATE TABLE FROM tb";
//var_dump ($stmt);
/*
if (!$sql){
    die('データベース選択失敗です。'.mysql_error());
}
print('<p>uriageデータベースを選択しました。</p>');
*/

$date = new DateTime();
$date = $date->format('Y/m/d H:i:s');

$sql=$pdo->prepare("INSERT INTO tb(id,name,comment,created)VALUES(:id,:name,:comment,:created)");
//テーブル名「test」のname,commentに、それぞれ送信された名前、コメントを書き込む

$sql -> bindParam(':id',$n,PDO::PARAM_STR);
$sql -> bindParam(':name',$name2,PDO::PARAM_STR);
$sql -> bindParam(':comment',$comment2,PDO::PARAM_STR);
$sql -> bindParam(':created',$date,PDO::PARAM_STR);
//bindPapamの値「name」「comment」は値をバインドした後、セットされた変数の内容が変化したら、その新しいものがつかわれる

/*if (!$sql){
    die('選択失敗です。'.mysql_error());
}
print('<p>選択しました。</p>');
*/
$name=$name2;
$comment=$comment2;
$name2=($_POST["name"]);
$comment2=($_POST["text"]);

$sql->execute();

//データを表示
$sql='SELECT*FROM tb';
$results=$pdo->query($sql);
//var_dump ($row);
foreach($results as $row){
echo $row['id'].' ';
echo $row['name'].' ';
echo $row['comment'].' ';
echo $row['created'].'<br>';
//datetimeを使用すると入力しても何も表示されない→うまくインサートされてない？

//echo date('Y/m/d H:i:s').'<br>';
//dateで直接表示するように指示
//→表示はされるものの、全ての投稿の日時が同じになってしまう。インサート時にbindparamが機能していない？
}

?>

<?php
//削除機能
//pass name 削除→pass2
//パスワードはtechである
$pas_0=tech;

//pas2はフォーム上にパスワードが送信されたことを示す
$pas2=$_POST["pass2"];
$delete=($_POST["delete"]);

if($pas2==$pas_0){

$id = 1;

$sql = "delete from tb where id=$id";
$result = $pdo->query($sql);
}

?>