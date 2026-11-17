<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: appreciation.php', true, 303);
    exit;
}

$nom = isset($_POST['nom']) && is_string($_POST['nom']) ? trim($_POST['nom']) : '';
$numero = isset($_POST['numero']) && is_string($_POST['numero']) ? trim($_POST['numero']) : '';
$commentaire = isset($_POST['commentaire']) && is_string($_POST['commentaire']) ? trim($_POST['commentaire']) : '';

if ($nom === '' || strlen($nom) > 600 || $numero === '' || strlen($numero) > 120 || $commentaire === '' || strlen($commentaire) > 20000) {
    http_response_code(422);
    $message = 'Vérifiez les champs : ils sont tous obligatoires et doivent respecter les longueurs maximales indiquées.';
} else {
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=test;charset=utf8mb4',
            'root',
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
        );
        $requete = $bdd->prepare('INSERT INTO appreciation (nom, numero, commentaire) VALUES (:nom, :numero, :commentaire)');
        $requete->execute(array(':nom' => $nom, ':numero' => $numero, ':commentaire' => $commentaire));
        header('Location: appreciation.php?success=1', true, 303);
        exit;
    } catch (PDOException $e) {
        error_log('Échec de l’enregistrement d’une appréciation : ' . $e->getMessage());
        http_response_code(500);
        $message = 'Votre appréciation n’a pas pu être enregistrée. Veuillez réessayer plus tard.';
    }
}

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Envoi impossible — Faso Ri Nondo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="site.css">
  </head>
  <body>
    <nav class="navbar navbar-dark site-nav">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="projet.html">
          <img src="logo.png" alt="" width="44" height="44" class="brand-logo">
          <span>Faso Ri Nondo</span>
        </a>
      </div>
    </nav>
    <main class="container page-wrap">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="alert alert-danger" role="alert">
            <h1 class="h4">Envoi impossible</h1>
            <p class="mb-0"><?php echo e($message); ?></p>
          </div>
          <a class="btn btn-brand" href="appreciation.php">Retour au formulaire</a>
        </div>
      </div>
    </main>
    <footer class="site-footer">
      <div class="container"><a href="projet.html">Retour à l’accueil</a></div>
    </footer>
  </body>
</html>
