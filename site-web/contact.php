<?php


    // Traitons uniquement les demandes POST.

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Obtenons les champs du formulaire et supprimons les espaces.

        $nom = strip_tags(trim($_POST["nom"]));

$nom = str_replace(array("\r","\n"),array(" "," "),$nom);

        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

        $subject = trim($_POST["subject"]);

        $contenuMsg = trim($_POST["contenuMsg"]);


        // Vérifions que les données ont été envoyées par l'expéditeur.

        if ( empty($nom) OR empty($subject) OR empty($contenuMsg) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Définissons un code de status 400 (mauvaise demande) et quittons.

            http_response_code(400);

            echo "Oups! Il y a eu un problème avec votre soumission. Veuillez remplir le formulaire et réessayer.";

            exit;

        }


        require_once "../database/db.php";


        $sql = "INSERT INTO message (nom, contenuMsg, email, subject) VALUES (?,?,?,?)";

    $db->prepare($sql)->execute([$nom, $contenuMsg, $email, $subject]);

    }
    //  else {

    //     // au cs où c'est pas une demande POST, définissons un code de status 403 (interdit).

    //     http_response_code(403);

    //     echo "Il y a eu un problème avec votre soumission, veuillez réessayer.";

    // }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Web - <?= $pageName ?> | BAD-EVENT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style>

body {
    margin: 0;
    padding: 0;
}

body:before {
    content: '';
    position: fixed;
    width: 100vw;
    height: 100vh;
    background-image: url(./img/dd.jpg); 
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    -webkit-filter: blur(10px);
    -moz-filter: blur(10px);
    filter:
}

.btn {
    background: transparent;
    width: 50px;
    border: none;
}

.card{
    background: rgba(56, 50, 50, 0.6);
    width: 400px;
    height: 400px;
}

form {
    top: 50%;
    -webkit-trasform: 
    -moz-transform: translate (-50% , -50%);
    -ms-transform: translate (-50% , -50%);
    -o-transform: translate (-50% , -50%);
    transform: translate (-50% , -50%);
    width: 400px;
    height: 400px;
}

.form-control {
    background: transparent;
}

input[type="text"] {
    border: none;
    color: #fff;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 35px;
    font-size: 15px;
}

input[type="submit"]  {
    border: none;
    border-radius: 25px;
    outline: none;
    width: 270px;
    height: 35px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    margin-top: 15px;
    margin-left: 55px;
}

#contenuMsg {
    color: #fff;
    outline: none;
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
}

label {
    color: #ffffff;
    padding: 0;
    padding-left: 12px;
    margin: 0; 
    font-weight: normal;
}

  p{
    color: #000;
    font-size: 20px;
    font-weight: bold;
    font-family: verdana;
  }

</style>
</head>

<body>
<div class="container-fluid">
        <div class="row">
        <div class="col-md-4 mt-2">
        <button class="btn btn-danger">
<a style="color: #ffc500;" href="index.php"><i class="fa fa-long-arrow-left"></i></a>
        </button>
        </div>
            <div class="col-md-4 mt-5">
           <p class="text-center"> <u> NOUS CONTACTER </u> </p>
            <div class="card">           
                <form id="formulairedecontact" action="contact.php" method="POST">
                <div class="form-row mt-4">
                <div class="col-md-6">
            <label for="name"> <b> Nom & Prénoms </b></label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="nom et prénoms">
            </div>
            <div class="col-md-6">
            <label for="email"> <b> Email </b> </label>
            <input type="text" class="form-control" id="email" name="email" placeholder="votre email svp">
        </div>
        </div>
        <br>

            <div class="form-row">
            <div class="col-md-12">
            <label for="subject"> <b> Objet </b> </label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Veuillez saisir l'objet de votre message...">
            </div>
            </div>
            <br>

        <div class="form-group">
        <label for="message"> <b> Message </b> </label>
        <div class="form-row">
        <div class="col-md-12">
        <textarea class="form-control" id="contenuMsg" name="contenuMsg" rows="3" style="resize: none"  placeholder="Saissisez votre message ici..."></textarea>
        </div>
        </div>
        </div>
        <div id="msgErreur" style="color: #fff">
       <center></center> 
        </div>

<input type="submit" value="Envoyer" style="background: #ff1300 !important">

</form>
</div>
</div> 
</div> 
<div class="col-md-4"></div>
</div>
</div>
    <script src="c-ajax.js">
    <script src="jquery-3.5.1.min.js">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
    
</body>
</html>