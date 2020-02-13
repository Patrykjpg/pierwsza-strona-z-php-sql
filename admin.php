<?php
session_start();
if (isset($_SESSION['logged_id']))
{
    header('Location: list.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Panel administracyjny</title>
	<meta name="description" content="Fotograf Patryk Pikor">
	<meta name="keywords" content="fotografia, fotograf slubny, zdjecia, patryk, pikor, photography">
	<meta name="author" content="Patryk Pikor">
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">

        <header>
            <h1>Admin</h1>
        </header>

        <main>
            <article>
                <form method="post" action="list.php">
                    <label>Login <input type="text" name="login"
                    <?= isset($_SESSION['bad_login']) ? 'value="'.$_SESSION['bad_login'].'"' : ''//jeśli login jest niepoprawny to zostawiamy go w polu input, zeby nie było puste?>
                    ></label>
                    <label>Hasło <input type="password" name="pass"></label>
                    <input type="submit" value="Zaloguj się!">
                    <?php
                    if(isset($_SESSION['bad_attempt']))
                    {
                        echo '<p>Niepoprawny login lub hasło!</p>';
                        unset($_SESSION['bad_attempt']);
                        unset($_SESSION['bad_login']);
                    }
                    ?>
                </form>
            </article>
        </main>

    </div>
</body>
</html>