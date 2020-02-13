<?php

session_start();

if (isset($_POST['email']))
{
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); //funkcja filtrująca, tutaj wykorzysana do walidacji email, trzy parametry 1-typ danych wejsciowych, 2-index zmiennej z naszej tablicy $_POST, 3-rodzaj filrtu walidującego, tutaj email

    if(empty($email)) //funkcaja empty sprawdza czy zmienna jest pusta albo ma wartość null, 0, pusta tablica, itp.
    {
        $_SESSION['given_email'] = $_POST['email']; //zmienna przetrzymująca podany email
        header('Location: kontakt.php');
    } 
    else //jeśli podano maila i jest prawidłowy to sprawdzamz czy istnieje już w bazie
    {
        
        require_once 'database.php';
        $_SESSION['ok_email'] = $email;//zapisujemy podanego poprawnego maila aby potem wyświetlic go w polu formularza gdy nie zaznaczymy captcha 
        $mailQuery = $db->prepare('SELECT id, email FROM consumer WHERE email = :email'); //zapytanie
        $mailQuery->bindValue(':email', $email, PDO::PARAM_STR);//dane do zapytania
        $mailQuery->execute();//wykonanie zapytania
        //echo $userQuery->rowCount();
        $mail = $mailQuery->fetch();

        if($mail) // jesli podany email istnie juz w bazie zapisujemy go do zmiennej seysnej i wracamy do pliku index
        {
            $_SESSION['existing_email'] = $mail;
            header('Location: kontakt.php');
            exit();
        }
        else
        {     
            //sprawdzenie captcha
            $secret_key="6LflLtgUAAAAABNcKVnLqN0dURhJckz_4w3mrIAA";

            $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

            $answer = json_decode($check);

            if($answer->success==false)
            {  
                $_SESSION['no_captcha'] = "<p>Potwierdź, że nie jesteś botem</p>";
                header('Location: kontakt.php');
                exit();
            }
            else
            {
                $query =  $db->prepare('INSERT INTO consumer VALUES (NULL, :email)');
                $query->bindValue(':email', $email, PDO::PARAM_STR);//1 parametr - etykieta do ktorej przekazujemy zmeinna, 2 - zmienna którą przekazujemy, 3 - typ zmiennej, tutaj string
                $query->execute();
                //echo "POST: ".$_POST['email']."<br />";
                //echo "email: ".$email."<br />";
            }
        }
    }
}
else
{
    header('Location: kontakt.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>Patryk Pikor Fotografia</title>
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
            <h1>Drogi Kliencie!</h1>
        </header>

        <main>
            <article>
                <p>Dziękuję za kontakt! Skontaktuje się z Tobą najszybciej jak to możliwe ;) </p>
            </article>
        </main>

    </div>

</body>
</html>