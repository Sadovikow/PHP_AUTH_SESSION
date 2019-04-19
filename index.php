<?
session_start();
//include_once($_SERVER["DOCUMENT_ROOT"]."/asset/functions.php");
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

?>
<title>Кабинет руководителя</title>
<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="/asset/script.js?<?=rand(999, 99999);?>"></script>
<link rel="stylesheet" href="/asset/style.css?<?=rand(999, 99999);?>">
<link rel="stylesheet" href="/asset/fonts.css?<?=rand(999, 99999);?>">
<?

$user["PASSWORD"] = 'd8578edf8458ce06fbc5bb76a58c5ca4';
$user["LOGIN"] = 'admin';
?>

<main id="ext">
	<h1>Кабинет руководителя</h1>
	<br>
	<?
	if($_GET['logout'] == 'Y') {
		$_SESSION["MANAGER"]["AUTHORIZED"] = "N";
		unset($_SESSION["MANAGER"]);
	}
	if($_POST['LOGIN'] && $_POST['PASSWORD']) {
		$_SESSION['MANAGER']['FORM']['LOGIN'] = trim($_POST['LOGIN']);
		$_SESSION['MANAGER']['FORM']['PASSWORD'] = md5($_POST['PASSWORD']);
	}
	/* Поиск компании клиента */

	if($_POST['LOGIN'] && $_POST['PASSWORD'])
	{
		if(($user["PASSWORD"] == $_SESSION['MANAGER']['FORM']['PASSWORD']) && ( isset($_SESSION['MANAGER']['FORM']['PASSWORD'] )))
		{
			$_SESSION["MANAGER"]["AUTHORIZED"] = "Y";
			$_SESSION["MANAGER"]["LOGIN"] = $user["LOGIN"];
		}
		else
		{
			$_SESSION["MANAGER"]["AUTHORIZED"] = "N";
			unset($_SESSION["MANAGER"]["LOGIN"]);
			$WRONG = TRUE;
		}
	}

	if($WRONG)
	{
		echo '<span style="color: red; font-weight: bold;">Неверный логин или пароль</span>';
	}
	?>

	<?if($_SESSION['MANAGER']['AUTHORIZED'] != 'Y'): // АВТОРИЗАЦИЯ ?>
		<?include_once($_SERVER["DOCUMENT_ROOT"]."/auth.php"); // Auth ?>
	<?else: // КОНТЕНТ ЛИЧНОГО КАБИНЕТА ?>
		Вы успешно авторизовались. Здесь будет панель управления.
		<form action="?logout=Y" method="POST">
			<input type="submit" value="Выйти">
		</form>
	<?endif;?>
</main>
<br>
<?
	echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';
?>
