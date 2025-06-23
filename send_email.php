<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = strip_tags(trim($_POST["nom"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telephone = strip_tags(trim($_POST["telephone"]));
    $sujet_form = strip_tags(trim($_POST["sujet"]));
    $message = trim($_POST["message"]);

    // Validation simple
    if (empty($nom) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($sujet_form) || empty($message)) {
        // En cas d'erreur, rediriger ou afficher un message
        http_response_code(400);
        echo "Veuillez remplir tous les champs obligatoires.";
        exit;
    }

    // Adresse de destination
    $destinataire = "bastien.caujolle@gmail.com";

    // Sujet de l'email
    $sujet_email = $sujet_form;

    // Corps de l'email
    $contenu_email = "Nom: $nom\n";
    $contenu_email .= "Email: $email\n";
    if (!empty($telephone)) {
        $contenu_email .= "Téléphone: $telephone\n";
    }
    $contenu_email .= "Sujet: $sujet_form\n\n";
    $contenu_email .= "Message:\n$message\n";

    // Entêtes de l'email
    $headers = "From: \"$nom\" <contact@machineacoudre-med.com>\r\n";
    $headers .= "Reply-To: \"$nom\" <$email>\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Envoi de l'email
    if (mail($destinataire, $sujet_email, $contenu_email, $headers)) {
        // Redirection vers une page de succès (à créer)
        header("Location: /succes.html");
        exit;
    } else {
        // En cas d'échec de l'envoi
        http_response_code(500);
        echo "Oups! Une erreur s'est produite et nous n'avons pas pu envoyer votre message.";
        exit;
    }

} else {
    // Accès non autorisé
    http_response_code(403);
    echo "Il y a eu un problème avec votre envoi, veuillez réessayer.";
    exit;
}
?> 