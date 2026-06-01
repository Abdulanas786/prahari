<?php
$files = ['praharis' => 'Prahari', 'cases' => 'Cases', 'challans' => 'Challans', 'payments' => 'Payments'];
foreach ($files as $name => $title) {
    $path = 'resources/views/admin/settings/partials/_'.$name.'.blade.php';
    $content = file_get_contents($path);
    // Replace .addBtn with .add$titleBtn in JS
    $content = str_replace('\'.addBtn\'', '\'.add'.$title.'Btn\'', $content);
    // Replace addBtn class in HTML
    $content = str_replace('addBtn', 'add'.$title.'Btn', $content);
    file_put_contents($path, $content);
    echo "Updated _$name.blade.php\n";
}
