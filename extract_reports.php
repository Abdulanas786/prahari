<?php
$content = file_get_contents('resources/views/admin/report.blade.php');
preg_match('/@section\(\'page-content\'\)(.*?)@endsection/s', $content, $htmlMatches);
$html = $htmlMatches[1] ?? '';
preg_match('/@push\(\'page-script\'\)(.*?)@endpush/s', $content, $jsMatches);
$js = $jsMatches[1] ?? '';

// Remove header and top cards since we have quick actions
$html = preg_replace('/<div class="d-flex justify-content-between align-items-center mb-4">.*?<\/div>/s', '', $html);
$html = preg_replace('/<!-- TOP CARDS -->.*?<!-- CHARTS -->/s', '<!-- CHARTS -->', $html);

// Remove the py-4 wrapper
$html = str_replace('<div class="container-fluid py-4">', '', $html);
$html = preg_replace('/<\/div>\s*$/', '', $html);

// Rename chart IDs to avoid conflicts
$html = str_replace('id="casesChart"', 'id="settingsCasesChart"', $html);
$html = str_replace('id="revenueChart"', 'id="settingsRevenueChart"', $html);

$js = str_replace("'casesChart'", "'settingsCasesChart'", $js);
$js = str_replace("'revenueChart'", "'settingsRevenueChart'", $js);

// Remove duplicate chart.js inclusion since it should be included once
// We will just leave it if it's there but maybe rename vars to avoid re-declaring const
$js = str_replace('const casesCtx', 'let settingsCasesCtx', $js);
$js = str_replace('const revenueCtx', 'let settingsRevenueCtx', $js);
$js = str_replace('casesCtx', 'settingsCasesCtx', $js);
$js = str_replace('revenueCtx', 'settingsRevenueCtx', $js);

$partialContent = $html . "\n" . $js;
file_put_contents('resources/views/admin/settings/partials/_reports.blade.php', $partialContent);
echo "Created _reports.blade.php\n";
