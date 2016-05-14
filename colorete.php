<?php
/*
Plugin Name:       Colorete
Plugin URI:        https://github.com/yoander/colorete
Description:       Colorete highlights syntax in code for any post or page it's based on  <a href="https://github.com/owt5008137/WP-Code-Highlight.js">WP-Code-Highlight.js v0.5.11</a> and it is compatible with <a href="https://github.com/aramk/crayon-syntax-highlighter">Crayon Syntax Highlighter</a> out of the box.
Version:           0.1.0
Author:            Yoander Valdés Rodríguez (libreman)
Author URI:        http://www.librebyte.net/
License:           3-clause BSD
License URI:       http://www.gnu.org/licenses/gpl-3.0.html
Domain Path:       /languages
Text Domain:       colorete
GitHub Plugin URI: https://github.com/yoander/colorete
GitHub Branch:     master
*/

define('PLUGIN_URL', plugins_url() . '/' . dirname(plugin_basename(__FILE__)));

/**
 * Get version of this plugins
 */
function colorete_get_version() {
    return '0.1.0';
}

/**
 * Get version of Highlight.js
 */
function colorete_get_lib_version() {
    return '9.3.0';
}

/**
 * list cdn list
 */
function colorete_cdn_list() {
    return array(
        'local' => array(
            'cdn' => 'local',
            'desc' => __('local', 'colorete'),
            'css' => '',
            'js' => '',
            'readme' => '',
        ),
        'CdnJs' => array(
            'cdn' => '//cdnjs.cloudflare.com/ajax/libs/highlight.js/' . colorete_get_lib_version(),
            'desc' => __('Public CDN', 'colorete') . ': cdnjs (' . __('highlightjs.org recommend', 'colorete') . ')',
            'css' => '.min',
            'js' => '.min',
            'readme' => 'https://cdnjs.com/libraries/highlight.js'
        ),
        'jsDelivr' => array(
            'cdn' => '//cdn.jsdelivr.net/highlight.js/' . colorete_get_lib_version(),
            'desc' => __('Public CDN', 'colorete') . ': jsDelivr (' . __('highlightjs.org recommend', 'colorete') . ')',
            'css' => '.min',
            'js' => '.min',
            'readme' => 'http://www.jsdelivr.com/#!highlight.js'
        ),
        'MaxCDN' => array(
            'cdn' => '//oss.maxcdn.com/highlight.js/' . colorete_get_lib_version(),
            'desc' => __('Public CDN', 'colorete') . ': MaxCDN',
            'css' => '.min',
            'js' => '.min',
            'readme' => 'http://osscdn.com/#/highlight.js'
        )
   );
}

