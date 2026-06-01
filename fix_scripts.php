<?php
$files = ['praharis', 'cases', 'challans', 'payments', 'reports'];
foreach ($files as $name) {
    $path = 'resources/views/admin/settings/partials/_'.$name.'.blade.php';
    $content = file_get_contents($path);
    // Find where the script tag starts
    if (preg_match('/<script[\s>]/', $content, $matches, PREG_OFFSET_CAPTURE)) {
        $pos = $matches[0][1];
        $html = substr($content, 0, $pos);
        $js = substr($content, $pos);
        // Only wrap if it's not already wrapped
        if (strpos($content, "@push('page-script')") === false) {
            $newContent = $html . "\n@push('page-script')\n" . $js . "\n@endpush\n";
            file_put_contents($path, $newContent);
            echo "Fixed _$name.blade.php\n";
        }
    }
}
