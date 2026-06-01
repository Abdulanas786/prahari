<?php
$files = ['praharis' => 'Prahari', 'cases' => 'Cases', 'challans' => 'Challans', 'payments' => 'Payments'];
foreach ($files as $name => $title) {
    $path = 'resources/views/admin/settings/partials/_'.$name.'.blade.php';
    $content = file_get_contents($path);
    
    // We only want to remove `new bootstrap.Modal... show()` from the .addXYZBtn click listener.
    // The easiest way is to use a regex that matches the .addBtn block and replaces the modal part.
    // Let's just find "let modal = new bootstrap.Modal(document.getElementById('settings" and remove it ONLY if it's inside the addBtn.
    // Actually, I can just do a precise replace for the string I know is there in `_praharis`:
    $target1 = "let modal = new bootstrap.Modal(document.getElementById('settingsPrahariModal'));\n                  modal.show();";
    $content = str_replace($target1, "", $content);
    
    // In _cases, it might be new bootstrap.Modal('#settingsCasesModal').show();
    $target2 = "new bootstrap.Modal('#settingsCasesModal').show();";
    $content = str_replace($target2, "", $content);

    // In _challans
    $target3 = "new bootstrap.Modal('#settingsChallansModal').show();";
    $content = str_replace($target3, "", $content);

    // In _payments
    $target4 = "new bootstrap.Modal('#settingsPaymentsModal').show();";
    $content = str_replace($target4, "", $content);

    file_put_contents($path, $content);
    echo "Updated _$name.blade.php\n";
}