function colorete_get_hljs_langs() {
    return array(
        'common' => array(
            'apache'          => 'Apache',
            'bash'            => 'Bash',
            'cs'              => 'C#',
            'cpp'             => 'C++',
            'css'             => 'CSS',
            'coffeescript'    => 'CoffeeScript',
            'dts'             => 'Device Tree',
            'diff'            => 'Diff',
            'xml'             => 'HTML, XML',
            'http'            => 'HTTP',
            'ini'             => 'Ini',
            'json'            => 'JSON',
            'java'            => 'Java',
            'javascript'      => 'JavaScript',
            'makefile'        => 'Makefile',
            'markdown'        => 'Markdown',
            'nginx'           => 'Nginx',
            'objectivec'      => 'Objective-C',
            'php'             => 'PHP',
            'perl'            => 'Perl',
            'python'          => 'Python',
            'ruby'            => 'Ruby',
            'sql'             => 'SQL',
        ),
        'extended' => array(
            '1c'            => '1C',
            'armasm'        => 'ARM Assembly',
            'avrasm'        => 'AVR Assembler',
            'accesslog'     => 'Access log',
            'actionscript'  => 'ActionScript',
            'applescript'   => 'AppleScript',
            'arduino'       => 'Arduino',
            'asciidoc'      => 'AsciiDoc',
            'aspectj'       => 'AspectJ',
            'autohotkey'    => 'AutoHotkey',
            'autoit'        => 'AutoIt',
            'axapta'        => 'Axapta',
            'basic'         => 'Basic',
            'brainfuck'     => 'Brainfuck',
            'cal'           => 'C/AL',
            'cmake'         => 'CMake',
            'csp'           => 'CSP',
            'cos'           => 'Caché Object Script',
            'capnproto'     => 'Cap’n Proto',
            'ceylon'        => 'Ceylon',
            'clojure'       => 'Clojure',
            'clojure-repl'  => 'Clojure REPL',
            'crystal'       => 'Crystal',
            'd'             => 'D',
            'dns'           => 'DNS Zone file',
            'dos'           => 'DOS .bat',
            'dart'          => 'Dart',
            'delphi'        => 'Delphi',
            'django'        => 'Django',
            'dockerfile'    => 'Dockerfile',
            'dust'          => 'Dust',
            'erb'           => 'ERB (Embedded Ruby)',
            'elixir'        => 'Elixir',
            'elm'           => 'Elm',
            'erlang'        => 'Erlang',
            'erlang-repl'   => 'Erlang REPL',
            'fsharp'        => 'F#',
            'fix'           => 'FIX',
            'fortran'       => 'Fortran',
            'gcode'         => 'G-code (ISO 6983)',
            'gams'          => 'GAMS',
            'gauss'         => 'GAUSS',
            'glsl'          => 'GLSL',
            'gherkin'       => 'Gherkin',
            'go'            => 'Go',
            'golo'          => 'Golo',
            'gradle'        => 'Gradle',
            'groovy'        => 'Groovy',
            'hsp'           => 'HSP',
            'htmlbars'      => 'HTMLBars',
            'haml'          => 'Haml',
            'handlebars'    => 'Handlebars',
            'haskell'       => 'Haskell',
            'haxe'          => 'Haxe',
            'irpf90'        => 'IRPF90',
            'inform7'       => 'Inform 7',
            'x86asm'        => 'Intel x86 Assembly',
            'julia'         => 'Julia',
            'kotlin'        => 'Kotlin',
            'lasso'         => 'Lasso',
            'less'          => 'Less',
            'lisp'          => 'Lisp',
            'livecodeserver'=> 'LiveCode',
            'livescript'    => 'LiveScript',
            'lua'           => 'Lua',
            'mel'           => 'MEL',
            'mipsasm'       => 'MIPS Assembly',
            'mathematica'   => 'Mathematica',
            'matlab'        => 'Matlab',
            'maxima'        => 'Maxima',
            'mercury'       => 'Mercury',
            'mizar'         => 'Mizar',
            'mojolicious'   => 'Mojolicious',
            'monkey'        => 'Monkey',
            'moonscript'    => 'MoonScript',
            'nsis'          => 'NSIS',
            'nimrod'        => 'Nimrod',
            'nix'           => 'Nix',
            'ocaml'         => 'OCaml',
            'openscad'      => 'OpenSCAD',
            'ruleslanguage' => 'Oracle Rules Language',
            'oxygene'       => 'Oxygene',
            'parser3'       => 'Parser3',
            'powershell'    => 'PowerShell',
            'processing'    => 'Processing',
            'prolog'        => 'Prolog',
            'protobuf'      => 'Protocol Buffers',
            'puppet'        => ' Puppet',
            'profile'       => 'Python profile',
            'q'             => 'Q',
            'qml'           => 'QML',
            'r'             => 'R',
            'rib'           => 'RenderMan RIB',
            'rsl'           => 'RenderMan RSL',
            'roboconf'      => 'Roboconf',
            'rust'          => 'Rust',
            'scss'          => 'SCSS',
            'sml'           => 'SML',
            'sqf'           => 'SQF',
            'step21'        => 'STEP Part 21',
            'scala'         => 'Scala',
            'scheme'        => 'Scheme',
            'scilab'        => 'Scilab',
            'smali'         => 'Smali',
            'smalltalk'     => 'Smalltalk',
            'stan'          => 'Stan',
            'stata'         => 'Stata',
            'stylus'        => 'Stylus',
            'swift'         => 'Swift',
            'tp'            => 'TP',
            'taggerscript'  => 'Tagger Script',
            'tcl'           => 'Tcl',
            'tex'           => 'TeX',
            'thrift'        => 'Thrift',
            'twig'          => 'Twig',
            'typescript'    => 'TypeScript',
            'vbnet'         => 'VB.NET',
            'vbscript'      => 'VBScript',
            'vbscript-html' => 'VBScript in HTML',
            'vhdl'          => 'VHDL',
            'vala'          => 'Vala',
            'verilog'       => 'Verilog',
            'vim'           => 'Vim Script',
            'xl'            => 'XL',
            'xquery'        => 'XQuery',
            'yaml'          => 'YAML',
            'zephir'        => 'Zephir',
            'crmsh'         => 'crmsh',
            'pf'            => 'pf',
        )
    );
}

