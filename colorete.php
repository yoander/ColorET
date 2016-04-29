<?php
/*
Plugin Name:       Colorete
Plugin URI:        https://github.com/yoander/colorete
Description:       Colorete highlights syntax in code for any post or page it's based on  a href="https://github.com/owt5008137/WP-Code-Highlight.js">WP-Code-Highlight.js v0.5.11</a>
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
    return '0.5.11';
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
        ),
        'BootCSS' => array(
            // 'cdn' => '//cdn.bootcss.com/highlight.js/' . colorete_get_lib_version(),
            'cdn' => '//cdn.bootcss.com/highlight.js/9.2.0',
            'desc' => __('Public CDN', 'colorete') . ': BootCSS' . __('lastest version', 'colorete') . ': 9.2.0',
            'css' => '.min',
            'js' => '.min',
            'readme' => 'http://www.bootcdn.cn/highlight.js/'
        ),
        'Baidu' => array(
            //'cdn' => 'http://apps.bdimg.com/libs/highlight.js/' . colorete_get_lib_version(),
            //'cdn' => '//openapi.baidu.com/libs/highlight.js/' . colorete_get_lib_version(),
            'cdn' => '//openapi.baidu.com/libs/highlight.js/9.1.0',
            'desc' => __('Public CDN', 'colorete') . ': ' . __('Baidu', 'colorete') . __('lastest version', 'colorete') . ': 9.1.0)',
            'css' => '.min',
            'js' => '.min',
            'readme' => 'http://cdn.code.baidu.com/#highlight.js'
        ),
        'Yandex' => array(
            //'cdn' => '//yandex.st/highlightjs/' . colorete_get_lib_version(),
            'cdn' => '//yandex.st/highlightjs/8.2',
            'desc' => __('Public CDN', 'colorete') . ': Yandex(' . __('lastest version', 'colorete') . ': 8.2)',
            'css' => '.min',
            'js' => '.min',
            'readme' => 'https://tech.yandex.ru/jslibs/#highlight'
        ),
        'Qiniu' => array(
            'cdn' => 'http://cdn.staticfile.org/highlight.js/9.0.0',// . colorete_get_lib_version(),
            'desc' => __('Public CDN', 'colorete') . ': ' . __('Qiniu', 'colorete') . '(' . __('http only', 'colorete') . ', ' . __('lastest version', 'colorete') . ': 9.0.0)',
            'css' => '.min',
            'js' => '.min',
            'readme' => 'http://www.staticfile.org'
        ),
        'Qihoo360' => array(
            'cdn' => 'http://libs.useso.com/js/highlight.js/8.0',// . colorete_get_lib_version(),
            'desc' => __('Public CDN', 'colorete') . ': ' . __('Qihoo 360', 'colorete') . '(' . __('http only', 'colorete') . ', ' . __('lastest version', 'colorete') . ': 8.0)',
            'css' => '.min',
            'js' => '.min',
            'readme' => 'http://libs.useso.com/js.php?path=highlight.js'
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
        'colorete_option' => array(
            'tabReplace' => '    ',
            'classPrefix' => '',
            'useBR' => false,
            'languages' => ''
        ),
        'additional_css' => "pre.colorete {padding: 5px;}\npre.colorete code {}",
        'custom_lang' => array()
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

/**
 * Get option of highlight.js
 */
function colorete_get_lib_option($item) {
    $res = colorete_get_option('colorete_option');
    if (empty($res) || !isset($res[$item]))
        return '';
    return $res[$item];
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
        wp_enqueue_script( 'colorete_he', PLUGIN_URL . '/he.js', $dep_libs, colorete_get_version(), true );
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
  $js = <<<JS
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $.each($.merge($('pre'), $('pre code')), function (index, elem) {
        $(elem).attr('style', '');
        $(elem).attr('class', '');
        hljs.highlightBlock(elem);
      });
    });
  </script>
JS;

  echo $js;
}


add_action('wp_print_footer_scripts', 'colorete_append_init_codes');

