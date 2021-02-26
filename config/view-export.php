<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Chroot
    |--------------------------------------------------------------------------
    |
    | dompdf's "chroot".
    |
    | Prevents dompdf from accessing system files or other files on the webserver.
    | All local files opened by dompdf must be in a subdirectory of this directory
    | or array of directories.
    | DO NOT set it to '/' since this could allow an attacker to use dompdf to
    | read any files on the server.  This should be an absolute path.
    |
    | ==== IMPORTANT ====
    | This setting may increase the risk of system exploit. Do not change
    | this settings without understanding the consequences. Additional
    | documentation is available on the dompdf wiki at:
    | https://github.com/dompdf/dompdf/wiki
    |
    */
    'chroot' => base_path('vendor/dompdf/dompdf'),

    /*
    |--------------------------------------------------------------------------
    | PHP enabled
    |--------------------------------------------------------------------------
    |
    | Enable embedded PHP.
    |
    | If this setting is set to true then DOMPDF will automatically evaluate
    | embedded PHP contained within <script type="text/php"> ... </script> tags.
    |
    | ==== IMPORTANT ====
    | Enabling this for documents you do not trust (e.g. arbitrary remote html
    | pages) is a security risk. Embedded scripts are run with the same level of
    | system access available to dompdf. Set this option to false (recommended)
    | if you wish to process untrusted documents.
    |
    | This setting may increase the risk of system exploit. Do not change
    | this settings without understanding the consequences. Additional
    | documentation is available on the dompdf wiki at:
    | https://github.com/dompdf/dompdf/wiki
    |
    */
    'php_enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Javascript enabled
    |--------------------------------------------------------------------------
    |
    | Enable inline Javascript.
    |
    | If this setting is set to true then DOMPDF will automatically insert
    | JavaScript code contained within <script type="text/javascript"> ... </script> tags.
    |
    */
    'javascript_enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | HTML 5 parsable enabled
    |--------------------------------------------------------------------------
    |
    | Use the more-than-experimental HTML5 Lib parser.
    |
    */
    'html5_parsable' => true,

    /*
    |--------------------------------------------------------------------------
    | Remote enabled
    |--------------------------------------------------------------------------
    |
    | Enable remote file access.
    |
    | If this setting is set to true, DOMPDF will access remote sites for
    | images and CSS files as required.
    |
    | ==== IMPORTANT ====
    | This can be a security risk, in particular in combination with isPhpEnabled and
    | allowing remote html code to be passed to $dompdf = new DOMPDF(); $dompdf->load_html(...);
    | This allows anonymous users to download legally doubtful internet content which on
    | tracing back appears to being downloaded by your server, or allows malicious php code
    | in remote html pages to be executed by your server with your account privileges.
    |
    | This setting may increase the risk of system exploit. Do not change
    | this settings without understanding the consequences. Additional
    | documentation is available on the dompdf wiki at:
    | https://github.com/dompdf/dompdf/wiki
    |
    */
    'remote_enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | PDF Metadata default
    |--------------------------------------------------------------------------
    |
    | PDF metadata that should be used by default.
    |
    */
    'metadata' => [
        //        'Title' => '',
        //        'Author' => '',
        //        'Subject' => '',
        //        'Keywords' => '',
        //        'Creator' => '',
        //        'Producer' => '',
        //        'CreationDate' => '',
        //        'ModDate' => '',
        //        'Trapped' => '',
    ],

];