/**
 * Plugin Installation:
 *   - create configuration keys
 */
function colorete_install() {
    add_option('colorete_code_option', array(
        'location' => 'local',
        'package' => 'common',
        'theme' => 'default',
        'hljs_default_lang' => '',
        'additional_css' => "pre.hljs { padding: 5px; }\npre.hljs code {}",
    ));
}
register_activation_hook(__FILE__, 'colorete_install');


/**
 * Plugin Deinstallation
 *   - delete configuration keys
 */
function colorete_deinstall() {
    delete_option('colorete_code_option');
}
register_deactivation_hook(__FILE__, 'colorete_deinstall');


/**
 * Get option of this plugin
 */
function colorete_get_option($item) {
    $res = get_option('colorete_code_option');
    if (empty($res) || !isset($res[$item]))
        return null;
    return $res[$item];
}

/**
 * Set option of this plugin
 */
function colorete_set_option($item, $val) {
    $res = get_option('colorete_code_option');
    if (empty($res))
        $res = array();
    $res[$item] = $val;
    update_option('colorete_code_option', $res);
    return $val;
}

function colorete_remove_ex_mode() {
    $upload_options = get_option('colorete_code_option');
    if (!empty($upload_options)) {
        $opt_packs = $upload_options['package'];
        // ex mode already deleted, so convert to custom mode
        if ('ex' == $opt_packs) {
            $upload_options['package'] = 'custom';
            $upload_options['custom_lang'] = array('actionscript', 'applescript', 'cmake', 'capnproto', 'd', 'dos', 'erlang', 'fsharp', 'go', 'less', 'lisp', 'lua', 'matlab', 'protobuf', 'profile', 'scala', 'tex', 'typescript');
            update_option('colorete_code_option', $upload_options);
        }

        colorete_generate_custom_pack();
    }
}

/**
 * Attach Highlight.js to the current page
 *   - attach highlight.pack.js
 *   - attach colorscheme stylesheet
 */
function colorete_include() {
    $colorete_code_option = get_option('colorete_code_option');
    $colorete_location = $colorete_code_option['location'];
    $colorete_package = colorete_get_option('package');
    $colorete_cdn_list = colorete_cdn_list();
    $colorete_cdn_info = $colorete_cdn_list['local'];
    if (!empty($colorete_cdn_list[$colorete_location]))
        $colorete_cdn_info = $colorete_cdn_list[$colorete_location];

    // inject js & css file
    if ( 'local' == $colorete_cdn_info['cdn'] ) {
        if ('ex' == $colorete_package) {
            colorete_remove_ex_mode();
        }

        $dep_libs = array('jquery');
        if ('custom' == $colorete_package) {
            wp_enqueue_script( 'colorete_preload', PLUGIN_URL . '/highlight.common.pack.js', $dep_libs, colorete_get_version(), true );
            $dep_libs = array('colorete_preload');
        }

        wp_enqueue_script( 'colorete', PLUGIN_URL . '/highlight.' . $colorete_package .'.pack.js', $dep_libs, colorete_get_version(), true );
        wp_enqueue_style( 'coloretetheme', PLUGIN_URL . '/styles/' . $colorete_code_option['theme'] . '.css', array(), colorete_get_version() );
    } else {
        wp_enqueue_script( 'colorete', $colorete_cdn_info['cdn'] . '/highlight' . $colorete_cdn_info['js'] . '.js', array('jquery'), colorete_get_version(), true );
        wp_enqueue_style( 'coloretetheme', $colorete_cdn_info['cdn'] . '/styles/' . $colorete_code_option['theme'] . $colorete_cdn_info['css'] . '.css', array(), colorete_get_version() );

        // additional languages
        $custom_addition_langs = colorete_get_option('custom_lang');
        if(!empty($custom_addition_langs)) {
            foreach(colorete_get_option('custom_lang') as $lang) {
                 wp_enqueue_script( 'colorete_lang_' . $lang, $colorete_cdn_info['cdn'] . '/languages/' . $lang . $colorete_cdn_info['js'] . '.js', array('colorete'), colorete_get_version(), true );
            }
        }
    }
}
add_action('wp_head', 'colorete_include');

