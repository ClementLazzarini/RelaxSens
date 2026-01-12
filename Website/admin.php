<?php
session_start();
require 'config.php';

$message = "";

// 1. GESTION DU MOT DE PASSE
if (isset($_POST['password']) && $_POST['password'] === ADMIN_PASSWORD) {
    $_SESSION['logged_in'] = true;
}

// 2. TRAITEMENT DU FORMULAIRE
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_POST['save'])) {
    
    // Récupération des textes
    $newData = [
        'titre' => $_POST['titre'],
        'texte' => $_POST['texte'],
        'image' => $_POST['current_image'] 
    ];

    // Gestion de l'upload d'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = 'img/';
        $fileName = 'offre_du_moment_' . time() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $uploadFile = $uploadDir . $fileName;

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $newData['image'] = $uploadFile;
            }
        }
    }

    // Sauvegarde
    file_put_contents('offre_data.json', json_encode($newData));
    $message = "Offre mise à jour avec succès ! ✨";
}

// Chargement des données
$currentData = file_exists('offre_data.json') ? json_decode(file_get_contents('offre_data.json'), true) : ['titre'=>'','texte'=>'','image'=>''];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Relax'Sens</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #E72E93; /* Le rose du site */
            --bg-soft: #FEEEF6; /* Le fond clair du site */
            --white: #ffffff;
            --text: #333;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-soft);
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 30px; /* Bien rond comme demandé */
            box-shadow: var(--shadow); /* Ombre douce */
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease;
        }

        h1 {
            text-align: center;
            color: var(--primary);
            margin-top: 0;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #666;
            margin-top: 1.5rem;
        }

        input[type="text"],
        input[type="password"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 15px; /* Champs arrondis */
            background-color: #fafafa;
            font-family: inherit;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(231, 46, 147, 0.1);
            background-color: #fff;
        }

        .btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 50px; /* Bouton pilule */
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 2rem;
            transition: transform 0.2s, background-color 0.2s;
            font-weight: 500;
        }

        .btn:hover {
            background-color: #c21c76;
            transform: translateY(-2px);
        }

        .message-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 1.5rem;
            border: 1px solid #a7f3d0;
        }

        .current-img-preview {
            margin-top: 10px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-width: 100%;
            height: auto;
            max-height: 150px;
            object-fit: cover;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #888;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        /* Petit effet d'animation à l'arrivée */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .container {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Relax'Sens</h1>
        
        <?php if (!isset($_SESSION['logged_in'])): ?>
            <form method="post">
                
                <label>Mot de passe</label>
                <input type="password" name="password" required placeholder="Votre mot de passe">
                
                <button type="submit" class="btn">Connexion</button>
            </form>
            <a href="https://www.relaxsensdigoin.fr/" target="_blank" class="back-link">← Retour au site</a>

        <?php else: ?>
            
            <?php if($message): ?> 
                <div class="message-success"><?= $message ?></div> 
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <label>Titre de l'offre</label>
                <input type="text" name="titre" value="<?= htmlspecialchars($currentData['titre'] ?? '') ?>" required placeholder="Ex: Offre Spéciale Fête des Mères">

                <label>Description</label>
                <textarea name="texte" rows="6" required placeholder="Détails de l'offre..."><?= htmlspecialchars($currentData['texte'] ?? '') ?></textarea>

                <label>Image de l'offre</label>
                <input type="file" name="image">
                <input type="hidden" name="current_image" value="<?= htmlspecialchars($currentData['current_image'] ?? $currentData['image'] ?? '') ?>">

                <?php if(!empty($currentData['image'])): ?>
                    <div style="text-align:center; margin-top:1rem;">
                        <p style="font-size:0.8rem; color:#888; margin-bottom:0.5rem;">Image actuelle :</p>
                        <img src="<?= $currentData['image'] ?>" class="current-img-preview">
                    </div>
                <?php endif; ?>

                <button type="submit" name="save" class="btn">Mettre à jour le site</button>
            </form>
            
            <a href="https://www.relaxsensdigoin.fr/" target="_blank" class="back-link">Voir le site en direct (Nouvel onglet) ↗</a>
        <?php endif; ?>
    </div>
</body>
</html>