<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et sécurisation des données
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

    // Validation simple (vérifier que les champs ne sont pas vides)
    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        
        // --- Début de la section d'envoi d'email ---

        // !! IMPORTANT : Remplacez cette adresse par votre propre adresse e-mail !!
        $destinataire = "votre-adresse-email@example.com";

        // Sujet de l'e-mail
        $sujet = "Nouveau message de " . $name . " via le formulaire de contact";

        // Construction du corps de l'e-mail
        $contenu = "Bonjour,\n\n";
        $contenu .= "Vous avez reçu un nouveau message depuis votre formulaire de contact.\n\n";
        $contenu .= "Nom : " . $name . "\n";
        $contenu .= "Email : " . $email . "\n";
        $contenu .= "Message :\n" . $message . "\n";

        // En-têtes de l'e-mail (essentiel pour la délivrabilité)
        // !! IMPORTANT : Remplacez "contact@votresite.com" par une adresse de votre domaine !!
        $entetes = "From: contact@votresite.com\r\n";
        $entetes .= "Reply-To: " . $email . "\r\n"; // Permet de répondre directement à l'expéditeur
        $entetes .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $entetes .= "X-Mailer: PHP/" . phpversion();

        // Envoi de l'e-mail
        if (mail($destinataire, $sujet, $contenu, $entetes)) {
            // Si l'envoi réussit
            echo "<h1>Merci !</h1>";
            echo "<p>Votre message, " . $name . ", a bien été envoyé. Nous vous répondrons dès que possible.</p>";
        } else {
            // Si l'envoi échoue
            echo "<h1>Erreur</h1>";
            echo "<p>Désolé, une erreur est survenue lors de l'envoi de votre message. Veuillez réessayer plus tard.</p>";
        }
        
        // --- Fin de la section d'envoi d'email ---

    } else {
        // Si un champ est vide ou l'email est invalide
        echo "<h1>Erreur</h1>";
        echo "<p>Veuillez remplir tous les champs correctement avant de soumettre le formulaire.</p>";
    }
} else {
    // Si la page est accédée directement
    echo "Accès non autorisé.";
}
?>