/**
 * Attach init code to the current page
 */
function colorete_append_init_codes() {
    $colorete_options = get_option('colorete_code_option');

    $js = <<<JS
    <style type="text/css">${colorete_options['additional_css']}</style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('pre').each(function (index, elem) {
                var code = elem;

                // Remove any inline style
                $(code).removeAttr('style');

                var chd = $(elem).children('code');
                if (chd.length > 0) {
                    code = chd;
                    // Remove any inline style
                     $(code).removeAttr('style');
                }

                var langAttr = $(code).attr('lang') || $(code).attr('language');
                if (langAttr !== undefined) {
                    $(code).attr('class', langAttr);
                    $(code).removeAttr('lang language autolinks');
                } else {
                    var defaultLang = "${colorete_options['hljs_default_lang']}";
                    var htmlClass = $(code).attr('class');
                    if (htmlClass !== undefined) {
                        // Detect if language definition is compatible with Crayon
                        // Or SyntaxHighligther
                        var pattern = /(lang|brush|crayon)\s*:\s*(\w+-?)+/i;
                        var matches = pattern.exec(htmlClass);

                        if (null !== matches) {
                            htmlClass = "false" == matches[2].toLowerCase() ? "nohighlight" : matches[2];
                            $(code).attr('class', htmlClass);
                        // Find if class attribute is compatible with Crayon or
                        // SyntaxHighligther definition, ex: "toolbar:false nums:false"
                        } else if (htmlClass.match(/(\w+-?)+\s*:\s*(\w+-?)+/i)) {
                            // Set default language to bash to avoid erroneus
                            // language detection for single line
                            $(code).attr('class', defaultLang);
                        }
                    } else {
                        // Set default language to bash to avoid erroneus
                        // language detection for single line
                        $(code).attr('class', defaultLang);
                    }
                }

                hljs.highlightBlock(elem);
            });
        });
  </script>
JS;

  echo $js;
}
add_action('wp_print_footer_scripts', 'colorete_append_init_codes');

function htmlenc_func($attr, $content) {
    return trim( htmlspecialchars( str_replace( '<br />', '', do_shortcode( $content ) )));
}

add_shortcode( 'htmlenc', 'htmlenc_func' );

/**
 * Initialize Localization Functions
 */
function init_colorete_textdomain() {
    if (function_exists('load_plugin_textdomain')) {
        load_plugin_textdomain('colorete', false, dirname(plugin_basename( __FILE__ )) . '/' . 'l10n');
    }
}
add_action('init', 'init_colorete_textdomain');

/**
 * Print CDN location addrs
 */
function colorete_get_location_list($current_location) {
    $cdn_list  = colorete_cdn_list();
    foreach($cdn_list as $key => $val) {
         ?><option value="<?php echo $key; ?>" <?php
        if($key == $current_location)
            echo ' selected="selected"';
        ?> readme_url="<?php echo $val['readme']; ?>" ><?php echo empty($val['desc'])? $key: $val['desc']; ?></option><?php
    }
}

