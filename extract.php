<?php
$files = ['praharis' => 'Prahari', 'cases' => 'Cases', 'challans' => 'Challans', 'payments' => 'Payments'];
foreach ($files as $name => $title) {
    $content = file_get_contents('resources/views/admin/'.$name.'.blade.php');
    
    // Extract everything between @section('page-content') and @endsection
    preg_match('/@section\(\'page-content\'\)(.*?)@endsection/s', $content, $htmlMatches);
    $html = $htmlMatches[1] ?? '';
    
    // Extract everything inside @push('page-script') ... @endpush
    preg_match('/@push\(\'page-script\'\)(.*?)@endpush/s', $content, $jsMatches);
    $js = $jsMatches[1] ?? '';
    
    // Remove the page header (the h4 title and the Add button that's floating)
    $html = preg_replace('/<div class="d-flex align-items-center justify-content-between mb-4 mt-4">.*?<\/div>/s', '', $html);
    
    // Replace IDs to prevent collision
    $html = str_replace('id="userModal"', 'id="settings'.$title.'Modal"', $html);
    $html = str_replace('id="viewModal"', 'id="settingsView'.$title.'Modal"', $html);
    $html = str_replace('id="viewCaseModal"', 'id="settingsView'.$title.'Modal"', $html);
    $html = str_replace('id="viewChallanModal"', 'id="settingsView'.$title.'Modal"', $html);
    $html = str_replace('id="praharisTable"', 'id="settings'.$title.'Table"', $html);
    
    // Fix modal targets in HTML (e.g. data-bs-target="#userModal")
    $html = str_replace('#userModal', '#settings'.$title.'Modal', $html);
    $html = str_replace('#viewModal', '#settingsView'.$title.'Modal', $html);
    
    // We will save JS separately to combine later, or include them per tab. Let's include JS per tab, wrapped in <script>
    // Replace IDs in JS
    $js = str_replace('#userModal', '#settings'.$title.'Modal', $js);
    $js = str_replace('#viewModal', '#settingsView'.$title.'Modal', $js);
    $js = str_replace('#viewCaseModal', '#settingsView'.$title.'Modal', $js);
    $js = str_replace('#viewChallanModal', '#settingsView'.$title.'Modal', $js);
    $js = str_replace('#praharisTable', '#settings'.$title.'Table', $js);
    $js = str_replace('id="praharisTable"', 'id="settings'.$title.'Table"', $js);
    
    // Fix form IDs in HTML and JS
    $formName = ($name === 'praharis') ? 'prahariForm' : $name.'Form';
    $newFormName = 'settings'.$title.'Form';
    $html = str_replace('id="'.$formName.'"', 'id="'.$newFormName.'"', $html);
    $js = str_replace('#'.$formName, '#'.$newFormName, $js);
    
    // Some tabs (cases, challans, payments) have customSearch. Need to rename
    $html = str_replace('id="customSearch"', 'id="settings'.$title.'Search"', $html);
    $js = str_replace('#customSearch', '#settings'.$title.'Search', $js);
    
    // In JS we also have to make sure variables don't collide if we include multiple script tags
    // Replace `let table =` with `let settings$titleTable =`
    $js = preg_replace('/let table(\s*)=/', 'let settings'.$title.'Table$1=', $js);
    // Replace table.ajax.reload() with settings$titleTable.ajax.reload()
    $js = str_replace('table.ajax.reload', 'settings'.$title.'Table.ajax.reload', $js);
    // Replace table.search(this.value) with settings$titleTable.search(this.value)
    $js = str_replace('table.search', 'settings'.$title.'Table.search', $js);
    
    // Same for some specific globals like `currentTab` in payments
    if ($name === 'payments') {
        $js = str_replace('let currentTab', 'let currentPaymentsTab', $js);
        $js = str_replace('currentTab', 'currentPaymentsTab', $js);
    }
    
    // Remove (document).ready to wrap them all inside settings.blade.php? 
    // It's easier to keep them as is inside the partial if they don't break.
    
    // Save to partial
    $partialContent = $html . "\n" . $js;
    file_put_contents('resources/views/admin/settings/partials/_'.$name.'.blade.php', $partialContent);
    echo "Created _$name.blade.php\n";
}
