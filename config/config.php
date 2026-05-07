<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'socialapp');
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', '/projet php');
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads');
define('MAX_FILE_SIZE', 5242880);

if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
}