/**
 * Print package version
 */
function colorete_get_package_list($current_package) {
    $pkgs = array(
        'common' => 'Common(about 42KB)',
        'all' => 'All(about 393KB)',
        'custom' => 'Custom',
    );

    foreach($pkgs as $key => $val) {
        ?><option value="<?php echo $key; ?>" <?php
        if($key == $current_package)
            echo ' selected="selected"';
        ?>><?php echo $val; ?></option><?php
    }
}

/**
 * Print Combobox With Styles
 */
function colorete_get_style_list($current_theme) {
    $styleDir = plugin_dir_path( __FILE__ ) . 'styles';

    if ($dir = scandir($styleDir)) {
        foreach($dir as $file) {
            if (($file == '.') or ($file == '..'))
                continue;

            if ('.css' != substr($file, strlen($file) - 4))
                continue;

            $theme_name = substr($file, 0, strlen($file) - 4);
            ?><option value="<?php echo $theme_name; ?>" <?php
            if($theme_name == $current_theme)
                echo ' selected="selected"';
            ?>><?php echo $theme_name; ?></option><?php
        }
    }
}

/**
 * Add Settings Page to Admin Menu
 */
function colorete_admin_page() {
    if (function_exists('add_submenu_page'))
        add_options_page(__('Colorete Settings'), __('Colorete'), 'manage_options', 'colorete', 'colorete_settings_page');
}
add_action('admin_menu', 'colorete_admin_page');


/**
 * Add Settings link to plugin page
 */
function colorete_add_settings_link($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
      $links[] = '<a href="options-general.php?page=colorete">' . __('Settings') . '</a>';
    }
    return $links;
}
add_filter('plugin_action_links', 'colorete_add_settings_link', 10, 2);

function colorete_generate_custom_pack() {
    // generate custom language pack
    $opt_loc = colorete_get_option('location');
    $opt_packs = colorete_get_option('package');
    $opt_langs = colorete_get_option('custom_lang');
    $plugin_root_dir = plugin_dir_path( __FILE__ );

    if ('local' == $opt_loc && 'custom' == $opt_packs) {
        $custom_pack_file = $plugin_root_dir . DIRECTORY_SEPARATOR . 'highlight.custom.pack.js';

        file_put_contents($custom_pack_file, '');
        foreach($opt_langs as $language_name) {
            $file_name = $language_name . '.min.js';
            $full_path = $plugin_root_dir . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $file_name;
            if (file_exists($full_path)) {
                $fc = file_get_contents($full_path);
                file_put_contents($custom_pack_file, $fc . PHP_EOL, FILE_APPEND);
            } else {
                echo '<p class="warn">' .
                    __('Language file', 'colorete') .
                    ' ' . $file_name . ' ' .
                    __('not found', 'colorete') . ', ' .
                    __('ignored', 'colorete') . '</p>';
            }
        }

        echo '<p class="info">' . __('Generate custom highlight language package done.', 'colorete') . '</p>';
    }

    // rename style to default when filename is changed by highlight.js
    $style_name = colorete_get_option('theme');
    if (false == file_exists($plugin_root_dir . DIRECTORY_SEPARATOR . 'styles' . DIRECTORY_SEPARATOR . $style_name . '.css')) {
        colorete_set_option('theme', 'default');
        echo '<p class="warn">' . __('Style named ' . $style_name . ' is unavailable, maybe highlight.js has changed the name. Theme changed to default now', 'colorete') . '</p>';
    }
}

function colorete_on_update_complete($plugin, $data) {
    if (!empty($data) && !empty($data['type']) && 'plugin' == $data['type'] && 'update' == $data['action']) {
        $this_file_name = basename(__FILE__);
        $rebuild_flag = false;
        foreach($data['plugins'] as $updated_file) {
            if ($this_file_name == basename($updated_file)) {
                $rebuild_flag = true;
            }
        }
        if ($rebuild_flag) {
            colorete_generate_custom_pack();
        }
    }
}
add_action('upgrader_process_complete', 'colorete_on_update_complete', 10, 2);

