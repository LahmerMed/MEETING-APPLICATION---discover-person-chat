USE socialapp;

-- Insertion de données de test pour les utilisateurs
INSERT INTO users (name, email, password, age, city, gender, bio, interests, visibility, status) VALUES 
('John Doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 28, 'Paris', 'male', 'Passionné de photographie et de voyages.', '["sport", "music", "travel"]', 'public', 1),
('Sarah Martin', 'sarah@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 28, 'Paris', 'female', 'Amoureuse de la nature et des animaux.', '["cooking", "art", "music"]', 'public', 1),
('Mike Johnson', 'mike@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 32, 'Lyon', 'male', 'Fan de cinéma et de gaming.', '["cinema", "tech"]', 'public', 1),
('Emma Wilson', 'emma@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 25, 'Marseille', 'female', 'Chef pâtissier et amoureuse de la bonne cuisine.', '["cooking", "travel"]', 'public', 1);
-- Mot de passe pour tous les utilisateurs de test : password
