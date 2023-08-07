<?php
// Database Connection :
require_once '../model/dbcon.php';
//--------------------------------------------------------
session_start();
$_SESSION['userid'] = md5(rand());

// Contrôles de saisie pour le nom d'utilisateur
if (isset($_POST['username']) && !empty($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
} else {
    ?>
    <script> alert("Veuillez écrire votre nom"); </script>
    <?php
    
    
    exit; // Terminer le script pour éviter que le code ci-dessous ne s'exécute en cas d'absence de nom.
}

// Contrôles de saisie pour l'adresse e-mail
if (isset($_POST['email']) && !empty($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];
} else {
    ?>
    <script> alert("Veuillez écrire votre adresse e-mail"); </script>
    <?php

    exit; // Terminer le script pour éviter que le code ci-dessous ne s'exécute en cas d'absence d'adresse e-mail.
}

// Contrôles de saisie pour le mot de passe
if (isset($_POST['password']) && !empty($_POST['password'])) {
    // Vous pouvez ajouter d'autres contrôles ici, par exemple, pour vérifier la longueur du mot de passe.
    $_SESSION['password'] = md5($_POST['password']);
} else {
    ?>
    <script> alert("Veuillez écrire votre mot de passe"); </script>
    <?php

    exit; // Terminer le script pour éviter que le code ci-dessous ne s'exécute en cas d'absence de mot de passe.
}

$_SESSION['acctype'] = "simple_user";
//--------------------------------------------------------
$_SESSION['lgdin'] = false;


// Contrôles de saisie supplémentaires avant l'insertion dans la base de données
if (!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) {
    ?>
    <script> alert("Adresse e-mail invalide"); </script>
    <?php
    
    exit;
}

// Autres contrôles de saisie si nécessaire...

// Insertion des données dans la base de données
$stmt = $conn->prepare("INSERT INTO users (user_id, username, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param('ssss', $_SESSION['userid'], $_SESSION['username'], $_SESSION['email'], $_SESSION['password']);
$stmt->execute();
$stmt->close();

// Redirection après insertion réussie
header('Location: http://localhost/adactim/view/index.php');

// Marquer l'utilisateur comme connecté
$_SESSION['lgdin'] = true;

/* $conn->close(); */
?>
