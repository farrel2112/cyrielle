<?php
if (isset($_POST['rejoins nous'])) {
    if (isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['numero_whatsapp']) && isset($_POST['numero_phone']) && isset($_POST['adulte']) && isset($_POST['enfant']) && isset($_POST['message']) && !empty($_POST['email']) && !empty($_POST['nom']) && !empty($_POST['numero_whatsapp']) && !empty($_POST['numero_phone']) && !empty($_POST['adulte']) && !empty($_POST['enfant']) && !empty($_POST['message'])) {
        // On protège les données entrées par l'utilisateur
        $email = htmlspecialchars($_POST['email']);
        $nom = htmlspecialchars($_POST['nom']);
        $numero_whatsapp = htmlspecialchars($_POST['numero_whatsapp']);
        $numero_phone = htmlspecialchars($_POST['numero_phone']);
        $adulte = htmlspecialchars($_POST['adulte']);
        $enfant = htmlspecialchars($_POST['enfant']);
        $message = htmlspecialchars($_POST['message']);

        // On vérifie si l'email entré en est bien un
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            die('Veuillez entrer une adresse email correct');
        }
        // On se connecte à la base de données
        try {
            $bdd = new PDO('mysql:host=Localhost;dbname=test', 'root', '');
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
       
        // On insère l'utilisateur
        $insert = $bdd->prepare('INSERT INTO destination_louango VALUES(null,:nom,:email, :numero_whatsapp,:numero_phone,:adulte,:enfant,:message)');
        $insert->execute(array(
            'nom' => $nom,
            'email' => $email,
            'numero_whatsapp' => $numero_whatsapp,
            'numero_phone' => $numero_phone,
            'adulte' => $adulte,
            'enfant' => $enfant,
            'message' => $message

        ));
    }else {
        die('Veuillez remplir tous les champs');
    }
}

?>