/**
 * Highlight.js Settings Page
 */
function colorete_settings_page() {
    if (isset( $_POST['cmd'] ) && $_POST['cmd'] == 'colorete_save')
    {
        $upload_options = array(
            'location' => $_POST['colorete_location'],
            'package' => $_POST['colorete_package'],
            'theme' => $_POST['colorete_theme'],
            'additional_css' => $_POST['colorete_additional_css'],
            'hljs_default_lang' => $_POST['colorete_hljs_default_lang']
        );

        // generate custom language pack
        if ('local' == $upload_options['location'] && 'custom' == $upload_options['package']) {
            $upload_options['custom_lang'] = array();
            $plugin_root_dir = plugin_dir_path( __FILE__ );

            foreach($_POST as $key => $val) {
                $suffix = substr($key, -3);
                if (('.js' == $suffix || '_js' == $suffix )&& intval($val) == 1) {
                    $language_name =  substr($key, 0, strlen($key) - 3);
                    $file_name = $language_name . '.min.js';
                    $full_path = $plugin_root_dir . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $file_name;
                    if (file_exists($full_path)) {
                        array_push($upload_options['custom_lang'], $language_name);
                    } else {
                        echo '<p class="warn">' .
                            __('Language file', 'colorete') .
                            ' ' . $file_name . ' ' .
                            __('not found', 'colorete') . ', ' .
                            __('ignored', 'colorete') . '</p>';
                    }
                }
            }
        }

        update_option('colorete_code_option', $upload_options);
        echo '<p class="info">' . __('All configurations successfully saved...', 'colorete') . '</p>';
        colorete_generate_custom_pack();
    }

    ?>

    <!-- html code of settings page -->

    <div class="wrap">

      <form id="colorete" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">

        <script type="text/javascript" src="<?php echo (PLUGIN_URL . '/highlight.common.pack.js'); ?>"></script>
        <script type="text/javascript">colorete.initHighlightingOnLoad();</script>
        <link rel="stylesheet" href="<?php echo (PLUGIN_URL . '/styles/default.css'); ?>" />

        <style>
            .info { padding: 15px; background: #EDEDED; border: 1px solid #333333; font: 14px #333333 Verdana; margin: 30px 10px 0px 0px; }

            .section { padding: 10px; margin: 30px 0 0px; background: #FAFAFA; border: 1px solid #DDDDDD; display: block; }
            input[type="text"] { width: 400px; margin: 10px 0px 0px;}
            textarea {width: 400px; height: 100px; }

            #colorete_theme { width: 200px;  margin: 10px 0px 0px;}
            #submit { min-width: 40px; margin-top: 20px; }
            #colorete_location_readme { color: Gray; font-style: italic; }

            table.colorete_copyright { font-size: 8px; margin-top: 50px;}
            table.colorete_copyright tr {margin-bottom: 10px;}
            table.colorete_copyright tr td {padding: 5px; font: 12px Sans-Serif; border: 1px solid #DDDDDD;}

        </style>

        <!-- combo box with location -->
        <div class="section">
          <label for="colorete_location"><?php echo __('CDN', 'colorete'); ?></label><br/>
          <select name="colorete_location" id="colorete_location">
             <?php colorete_get_location_list(colorete_get_option('location')); ?>
          </select> <span id="colorete_location_readme"></span>
          <div>
            Current Highlight.js Version: <?php echo colorete_get_lib_version(); ?>
          </div>
        </div>

        <!-- combo box with local source package -->
        <div class="section" id="colorete_local_package">
          <label for="colorete_package"><?php echo __('Package', 'colorete'); ?></label><br/>
          <select name="colorete_package" id="colorete_package">
             <?php colorete_get_package_list(colorete_get_option('package')); ?>
          </select>
          <div>
              <?php $langs = colorete_get_hljs_langs() ?>

              <h3>Support List:</h3> <a href="javascript:void();" id="colorete_support_list_btn"><?php echo __('[Show/Hide]', 'colorete'); ?></a>
              <div class="language_support_list" id="language_support_list">
                <p><b>Common</b></p>
                <?php if (!empty($langs['common'])): ?>
                    <ul id="language_support_list_common">
                        <?php foreach ($langs['common'] as $lang => $langName): ?>
                            <li><label><input name="<?php echo $lang ?>.js" checked type="checkbox" value="0" class="colorete_lang common"> <?php echo $langName ?></label>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
                <p><b>Other</b></p>
                <?php if (!empty($langs['extended'])): ?>
                    <ul id="language_support_list_other">
                        <?php foreach ($langs['extended'] as $lang => $langName): ?>
                            <li><label><input name="<?php echo $lang ?>.js" type="checkbox" value="1" class="colorete_lang"> <?php echo $langName ?></label>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
                <div style="clear: both;"></div>
              </div>
            </div>
        </div>
        <script type="text/javascript">
        (function($, window){
            $(document).ready(function(){
                $("#language_support_list ul").css({
                    overflow: 'auto',
                    margin: '1em 0px',
                    padding: '0px'
                });

                $("#language_support_list ul li").css({
                    margin: '0.2em 0px',
                    padding: '0px',
                    'list-style': 'outside none none',
                    float: 'left',
                    width: '24.5%'
                });

                $("#language_support_list_common input").prop("disabled", true);
                $("#language_support_list_common input").prop("checked", true);
                $("#language_support_list_common input").val(0);
                $("#language_support_list_common input").addClass("colorete_lang common");
                $("#language_support_list_other input").val(1);
                $("#language_support_list_other input").addClass("colorete_lang");

                var show_package_language = (function(){
                    var colorete_package_name = $("#colorete_package").val();
                    if ("custom" == colorete_package_name || $("#colorete_location").val() != "local") {
                        $("#language_support_list_other input").prop("disabled", false);
                        $("#language_support_list_other input").prop("checked", false);

                        // custom languages
                        var selected_langs = "<?php
                            $custom_lang = colorete_get_option('custom_lang');
                            if(!empty($custom_lang)) {
                                echo implode(' ', $custom_lang);
                            }
                        ?>".split(/[ \t\r\n]/);
                        $.each(selected_langs, function(k, v) {
                            if (v) {
                                $('#language_support_list_other input[name="' + v.replace(/_js$/, "")　+ '.js"]').prop("checked", true);
                            }
                        });

                    } else {
                        // select default languages
                        $("#language_support_list_other input").prop("disabled", true);

                        if ("all" == colorete_package_name) {
                            $("#language_support_list_other input").prop("checked", true);
                        } else {
                            $("#language_support_list_other input").prop("checked", false);
                        }
                    }
               });

                var show_package_fn = (function(){
                    if ($("#colorete_location").val() != "local") {
                        $("#colorete_package").prop('disabled', true);
                    } else {
                        $("#colorete_package").prop('disabled', false);
                    }

                    show_package_language();
                });

                show_package_fn();
                $("#colorete_location").change(function(){
                    $("#colorete_location_readme").empty();
                    $.each($("option", this), function(k, v) {
                        if ($(v).prop('selected') && $(v).attr("readme_url")) {
                            var text = "<?php echo __('click', 'colorete'); ?>" +
                                " <a href=\"" + $(v).attr("readme_url") + "\" target=\"_blank\">" +$(v).attr("readme_url") + "</a> " +
                                "<?php echo __('for detail', 'colorete'); ?>";
                            $("#colorete_location_readme").html(text);
                        }
                    });
                    show_package_fn();
                });
                $("#colorete_package").change(function(){ show_package_language(); });
                $("#colorete_support_list_btn").click(function() {
                    $("#language_support_list").slideToggle();
                });
            });
        })(jQuery, window);

        </script>

        <!-- combo box with styles -->
        <div class="section">
          <label for="colorete_theme"><?php echo __('Color Scheme:', 'colorete'); ?></label><br/>

          <select name="colorete_theme" id="colorete_theme">
             <?php colorete_get_style_list(colorete_get_option('theme')); ?>
          </select>
            <div><?php echo __('You can get a quick look of all style and all language at <a href="https://highlightjs.org/static/demo/" target="_blank">https://highlightjs.org/static/demo/</a>', 'colorete'); ?>
          </div>
          <div>
            <strong><?php echo __('Notice', 'colorete'); ?><strong/>: <?php echo __('some cdn support only older version of highligh.js, and some language or style is unusable, see <a href="https://highlightjs.org/" target="_blank">https://highlightjs.org/</a> for detail', 'colorete'); ?>
          </div>

        </div>

        <div class="section">
          <label for="colorete_hljs_default_lang"><?php echo __('highlight.js default language:', 'colorete'); ?></label><br/>
          <input type="text" name="colorete_hljs_default_lang" id="colorete_hljs_default_lang" value="<?php echo colorete_get_option('hljs_default_lang'); ?>" />
          <div><?php echo __('This option will be set default language else highlight.js will try to guess it from the code', 'colorete'); ?></div>
        </div>

        <!-- text edit : additional css -->
        <p class="section">
          <label for="colorete_additional_css"><?php echo __('You can add some additional CSS rules for better display:', 'colorete'); ?></label><br/>
          <textarea type="text" name="colorete_additional_css" id="colorete_additional_css"><?php echo colorete_get_option('additional_css'); ?></textarea>
        </p>

        <input type="hidden" name="cmd" value="colorete_save" />
        <input type="submit" name="submit" value="<?php echo __('Save', 'colorete'); ?>" id="submit" />

      </form>

        <!-- copyright information -->
            <table border="0" class="colorete_copyright">
                <tr>
                    <td width="120px" align="center"><?php echo __('Author', 'colorete'); ?></td>
                    <td><p><a href="http://www.librebyte.net">Yoander Valdés Rodríguez</a> &lt;<a href="http://github.com/yoander">libreman</a>&gt;</p></td>
                </tr>

                <tr>
                    <td width="120px" align="center"><?php echo __('Plugin Info', 'colorete'); ?></td>
                    <td><p><?php echo __('Colorete highlights syntax in code for any post or page it\'s based on <a href="https://github.com/owt5008137/WP-Code-Highlight.js">WP-Code-Highlight.js v0.5.11</a> and it is compatible with <a href="https://github.com/aramk/crayon-syntax-highlighter">Crayon Syntax Highlighter</a> out of the box.', 'colorete') ?></p></td>
                </tr>

                <tr>
                    <td width="120px" align="center"><?php echo __('Plugin Usage', 'colorete'); ?></td>
                    <td><?php echo __('<p>For code highlighting you should use one of the following ways.</p>
                            <p>&lt;pre&gt;&lt;code&gt; this language will be automatically determined if default language is not set &lt;/code&gt;&lt;/pre&gt;</p>
                        <p>&lt;pre&gt;&lt;code class="html"&gt; highlight the code with certain as hmtl language &lt;/code&gt;&lt;/pre&gt;</p>
                        <p>
                        &lt;pre&gt;&lt;code class="html"&gt;
                        [htmlenc] First convert special chars to their equivalent html entity (Very useful y you dont\' use Wordpress Visual Editor) [/htmlenc]
                        &lt;/code&gt;&lt;/pre&gt;</p>', 'colorete'); ?></td>
                </tr>
                <tr>
                    <td width="120px" align="center"><?php echo __('Thanks To', 'colorete'); ?></td>
                    <td><ul>
                            <li><a href="http://owent.net"><?php echo __('OWenT', 'colorete'); ?></a> &lt;<a href="mailto:owent@owent.net">owent@owent.net</a>&gt; (for the original work)</li>
                            <li><a href="http://softwaremaniacs.org/">Ivan Sagalaev</a> (for his <a href="http://highlightjs.org/">highlight.js</a>)</li>
                    </ul></td>
                </tr>
           </table>
    </div>

    <!-- /html code of settings page -->

<?php
}
