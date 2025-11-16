<?php
$js_folder = '..' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR;
$solver_js = file_get_contents(
    'https://github.com/yt-dlp/yt-dlp/raw/refs/heads/master/yt_dlp/extractor/youtube/jsc/_builtin/vendor/yt.solver.core.js',
    false,
    stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ])
);
$lib_json = file_get_contents($js_folder . 'lib.json');
file_put_contents($js_folder . 'yt.solver.core.js', $solver_js);
file_put_contents($js_folder . '_hashes.json', json_encode([
    'lib.json' => hash('sha3-512', $lib_json),
    'yt.solver.core.js' => hash('sha3-512', $solver_js),
]));
