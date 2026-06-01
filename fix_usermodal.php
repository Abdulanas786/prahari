<?php
$path = 'resources/views/admin/settings/partials/_praharis.blade.php';
$content = file_get_contents($path);

// Replace userModal with settingsPrahariModal
$content = str_replace('userModal', 'settingsPrahariModal', $content);

// Also remove the programmatic modal opening from addPrahariBtn since we are using data-bs-toggle
// Regex to find and remove: let modal = new bootstrap.Modal(document.getElementById('settingsPrahariModal')); \n modal.show();
// Actually let's use a robust regex to remove the modal opening inside the click handler:
$content = preg_replace('/let\s+modal\s*=\s*new\s+bootstrap\.Modal\(document\.getElementById\(\'settingsPrahariModal\'\)\);\s*modal\.show\(\);/', '', $content);

file_put_contents($path, $content);
