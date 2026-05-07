<?php
function upload_file($file, $allowed_types = ['image/jpeg', 'image/png', 'image/gif'], $max_size = 5242880) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Erreur lors du téléchargement'];
    }

    if ($file['size'] > $max_size) {
        return ['success' => false, 'message' => 'Fichier trop volumineux'];
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($file['tmp_name']);
    
    if (!in_array($mime_type, $allowed_types)) {
        return ['success' => false, 'message' => 'Type de fichier non autorisé'];
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $destination = UPLOAD_DIR . '/' . $filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return ['success' => true, 'filename' => $filename, 'path' => '/assets/uploads/' . $filename];
    }

    return ['success' => false, 'message' => 'Erreur lors de l\'enregistrement du fichier'];
}