function htmlenc_func($attr, $content) {
  return '<pre><code>' . trim(htmlspecialchars(str_replace('<br />', '', do_shortcode($content) ))) . '</code></pre>';
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


/**
 * Add BB-Tag for highlighting.
 *
 *   Usage: [CODE lang=cpp bbcode=enable]...[/CODE]
 */
function colorete_code_handler($attrs, $content) {
    $language = '';
    if (!empty($attrs['lang']))
        $language = "class=\"${attrs['lang']}\"";

    $enable_inner_bbcode = false;
    if(isset($attrs['bbcode'])) {
        $enable_inner_bbcode = true;
        if('disable' === $attrs['bbcode'] || 0 === $attrs['bbcode']) {
            $enable_inner_bbcode = false;
        }
    }

    if($enable_inner_bbcode) {
        return "<pre class=\"colorete\"><code $language>" . do_shortcode(ltrim(htmlentities($content), '\n')) . '</code></pre>';
    } else {
        return "<pre class=\"colorete\"><code $language>" . ltrim(str_replace('&lt;br /&gt;', '', htmlspecialchars($content)), '\n') . '</code></pre>';
    }
}
if (colorete_get_option('shortcode')) {
    add_shortcode('code', 'colorete_code_handler');
}

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
            'colorete_option' => array(
                'tabReplace' => $_POST['colorete_option_tab_replace'],
                'classPrefix' => $_POST['colorete_option_class_prefix'],
                'useBR' => (isset($_POST['colorete_option_use_br']) && $_POST['colorete_option_use_br'])? true: false,
                'languages' => $_POST['colorete_option_languages']
            ),
            'additional_css' => $_POST['colorete_additional_css'],
            'custom_lang' => colorete_get_option('custom_lang')
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
              <h3>Support List:</h3> <a href="javascript:void();" id="colorete_support_list_btn"><?php echo __('[Show/Hide]', 'colorete'); ?></a>
              <div class="language_support_list" id="language_support_list">
                <p><b>Common</b></p>
                <ul id="language_support_list_common">
                  <li><label><input name="apache.js" checked type="checkbox" value="0" class="colorete_lang common"> Apache</label>
                  </li><li><label><input name="bash.js" checked type="checkbox" value="0" class="colorete_lang common"> Bash</label>
                  </li><li><label><input name="cs.js" checked type="checkbox" value="0" class="colorete_lang common"> C#</label>
                  </li><li><label><input name="cpp.js" checked type="checkbox" value="0" class="colorete_lang common"> C++</label>
                  </li><li><label><input name="css.js" checked type="checkbox" value="0" class="colorete_lang common"> CSS</label>
                  </li><li><label><input name="coffeescript.js" checked type="checkbox" value="0" class="colorete_lang common"> CoffeeScript</label>
                  </li><li><label><input name="dts.js" checked type="checkbox" value="0" class="colorete_lang common"> Device Tree</label>
                  </li><li><label><input name="diff.js" checked type="checkbox" value="0" class="colorete_lang common"> Diff</label>
                  </li><li><label><input name="xml.js" checked type="checkbox" value="0" class="colorete_lang common"> HTML, XML</label>
                  </li><li><label><input name="http.js" checked type="checkbox" value="0" class="colorete_lang common"> HTTP</label>
                  </li><li><label><input name="ini.js" checked type="checkbox" value="0" class="colorete_lang common"> Ini</label>
                  </li><li><label><input name="json.js" checked type="checkbox" value="0" class="colorete_lang common"> JSON</label>
                  </li><li><label><input name="java.js" checked type="checkbox" value="0" class="colorete_lang common"> Java</label>
                  </li><li><label><input name="javascript.js" checked type="checkbox" value="0" class="colorete_lang common"> JavaScript</label>
                  </li><li><label><input name="makefile.js" checked type="checkbox" value="0" class="colorete_lang common"> Makefile</label>
                  </li><li><label><input name="markdown.js" checked type="checkbox" value="0" class="colorete_lang common"> Markdown</label>
                  </li><li><label><input name="nginx.js" checked type="checkbox" value="0" class="colorete_lang common"> Nginx</label>
                  </li><li><label><input name="objectivec.js" checked type="checkbox" value="0" class="colorete_lang common"> Objective-C</label>
                  </li><li><label><input name="php.js" checked type="checkbox" value="0" class="colorete_lang common"> PHP</label>
                  </li><li><label><input name="perl.js" checked type="checkbox" value="0" class="colorete_lang common"> Perl</label>
                  </li><li><label><input name="python.js" checked type="checkbox" value="0" class="colorete_lang common"> Python</label>
                  </li><li><label><input name="ruby.js" checked type="checkbox" value="0" class="colorete_lang common"> Ruby</label>
                  </li><li><label><input name="sql.js" checked type="checkbox" value="0" class="colorete_lang common"> SQL</label>
                </li></ul>
                <p><b>Other</b></p>
                <ul id="language_support_list_other">
                  <li><label><input name="1c.js" type="checkbox" value="1" class="colorete_lang"> 1C</label>
                  </li><li><label><input name="armasm.js" type="checkbox" value="1" class="colorete_lang"> ARM Assembly</label>
                  </li><li><label><input name="avrasm.js" type="checkbox" value="1" class="colorete_lang"> AVR Assembler</label>
                  </li><li><label><input name="accesslog.js" type="checkbox" value="1" class="colorete_lang"> Access log</label>
                  </li><li><label><input name="actionscript.js" type="checkbox" value="1" class="colorete_lang"> ActionScript</label>
                  </li><li><label><input name="applescript.js" type="checkbox" value="1" class="colorete_lang"> AppleScript</label>
                  </li><li><label><input name="arduino.js" type="checkbox" value="1" class="colorete_lang"> Arduino</label>
                  </li><li><label><input name="asciidoc.js" type="checkbox" value="1" class="colorete_lang"> AsciiDoc</label>
                  </li><li><label><input name="aspectj.js" type="checkbox" value="1" class="colorete_lang"> AspectJ</label>
                  </li><li><label><input name="autohotkey.js" type="checkbox" value="1" class="colorete_lang"> AutoHotkey</label>
                  </li><li><label><input name="autoit.js" type="checkbox" value="1" class="colorete_lang"> AutoIt</label>
                  </li><li><label><input name="axapta.js" type="checkbox" value="1" class="colorete_lang"> Axapta</label>
                  </li><li><label><input name="basic.js" type="checkbox" value="1" class="colorete_lang"> Basic</label>
                  </li><li><label><input name="brainfuck.js" type="checkbox" value="1" class="colorete_lang"> Brainfuck</label>
                  </li><li><label><input name="cal.js" type="checkbox" value="1" class="colorete_lang"> C/AL</label>
                  </li><li><label><input name="cmake.js" type="checkbox" value="1" class="colorete_lang"> CMake</label>
                  </li><li><label><input name="csp.js" type="checkbox" value="1" class="colorete_lang"> CSP</label>
                  </li><li><label><input name="cos.js" type="checkbox" value="1" class="colorete_lang"> Caché Object Script</label>
                  </li><li><label><input name="capnproto.js" type="checkbox" value="1" class="colorete_lang"> Cap’n Proto</label>
                  </li><li><label><input name="ceylon.js" type="checkbox" value="1" class="colorete_lang"> Ceylon</label>
                  </li><li><label><input name="clojure.js" type="checkbox" value="1" class="colorete_lang"> Clojure</label>
                  </li><li><label><input name="clojure-repl.js" type="checkbox" value="1" class="colorete_lang"> Clojure REPL</label>
                  </li><li><label><input name="crystal.js" type="checkbox" value="1" class="colorete_lang"> Crystal</label>
                  </li><li><label><input name="d.js" type="checkbox" value="1" class="colorete_lang"> D</label>
                  </li><li><label><input name="dns.js" type="checkbox" value="1" class="colorete_lang"> DNS Zone file</label>
                  </li><li><label><input name="dos.js" type="checkbox" value="1" class="colorete_lang"> DOS .bat</label>
                  </li><li><label><input name="dart.js" type="checkbox" value="1" class="colorete_lang"> Dart</label>
                  </li><li><label><input name="delphi.js" type="checkbox" value="1" class="colorete_lang"> Delphi</label>
                  </li><li><label><input name="django.js" type="checkbox" value="1" class="colorete_lang"> Django</label>
                  </li><li><label><input name="dockerfile.js" type="checkbox" value="1" class="colorete_lang"> Dockerfile</label>
                  </li><li><label><input name="dust.js" type="checkbox" value="1" class="colorete_lang"> Dust</label>
                  </li><li><label><input name="erb.js" type="checkbox" value="1" class="colorete_lang"> ERB (Embedded Ruby)</label>
                  </li><li><label><input name="elixir.js" type="checkbox" value="1" class="colorete_lang"> Elixir</label>
                  </li><li><label><input name="elm.js" type="checkbox" value="1" class="colorete_lang"> Elm</label>
                  </li><li><label><input name="erlang.js" type="checkbox" value="1" class="colorete_lang"> Erlang</label>
                  </li><li><label><input name="erlang-repl.js" type="checkbox" value="1" class="colorete_lang"> Erlang REPL</label>
                  </li><li><label><input name="fsharp.js" type="checkbox" value="1" class="colorete_lang"> F#</label>
                  </li><li><label><input name="fix.js" type="checkbox" value="1" class="colorete_lang"> FIX</label>
                  </li><li><label><input name="fortran.js" type="checkbox" value="1" class="colorete_lang"> Fortran</label>
                  </li><li><label><input name="gcode.js" type="checkbox" value="1" class="colorete_lang"> G-code (ISO 6983)</label>
                  </li><li><label><input name="gams.js" type="checkbox" value="1" class="colorete_lang"> GAMS</label>
                  </li><li><label><input name="gauss.js" type="checkbox" value="1" class="colorete_lang"> GAUSS</label>
                  </li><li><label><input name="glsl.js" type="checkbox" value="1" class="colorete_lang"> GLSL</label>
                  </li><li><label><input name="gherkin.js" type="checkbox" value="1" class="colorete_lang"> Gherkin</label>
                  </li><li><label><input name="go.js" type="checkbox" value="1" class="colorete_lang"> Go</label>
                  </li><li><label><input name="golo.js" type="checkbox" value="1" class="colorete_lang"> Golo</label>
                  </li><li><label><input name="gradle.js" type="checkbox" value="1" class="colorete_lang"> Gradle</label>
                  </li><li><label><input name="groovy.js" type="checkbox" value="1" class="colorete_lang"> Groovy</label>
                  </li><li><label><input name="hsp.js" type="checkbox" value="1" class="colorete_lang"> HSP</label>
                  </li><li><label><input name="htmlbars.js" type="checkbox" value="1" class="colorete_lang"> HTMLBars</label>
                  </li><li><label><input name="haml.js" type="checkbox" value="1" class="colorete_lang"> Haml</label>
                  </li><li><label><input name="handlebars.js" type="checkbox" value="1" class="colorete_lang"> Handlebars</label>
                  </li><li><label><input name="haskell.js" type="checkbox" value="1" class="colorete_lang"> Haskell</label>
                  </li><li><label><input name="haxe.js" type="checkbox" value="1" class="colorete_lang"> Haxe</label>
                  </li><li><label><input name="irpf90.js" type="checkbox" value="1" class="colorete_lang"> IRPF90</label>
                  </li><li><label><input name="inform7.js" type="checkbox" value="1" class="colorete_lang"> Inform 7</label>
                  </li><li><label><input name="x86asm.js" type="checkbox" value="1" class="colorete_lang"> Intel x86 Assembly</label>
                  </li><li><label><input name="julia.js" type="checkbox" value="1" class="colorete_lang"> Julia</label>
                  </li><li><label><input name="kotlin.js" type="checkbox" value="1" class="colorete_lang"> Kotlin</label>
                  </li><li><label><input name="lasso.js" type="checkbox" value="1" class="colorete_lang"> Lasso</label>
                  </li><li><label><input name="less.js" type="checkbox" value="1" class="colorete_lang"> Less</label>
                  </li><li><label><input name="lisp.js" type="checkbox" value="1" class="colorete_lang"> Lisp</label>
                  </li><li><label><input name="livecodeserver.js" type="checkbox" value="1" class="colorete_lang"> LiveCode</label>
                  </li><li><label><input name="livescript.js" type="checkbox" value="1" class="colorete_lang"> LiveScript</label>
                  </li><li><label><input name="lua.js" type="checkbox" value="1" class="colorete_lang"> Lua</label>
                  </li><li><label><input name="mel.js" type="checkbox" value="1" class="colorete_lang"> MEL</label>
                  </li><li><label><input name="mipsasm.js" type="checkbox" value="1" class="colorete_lang"> MIPS Assembly</label>
                  </li><li><label><input name="mathematica.js" type="checkbox" value="1" class="colorete_lang"> Mathematica</label>
                  </li><li><label><input name="matlab.js" type="checkbox" value="1" class="colorete_lang"> Matlab</label>
                  </li><li><label><input name="maxima.js" type="checkbox" value="1" class="colorete_lang"> Maxima</label>
                  </li><li><label><input name="mercury.js" type="checkbox" value="1" class="colorete_lang"> Mercury</label>
                  </li><li><label><input name="mizar.js" type="checkbox" value="1" class="colorete_lang"> Mizar</label>
                  </li><li><label><input name="mojolicious.js" type="checkbox" value="1" class="colorete_lang"> Mojolicious</label>
                  </li><li><label><input name="monkey.js" type="checkbox" value="1" class="colorete_lang"> Monkey</label>
                  </li><li><label><input name="moonscript.js" type="checkbox" value="1" class="colorete_lang"> MoonScript</label>
                  </li><li><label><input name="nsis.js" type="checkbox" value="1" class="colorete_lang"> NSIS</label>
                  </li><li><label><input name="nimrod.js" type="checkbox" value="1" class="colorete_lang"> Nimrod</label>
                  </li><li><label><input name="nix.js" type="checkbox" value="1" class="colorete_lang"> Nix</label>
                  </li><li><label><input name="ocaml.js" type="checkbox" value="1" class="colorete_lang"> OCaml</label>
                  </li><li><label><input name="openscad.js" type="checkbox" value="1" class="colorete_lang"> OpenSCAD</label>
                  </li><li><label><input name="ruleslanguage.js" type="checkbox" value="1" class="colorete_lang"> Oracle Rules Language</label>
                  </li><li><label><input name="oxygene.js" type="checkbox" value="1" class="colorete_lang"> Oxygene</label>
                  </li><li><label><input name="parser3.js" type="checkbox" value="1" class="colorete_lang"> Parser3</label>
                  </li><li><label><input name="powershell.js" type="checkbox" value="1" class="colorete_lang"> PowerShell</label>
                  </li><li><label><input name="processing.js" type="checkbox" value="1" class="colorete_lang"> Processing</label>
                  </li><li><label><input name="prolog.js" type="checkbox" value="1" class="colorete_lang"> Prolog</label>
                  </li><li><label><input name="protobuf.js" type="checkbox" value="1" class="colorete_lang"> Protocol Buffers</label>
                  </li><li><label><input name="puppet.js" type="checkbox" value="1" class="colorete_lang"> Puppet</label>
                  </li><li><label><input name="profile.js" type="checkbox" value="1" class="colorete_lang"> Python profile</label>
                  </li><li><label><input name="q.js" type="checkbox" value="1" class="colorete_lang"> Q</label>
                  </li><li><label><input name="qml.js" type="checkbox" value="1" class="colorete_lang"> QML</label>
                  </li><li><label><input name="r.js" type="checkbox" value="1" class="colorete_lang"> R</label>
                  </li><li><label><input name="rib.js" type="checkbox" value="1" class="colorete_lang"> RenderMan RIB</label>
                  </li><li><label><input name="rsl.js" type="checkbox" value="1" class="colorete_lang"> RenderMan RSL</label>
                  </li><li><label><input name="roboconf.js" type="checkbox" value="1" class="colorete_lang"> Roboconf</label>
                  </li><li><label><input name="rust.js" type="checkbox" value="1" class="colorete_lang"> Rust</label>
                  </li><li><label><input name="scss.js" type="checkbox" value="1" class="colorete_lang"> SCSS</label>
                  </li><li><label><input name="sml.js" type="checkbox" value="1" class="colorete_lang"> SML</label>
                  </li><li><label><input name="sqf.js" type="checkbox" value="1" class="colorete_lang"> SQF</label>
                  </li><li><label><input name="step21.js" type="checkbox" value="1" class="colorete_lang"> STEP Part 21</label>
                  </li><li><label><input name="scala.js" type="checkbox" value="1" class="colorete_lang"> Scala</label>
                  </li><li><label><input name="scheme.js" type="checkbox" value="1" class="colorete_lang"> Scheme</label>
                  </li><li><label><input name="scilab.js" type="checkbox" value="1" class="colorete_lang"> Scilab</label>
                  </li><li><label><input name="smali.js" type="checkbox" value="1" class="colorete_lang"> Smali</label>
                  </li><li><label><input name="smalltalk.js" type="checkbox" value="1" class="colorete_lang"> Smalltalk</label>
                  </li><li><label><input name="stan.js" type="checkbox" value="1" class="colorete_lang"> Stan</label>
                  </li><li><label><input name="stata.js" type="checkbox" value="1" class="colorete_lang"> Stata</label>
                  </li><li><label><input name="stylus.js" type="checkbox" value="1" class="colorete_lang"> Stylus</label>
                  </li><li><label><input name="swift.js" type="checkbox" value="1" class="colorete_lang"> Swift</label>
                  </li><li><label><input name="tp.js" type="checkbox" value="1" class="colorete_lang"> TP</label>
                  </li><li><label><input name="taggerscript.js" type="checkbox" value="1" class="colorete_lang"> Tagger Script</label>
                  </li><li><label><input name="tcl.js" type="checkbox" value="1" class="colorete_lang"> Tcl</label>
                  </li><li><label><input name="tex.js" type="checkbox" value="1" class="colorete_lang"> TeX</label>
                  </li><li><label><input name="thrift.js" type="checkbox" value="1" class="colorete_lang"> Thrift</label>
                  </li><li><label><input name="twig.js" type="checkbox" value="1" class="colorete_lang"> Twig</label>
                  </li><li><label><input name="typescript.js" type="checkbox" value="1" class="colorete_lang"> TypeScript</label>
                  </li><li><label><input name="vbnet.js" type="checkbox" value="1" class="colorete_lang"> VB.NET</label>
                  </li><li><label><input name="vbscript.js" type="checkbox" value="1" class="colorete_lang"> VBScript</label>
                  </li><li><label><input name="vbscript-html.js" type="checkbox" value="1" class="colorete_lang"> VBScript in HTML</label>
                  </li><li><label><input name="vhdl.js" type="checkbox" value="1" class="colorete_lang"> VHDL</label>
                  </li><li><label><input name="vala.js" type="checkbox" value="1" class="colorete_lang"> Vala</label>
                  </li><li><label><input name="verilog.js" type="checkbox" value="1" class="colorete_lang"> Verilog</label>
                  </li><li><label><input name="vim.js" type="checkbox" value="1" class="colorete_lang"> Vim Script</label>
                  </li><li><label><input name="xl.js" type="checkbox" value="1" class="colorete_lang"> XL</label>
                  </li><li><label><input name="xquery.js" type="checkbox" value="1" class="colorete_lang"> XQuery</label>
                  </li><li><label><input name="yaml.js" type="checkbox" value="1" class="colorete_lang"> YAML</label>
                  </li><li><label><input name="zephir.js" type="checkbox" value="1" class="colorete_lang"> Zephir</label>
                  </li><li><label><input name="crmsh.js" type="checkbox" value="1" class="colorete_lang"> crmsh</label>
                  </li><li><label><input name="pf.js" type="checkbox" value="1" class="colorete_lang"> pf</label>
                </li></ul>
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

        <!-- text edit : tab replace -->
        <p class="section">
          <label for="colorete_option_tab_replace"><?php echo __('Highlight.js Option - Tab replace:', 'colorete'); ?></label><br/>
          <input type="text" name="colorete_option_tab_replace" id="colorete_option_tab_replace" value="<?php echo colorete_get_lib_option('tabReplace'); ?>" /><br />

          <label for="colorete_option_class_prefix"><?php echo __('Highlight.js Option - Class prefix:', 'colorete') ?></label><br/>
          <input type="text" name="colorete_option_class_prefix" id="colorete_option_class_prefix" value="<?php echo colorete_get_lib_option('classPrefix'); ?>" /><br />

          <label for="colorete_option_use_br"><?php echo __('Highlight.js Option - Use BR:', 'colorete') ?></label>
          <input type="checkbox" name="colorete_option_use_br" id="colorete_option_use_br" value="1" <?php if(colorete_get_lib_option('useBR')) echo ' checked="checked"'; ?> /><br />

          <label for="colorete_option_languages"><?php echo __('Highlight.js Option - Languages:', 'colorete'); ?></label><br/>
          <textarea type="text" name="colorete_option_languages" id="colorete_option_languages" value="<?php echo colorete_get_lib_option('languages'); ?>"><?php echo colorete_get_lib_option('languages'); ?></textarea><br />
       </p>

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
                    <td><p><a href="http://owent.net"><?php echo __('OWenT', 'colorete'); ?></a> &lt;<a href="mailto:owent@owent.net">owent@owent.net</a>&gt;</p></td>
                </tr>

                <tr>
                    <td width="120px" align="center"><?php echo __('Plugin Info', 'colorete'); ?></td>
                    <td><?php echo __('<p>This is a wordpress plugin for <a href="http://highlightjs.org/">highlight.js</a> library.
                        <a href="http://highlightjs.org/">Highlight.js</a> highlights syntax in code examples on web pages.
                        It&acute;s very easy to use because it works automatically: finds blocks of code, detects a language, highlights it.</p>
                        <p>And it&acute;s very easy to work with <a href="https://stackedit.io/" target="_blank">stackedit</a> or other markdown editors</p>
                        ', 'colorete'); ?></td>
                </tr>

                <tr>
                    <td width="120px" align="center"><?php echo __('Plugin Usage', 'colorete'); ?></td>
                    <td><?php echo __('<p>For code highlighting you should use one of the following ways.</p>
                            <p><strong>The first way</strong> is to use bb-codes:</p>
                            <p><pre><code>[code] this language will be automatically determined [/code]</code></pre></p>
                        <p><pre><code>[code lang="cpp"] highlight the code with certain language [/code]</code></pre></p>
                            <p><strong>The second way</strong> is to use html-tags:</p>
                            <p><pre><code class="html">&lt;pre&gt;&lt;code&gt; this language will be automatically determined &lt;/code&gt;&lt;/pre&gt;</code></pre></p>
                            <p><pre><code class="html">&lt;pre&gt;&lt;code bbcode=enable&gt; this language will be [b]automatically determined[\b] and inner bbcode is available &lt;/code&gt;&lt;/pre&gt;</code></pre></p>
                        <p><pre><code class="html">&lt;pre&gt;&lt;code class="html"&gt; highlight the code with certain language &lt;/code&gt;&lt;/pre&gt;</code></pre></p>', 'colorete'); ?></td>
                </tr>
                <tr>
                    <td width="120px" align="center"><?php echo __('Donate', 'colorete'); ?></td>
                    <td><?php echo __('If you interested my work, welcome to visit <a href="https://github.com/owt5008137/WP-Code-Highlight.js/#donate" target="_blank">https://github.com/owt5008137/WP-Code-Highlight.js/#donate</a> to donate me for a cup of coffee.', 'colorete'); ?></td>
                </tr>
                <tr>
                    <td width="120px" align="center"><?php echo __('Thanks To', 'colorete'); ?></td>
                    <td><ul>
                            <li><a href="http://softwaremaniacs.org/">Ivan Sagalaev</a> (for his <a href="http://highlightjs.org/">highlight.js</a>)</li>
                            <li><a href="http://kalnitsky.org">Igor Kalnitsky</a> (for his <a href="https://wordpress.org/plugins/wp-highlightjs/">wp-highlight.js</a> plugin)</li>
                    </ul></td>
                </tr>
                <tr>
                    <td width="120px" align="center"><?php echo __('Thanks To', 'colorete'); ?></td>
                    <td><h3><?php echo __('Contributor List', 'colorete'); ?>:</h3><br /><ul>
                            <li><a href="http://geraint.co">Geraint Palmer</a></li>
                            <li><a href="http://www.codingserf.com">David</a></li>
                            <li><a href="http://www.shiyaluo.com">shiya</a></li>
                            <li><a href="https://github.com/Beej126">Beej126</a></li>
                    </ul></td>
                </tr>
           </table>
    </div>

    <!-- /html code of settings page -->

<?php
}
