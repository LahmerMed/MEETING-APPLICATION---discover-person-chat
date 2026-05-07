<?php
echo "<h1>Installation de SocialApp</h1>";

try {
    $pdo = new PDO(
        "mysql:host=localhost;charset=utf8mb4",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    
    echo "<p style='color: green;'>✓ Connexion à MySQL réussie</p>";
    
    $schema = file_get_contents(__DIR__ . '/database/schema.sql');
    $pdo->exec($schema);
    echo "<p style='color: green;'>✓ Base de données et tables créées avec succès</p>";
    
    $seed = file_get_contents(__DIR__ . '/database/seed.sql');
    $pdo->exec($seed);
    echo "<p style='color: green;'>✓ Données de test insérées</p>";
    
    echo "<hr>";
    echo "<h2>Installation terminée !</h2>";
    echo "<p><strong>Identifiants admin :</strong></p>";
    echo "<ul>";
    echo "<li>Email : admin@socialapp.com</li>";
    echo "<li>Mot de passe : password</li>";
    echo "</ul>";
    echo "<p><strong>Utilisateurs de test :</strong></p>";
    echo "<ul>";
    echo "<li>john@example.com / password</li>";
    echo "<li>sarah@example.com / password</li>";
    echo "<li>mike@example.com / password</li>";
    echo "<li>emma@example.com / password</li>";
    echo "</ul>";
    echo "<p><a href='index.php' style='display: inline-block; background: #667eea; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 20px;'>Accéder au site</a></p>";
    echo "<p style='color: red; margin-top: 20px;'><strong>IMPORTANT :</strong> Supprimez le fichier setup.php après l'installation pour des raisons de sécurité !</p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
}
