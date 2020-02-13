<?php
session_start();
require_once 'database.php';
if(!isset($_SESSION['logged_id']))
{
    if (isset($_POST['login']))
    {
        $login = filter_input(INPUT_POST, 'login');
        $pass = filter_input(INPUT_POST, 'pass');
        //echo "Login: ".$login."<br />Hasło: ".$pass;
        

        $userQuery = $db->prepare('SELECT id, password FROM admins WHERE login = :login'); //zapytanie
        $userQuery->bindValue(':login', $login, PDO::PARAM_STR);//dane do zapytania
        $userQuery->execute();//wykonanie zapytania
        //echo $userQuery->rowCount();
        $user = $userQuery->fetch();
        
        //echo $user['id']." ".$user['password'];
        if($user && password_verify($pass, $user['password'])) //jeśli tablica nie jest pusta, czyli znaleziono jednego uzytkownika i hasło z formulara jest takie samo jak zahaszowane hasło w bazie
        {
            $_SESSION['logged_id'] = $user['id'];
            unset($_SESSION['bad_attempt']); //jeśli udało się zalogować to kasujemy zmienną z nieudanym logowaniem
        }
        else //jeśli nie znaleziono uzytkownika i nie udało się zalogować
        {
            $_SESSION['bad_attempt'] = true; //zapisanie zmiennej przetrzymująca nieudaną próbę logowania
            $_SESSION['bad_login'] = $login; //zapisujemy równeiż login aby zostawić go poniej w polu formularza
            header('Location: admin.php');//wracamu do formularza
            exit();//i przerywamy wykonywanie skryptu
        }
    }
    else
    {
        header('Location: admin.php');
        exit();
    }
}

$usersQuery = $db->query('SELECT * FROM consumer');
$users = $usersQuery->fetchAll();

//print_r( $users);

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
            <h1>Lista klientów</h1>
        </header>

        <main>
            <article>
                <table>
                    <thead>
                        <tr><th colspan="2">Łącznie rekordów: <?= $usersQuery->rowCount() ?></th></tr>
                        <tr><th>ID</th><th>Email</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $user)
                        {
                            echo "<tr><td>{$user['id']}</td><td>{$user['email']}</td></tr>";
                        }

                        ?>
                    </tbody>
                </table>
                <p><a href="logout.php">Wyloguj</a></p>
            </article>
        </main>

    </div>

</body>
</html>