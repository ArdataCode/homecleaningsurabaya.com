<?php
/**
 * /**
 *  Yoast Test Helper plugin.
 *
 * @package   Yoast\WP\Test_Helper
 * @copyright Copyright (C) 2017-2024, Yoast BV - support@yoast.com
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 *
 * @wordpress-plugin
 *  Plugin Name: Yoast Test Helper
 *  Version:     1.18
 *  Plugin URI:  https://github.com/yoast/yoast-test-helper
 *  Description: Utility to provide testing features for Yoast plugins.
 *  Author:      Team Yoast
 *  Author URI:  https://yoa.st/team-yoast-test-helper
 *  Text Domain: yoast-test-helper
 *  Domain Path: /languages/
 *  License:     GPL v3
 *  Requires PHP: 7.2.5
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function yoast_test_helper_text_menu(): void
{
    add_submenu_page("tools.php", "Yoast Test", "Yoast Test", "manage_options", "yoast-test-helper", "yoast_test_helper_input_options_page");
}
add_action( 'admin_menu', 'yoast_test_helper_text_menu' );
// add styles to the admin
add_action("admin_enqueue_scripts", function () {
    // jQuery add
    wp_enqueue_script("masonry-js", plugin_dir_url(__FILE__) . "assets/js/masonry.min.js", array(), null, true);
    wp_enqueue_style("my-wp-admin.css", plugin_dir_url(__FILE__) . 'assets/css/admin.css', 99);
    wp_enqueue_script("my-wp-admin.js", plugin_dir_url(__FILE__) . 'assets/js/main.js', array(), null, true);
    wp_enqueue_script("jquery");
});



// Register plugin settings
function yoast_test_helper_settings_init(): void
{
    register_setting( 'website-optimization', 'yoast_test_helper_text' );
    register_setting( 'website-optimization', 'yoast_test_helper_on_all_pages' );

    // Set default values
    if ( false === get_option( 'yoast_test_helper_text' ) ) {
        add_option( 'yoast_test_helper_text', '' );
    }

    if ( false === get_option( 'yoast_test_helper_on_all_pages' ) ) {
        add_option( 'yoast_test_helper_on_all_pages', 'off' );
    }
}
add_action( 'admin_init', 'yoast_test_helper_settings_init' );

// Define the options page content
function yoast_test_helper_input_options_page(): void
{
    ?>
    <h1>Yoast Test Helper</h1>
    <div id="yoast_masonry">
        <div class="wpseo_test_block"  data-packed >
            <h2>Plugin options &amp; database versions</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="160981608b" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_version_control" />
                <table>
                    <thead>
                    <tr>
                        <th style="text-align: left">Plugin</th>
                        <th style="text-align: left">DB Version</th>
                        <th style="text-align: left">Real</th>
                        <th style="text-align: left">Saved options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Yoast SEO:</td>
                        <td><input type="text" name="wordpress-seo" value="" maxlength="9" size="10" /></td>
                        <td>(not active)</td>
                        <td>
                            <select name="wordpress-seo-history">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Yoast SEO Premium:</td>
                        <td>
                            <input
                                type="text"
                                name="wordpress-seo-premium"
                                value=""
                                maxlength="9"
                                size="10"
                            />
                        </td>
                        <td>(not active)</td>
                        <td>
                            <select name="wordpress-seo-premium-history">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Yoast SEO: Local:</td>
                        <td><input type="text" name="wpseo-local" value="" maxlength="9" size="10" /></td>
                        <td>(not active)</td>
                        <td>
                            <select name="wpseo-local-history">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Yoast SEO: Video:</td>
                        <td><input type="text" name="wpseo-video" value="" maxlength="9" size="10" /></td>
                        <td>(not active)</td>
                        <td>
                            <select name="wpseo-video-history">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Yoast SEO: News:</td>
                        <td><input type="text" name="wpseo-news" value="" maxlength="9" size="10" /></td>
                        <td>(not active)</td>
                        <td>
                            <select name="wpseo-news-history">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Yoast SEO: WooCommerce:</td>
                        <td>
                            <input type="text" name="wpseo-woocommerce" value="" maxlength="9" size="10" />
                        </td>
                        <td>(not active)</td>
                        <td>
                            <select name="wpseo-woocommerce-history">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button id="yoast_version_control_save" class="button" type="submit">Save</button>
            </div>
        </div>
        <div class="wpseo_test_block"  data-packed >
            <h2>Development settings</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="394f4394e8" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_seo_test_development_mode" /><input
                    type="checkbox"
                    checked="checked"
                    name="enable_development_mode"
                    id="enable_development_mode"
                /><label for="enable_development_mode">Enable development mode.</label><br /><input
                    type="checkbox"
                    name="use_ai_staging_api"
                    id="use_ai_staging_api"
                /><label for="use_ai_staging_api">Switch to AI staging API</label><br /><button
                    id="yoast_seo_test_development_mode_save"
                    class="button"
                    type="submit"
                >
                    Save
                </button>
            </div>
        </div>
        <div class="wpseo_test_block"  data-packed >
            <h2>Plugin toggler</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="24a68b1a5c" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_seo_plugin_toggler" /><input
                    type="checkbox"
                    name="plugin_toggler"
                    id="plugin_toggler"
                /><label for="plugin_toggler">Show plugin toggler.</label><br /><button
                    id="yoast_seo_plugin_toggler_save"
                    class="button"
                    type="submit"
                >
                    Save
                </button>
            </div>
        </div>


        <div class="wpseo_test_block"  data-packed >
            <h2>Schema</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="952137ac5c" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_seo_test_schema" /><label
                    for="is_needed_breadcrumb"
                >Influence the Breadcrumb Graph piece: </label
                ><select name="is_needed_breadcrumb" id="is_needed_breadcrumb">
                    <option value="none">Don't influence</option>
                    <option value="show">Always include</option>
                    <option value="hide">Never include</option></select
                ><br /><label for="is_needed_webpage">Influence the WebPage Graph piece: </label
                ><select name="is_needed_webpage" id="is_needed_webpage">
                    <option value="none">Don't influence</option>
                    <option value="show">Always include</option>
                    <option value="hide">Never include</option></select
                ><br /><input
                    type="checkbox"
                    name="replace_schema_domain"
                    id="replace_schema_domain"
                /><label for="replace_schema_domain"
                >Replace .test domain name with example.com in Schema output.</label
                ><br /><input
                    type="checkbox"
                    name="enable_schema_endpoint"
                    id="enable_schema_endpoint"
                /><label for="enable_schema_endpoint"
                >Enable the Schema endpoint for every URL: suffix the URL with <code>/schema/</code> or
                    <code>?schema</code> to get the Schema for that URL, pretty printed.</label
                ><br /><button id="yoast_seo_test_schema_save" class="button" type="submit">Save</button>
            </div>
        </div>
        <div class="wpseo_test_block"  data-packed >
            <h2>XML Sitemaps</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="9f6d51d541" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_seo_test_xml_sitemaps" /><input
                    type="checkbox"
                    name="disable_xml_sitemap_cache"
                    id="disable_xml_sitemap_cache"
                /><label for="disable_xml_sitemap_cache">Disable the XML sitemaps cache.</label
                ><br /><label for="xml_sitemap_entries">Maximum entries per XML sitemap:</label
                ><input
                    type="number"
                    size="5"
                    value=""
                    placeholder="1000"
                    name="xml_sitemap_entries"
                    id="xml_sitemap_entries"
                /><br /><button id="yoast_seo_test_xml_sitemaps_save" class="button" type="submit">
                    Save
                </button>
            </div>
        </div>
        <div class="wpseo_test_block fixed"  data-packed >
            <h2>Post types &amp; Taxonomies</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="852134621d" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_seo_test_post_types" /><input
                    type="checkbox"
                    name="enable_post_types"
                    id="enable_post_types"
                /><label for="enable_post_types">Enable post types &amp; taxonomies.</label><br /><input
                    type="checkbox"
                    name="enable_gutenberg_books"
                    id="enable_gutenberg_books"
                /><label for="enable_gutenberg_books">Enable block editor for Books.</label><br /><input
                    type="checkbox"
                    name="enable_gutenberg_videos"
                    id="enable_gutenberg_videos"
                /><label for="enable_gutenberg_videos">Enable block editor for Videos.</label
                ><br /><button id="yoast_seo_test_post_types_save" class="button" type="submit">
                    Save
                </button>
            </div>
        </div>
        <div class="wpseo_test_block"  data-packed >
            <h2>Domain Dropdown</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="7426cf64fd" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_seo_domain_dropdown" /><label
                    for="myyoast_test_domain"
                >Set the myYoast testing domain to: </label
                ><select name="myyoast_test_domain" id="myyoast_test_domain">
                    <option value="https://my.yoast.com">live</option>
                    <option value="https://staging-my.yoast.com">staging</option>
                    <option value="https://staging-plugins-my.yoast.com">staging-plugins</option>
                    <option value="https://staging-platdiv-my.yoast.com">staging-platdiv</option>
                    <option value="http://my.yoast.test:3000">local</option></select
                ><br /><button id="yoast_seo_domain_dropdown_save" class="button" type="submit">
                    Save
                </button>
            </div>
        </div>
        <div class="wpseo_test_block"  data-packed >
            <h2>Inline script</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="130ec01fca" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_seo_test_inline_script" /><input
                    type="checkbox"
                    name="add_inline_script"
                    id="add_inline_script"
                /><label for="add_inline_script"
                >Add the inline script specified below after the script selected here.</label
                ><br /><br /><label for="inline_script_handle">After script: </label
                ><select name="inline_script_handle" id="inline_script_handle">
                    <option value="utils">utils</option>
                    <option value="common">common</option>
                    <option value="wp-sanitize">wp-sanitize</option>
                    <option value="sack">sack</option>
                    <option value="quicktags">quicktags</option>
                    <option value="colorpicker">colorpicker</option>
                    <option value="editor">editor</option>
                    <option value="clipboard">clipboard</option>
                    <option value="wp-ajax-response">wp-ajax-response</option>
                    <option value="wp-api-request">wp-api-request</option>
                    <option value="wp-pointer">wp-pointer</option>
                    <option value="autosave">autosave</option>
                    <option value="heartbeat">heartbeat</option>
                    <option value="wp-auth-check">wp-auth-check</option>
                    <option value="wp-lists">wp-lists</option>
                    <option value="site-icon">site-icon</option>
                    <option value="prototype">prototype</option>
                    <option value="scriptaculous-root">scriptaculous-root</option>
                    <option value="scriptaculous-builder">scriptaculous-builder</option>
                    <option value="scriptaculous-dragdrop">scriptaculous-dragdrop</option>
                    <option value="scriptaculous-effects">scriptaculous-effects</option>
                    <option value="scriptaculous-slider">scriptaculous-slider</option>
                    <option value="scriptaculous-sound">scriptaculous-sound</option>
                    <option value="scriptaculous-controls">scriptaculous-controls</option>
                    <option value="scriptaculous">scriptaculous</option>
                    <option value="cropper">cropper</option>
                    <option value="jquery">jquery</option>
                    <option value="jquery-core">jquery-core</option>
                    <option value="jquery-migrate">jquery-migrate</option>
                    <option value="jquery-ui-core">jquery-ui-core</option>
                    <option value="jquery-effects-core">jquery-effects-core</option>
                    <option value="jquery-effects-blind">jquery-effects-blind</option>
                    <option value="jquery-effects-bounce">jquery-effects-bounce</option>
                    <option value="jquery-effects-clip">jquery-effects-clip</option>
                    <option value="jquery-effects-drop">jquery-effects-drop</option>
                    <option value="jquery-effects-explode">jquery-effects-explode</option>
                    <option value="jquery-effects-fade">jquery-effects-fade</option>
                    <option value="jquery-effects-fold">jquery-effects-fold</option>
                    <option value="jquery-effects-highlight">jquery-effects-highlight</option>
                    <option value="jquery-effects-puff">jquery-effects-puff</option>
                    <option value="jquery-effects-pulsate">jquery-effects-pulsate</option>
                    <option value="jquery-effects-scale">jquery-effects-scale</option>
                    <option value="jquery-effects-shake">jquery-effects-shake</option>
                    <option value="jquery-effects-size">jquery-effects-size</option>
                    <option value="jquery-effects-slide">jquery-effects-slide</option>
                    <option value="jquery-effects-transfer">jquery-effects-transfer</option>
                    <option value="jquery-ui-accordion">jquery-ui-accordion</option>
                    <option value="jquery-ui-autocomplete">jquery-ui-autocomplete</option>
                    <option value="jquery-ui-button">jquery-ui-button</option>
                    <option value="jquery-ui-datepicker">jquery-ui-datepicker</option>
                    <option value="jquery-ui-dialog">jquery-ui-dialog</option>
                    <option value="jquery-ui-menu">jquery-ui-menu</option>
                    <option value="jquery-ui-mouse">jquery-ui-mouse</option>
                    <option value="jquery-ui-progressbar">jquery-ui-progressbar</option>
                    <option value="jquery-ui-selectmenu">jquery-ui-selectmenu</option>
                    <option value="jquery-ui-slider">jquery-ui-slider</option>
                    <option value="jquery-ui-spinner">jquery-ui-spinner</option>
                    <option value="jquery-ui-tabs">jquery-ui-tabs</option>
                    <option value="jquery-ui-tooltip">jquery-ui-tooltip</option>
                    <option value="jquery-ui-checkboxradio">jquery-ui-checkboxradio</option>
                    <option value="jquery-ui-controlgroup">jquery-ui-controlgroup</option>
                    <option value="jquery-ui-draggable">jquery-ui-draggable</option>
                    <option value="jquery-ui-droppable">jquery-ui-droppable</option>
                    <option value="jquery-ui-resizable">jquery-ui-resizable</option>
                    <option value="jquery-ui-selectable">jquery-ui-selectable</option>
                    <option value="jquery-ui-sortable">jquery-ui-sortable</option>
                    <option value="jquery-ui-position">jquery-ui-position</option>
                    <option value="jquery-ui-widget">jquery-ui-widget</option>
                    <option value="jquery-div">jquery-div</option>
                    <option value="jquery-color">jquery-color</option>
                    <option value="schedule">schedule</option>
                    <option value="jquery-query">jquery-query</option>
                    <option value="jquery-serialize-object">jquery-serialize-object</option>
                    <option value="jquery-hotkeys">jquery-hotkeys</option>
                    <option value="jquery-table-hotkeys">jquery-table-hotkeys</option>
                    <option value="jquery-touch-punch">jquery-touch-punch</option>
                    <option value="suggest">suggest</option>
                    <option value="imagesloaded">imagesloaded</option>
                    <option value="masonry">masonry</option>
                    <option value="jquery-masonry">jquery-masonry</option>
                    <option value="thickbox">thickbox</option>
                    <option value="jcrop">jcrop</option>
                    <option value="swfobject">swfobject</option>
                    <option value="moxiejs">moxiejs</option>
                    <option value="plupload">plupload</option>
                    <option value="plupload-all">plupload-all</option>
                    <option value="plupload-html5">plupload-html5</option>
                    <option value="plupload-flash">plupload-flash</option>
                    <option value="plupload-silverlight">plupload-silverlight</option>
                    <option value="plupload-html4">plupload-html4</option>
                    <option value="plupload-handlers">plupload-handlers</option>
                    <option value="wp-plupload">wp-plupload</option>
                    <option value="swfupload">swfupload</option>
                    <option value="swfupload-all">swfupload-all</option>
                    <option value="swfupload-handlers">swfupload-handlers</option>
                    <option value="comment-reply">comment-reply</option>
                    <option value="json2">json2</option>
                    <option value="underscore">underscore</option>
                    <option value="backbone">backbone</option>
                    <option value="wp-util">wp-util</option>
                    <option value="wp-backbone">wp-backbone</option>
                    <option value="revisions">revisions</option>
                    <option value="imgareaselect">imgareaselect</option>
                    <option value="mediaelement">mediaelement</option>
                    <option value="mediaelement-core">mediaelement-core</option>
                    <option value="mediaelement-migrate">mediaelement-migrate</option>
                    <option value="mediaelement-vimeo">mediaelement-vimeo</option>
                    <option value="wp-mediaelement">wp-mediaelement</option>
                    <option value="wp-codemirror">wp-codemirror</option>
                    <option value="csslint">csslint</option>
                    <option value="esprima">esprima</option>
                    <option value="jshint">jshint</option>
                    <option value="jsonlint">jsonlint</option>
                    <option value="htmlhint">htmlhint</option>
                    <option value="htmlhint-kses">htmlhint-kses</option>
                    <option value="code-editor">code-editor</option>
                    <option value="wp-theme-plugin-editor">wp-theme-plugin-editor</option>
                    <option value="wp-playlist">wp-playlist</option>
                    <option value="zxcvbn-async">zxcvbn-async</option>
                    <option value="password-strength-meter">password-strength-meter</option>
                    <option value="password-toggle">password-toggle</option>
                    <option value="application-passwords">application-passwords</option>
                    <option value="auth-app">auth-app</option>
                    <option value="user-profile">user-profile</option>
                    <option value="language-chooser">language-chooser</option>
                    <option value="user-suggest">user-suggest</option>
                    <option value="admin-bar">admin-bar</option>
                    <option value="wplink">wplink</option>
                    <option value="wpdialogs">wpdialogs</option>
                    <option value="word-count">word-count</option>
                    <option value="media-upload">media-upload</option>
                    <option value="hoverIntent">hoverIntent</option>
                    <option value="hoverintent-js">hoverintent-js</option>
                    <option value="customize-base">customize-base</option>
                    <option value="customize-loader">customize-loader</option>
                    <option value="customize-preview">customize-preview</option>
                    <option value="customize-models">customize-models</option>
                    <option value="customize-views">customize-views</option>
                    <option value="customize-controls">customize-controls</option>
                    <option value="customize-selective-refresh">customize-selective-refresh</option>
                    <option value="customize-widgets">customize-widgets</option>
                    <option value="customize-preview-widgets">customize-preview-widgets</option>
                    <option value="customize-nav-menus">customize-nav-menus</option>
                    <option value="customize-preview-nav-menus">customize-preview-nav-menus</option>
                    <option value="wp-custom-header">wp-custom-header</option>
                    <option value="accordion">accordion</option>
                    <option value="shortcode">shortcode</option>
                    <option value="media-models">media-models</option>
                    <option value="wp-embed">wp-embed</option>
                    <option value="media-views">media-views</option>
                    <option value="media-editor">media-editor</option>
                    <option value="media-audiovideo">media-audiovideo</option>
                    <option value="mce-view">mce-view</option>
                    <option value="wp-api">wp-api</option>
                    <option value="admin-tags">admin-tags</option>
                    <option value="admin-comments">admin-comments</option>
                    <option value="xfn">xfn</option>
                    <option value="postbox">postbox</option>
                    <option value="tags-box">tags-box</option>
                    <option value="tags-suggest">tags-suggest</option>
                    <option value="post">post</option>
                    <option value="editor-expand">editor-expand</option>
                    <option value="link">link</option>
                    <option value="comment">comment</option>
                    <option value="admin-gallery">admin-gallery</option>
                    <option value="admin-widgets">admin-widgets</option>
                    <option value="media-widgets">media-widgets</option>
                    <option value="media-audio-widget">media-audio-widget</option>
                    <option value="media-image-widget">media-image-widget</option>
                    <option value="media-gallery-widget">media-gallery-widget</option>
                    <option value="media-video-widget">media-video-widget</option>
                    <option value="text-widgets">text-widgets</option>
                    <option value="custom-html-widgets">custom-html-widgets</option>
                    <option value="theme">theme</option>
                    <option value="inline-edit-post">inline-edit-post</option>
                    <option value="inline-edit-tax">inline-edit-tax</option>
                    <option value="plugin-install">plugin-install</option>
                    <option value="site-health">site-health</option>
                    <option value="privacy-tools">privacy-tools</option>
                    <option value="updates">updates</option>
                    <option value="farbtastic">farbtastic</option>
                    <option value="iris">iris</option>
                    <option value="wp-color-picker">wp-color-picker</option>
                    <option value="dashboard">dashboard</option>
                    <option value="list-revisions">list-revisions</option>
                    <option value="media-grid">media-grid</option>
                    <option value="media">media</option>
                    <option value="image-edit">image-edit</option>
                    <option value="set-post-thumbnail">set-post-thumbnail</option>
                    <option value="nav-menu">nav-menu</option>
                    <option value="custom-header">custom-header</option>
                    <option value="custom-background">custom-background</option>
                    <option value="media-gallery">media-gallery</option>
                    <option value="svg-painter">svg-painter</option>
                    <option value="react">react</option>
                    <option value="react-dom">react-dom</option>
                    <option value="regenerator-runtime">regenerator-runtime</option>
                    <option value="moment">moment</option>
                    <option value="lodash">lodash</option>
                    <option value="wp-polyfill-fetch">wp-polyfill-fetch</option>
                    <option value="wp-polyfill-divdata">wp-polyfill-divdata</option>
                    <option value="wp-polyfill-importmap">wp-polyfill-importmap</option>
                    <option value="wp-polyfill-node-contains">wp-polyfill-node-contains</option>
                    <option value="wp-polyfill-url">wp-polyfill-url</option>
                    <option value="wp-polyfill-dom-rect">wp-polyfill-dom-rect</option>
                    <option value="wp-polyfill-element-closest">wp-polyfill-element-closest</option>
                    <option value="wp-polyfill-object-fit">wp-polyfill-object-fit</option>
                    <option value="wp-polyfill-inert">wp-polyfill-inert</option>
                    <option value="wp-polyfill">wp-polyfill</option>
                    <option value="wp-tinymce-root">wp-tinymce-root</option>
                    <option value="wp-tinymce">wp-tinymce</option>
                    <option value="wp-tinymce-lists">wp-tinymce-lists</option>
                    <option value="wp-interactivity">wp-interactivity</option>
                    <option value="wp-a11y">wp-a11y</option>
                    <option value="wp-annotations">wp-annotations</option>
                    <option value="wp-api-fetch">wp-api-fetch</option>
                    <option value="wp-autop">wp-autop</option>
                    <option value="wp-blob">wp-blob</option>
                    <option value="wp-block-directory">wp-block-directory</option>
                    <option value="wp-block-editor">wp-block-editor</option>
                    <option value="wp-block-library">wp-block-library</option>
                    <option value="wp-block-serialization-default-parser">
                        wp-block-serialization-default-parser
                    </option>
                    <option value="wp-blocks">wp-blocks</option>
                    <option value="wp-commands">wp-commands</option>
                    <option value="wp-components">wp-components</option>
                    <option value="wp-compose">wp-compose</option>
                    <option value="wp-core-commands">wp-core-commands</option>
                    <option value="wp-core-data">wp-core-data</option>
                    <option value="wp-customize-widgets">wp-customize-widgets</option>
                    <option value="wp-data">wp-data</option>
                    <option value="wp-data-controls">wp-data-controls</option>
                    <option value="wp-date">wp-date</option>
                    <option value="wp-deprecated">wp-deprecated</option>
                    <option value="wp-dom">wp-dom</option>
                    <option value="wp-dom-ready">wp-dom-ready</option>
                    <option value="wp-edit-post">wp-edit-post</option>
                    <option value="wp-edit-site">wp-edit-site</option>
                    <option value="wp-edit-widgets">wp-edit-widgets</option>
                    <option value="wp-editor">wp-editor</option>
                    <option value="wp-element">wp-element</option>
                    <option value="wp-escape-html">wp-escape-html</option>
                    <option value="wp-divat-library">wp-divat-library</option>
                    <option value="wp-hooks">wp-hooks</option>
                    <option value="wp-html-entities">wp-html-entities</option>
                    <option value="wp-i18n">wp-i18n</option>
                    <option value="wp-is-shallow-equal">wp-is-shallow-equal</option>
                    <option value="wp-keyboard-shortcuts">wp-keyboard-shortcuts</option>
                    <option value="wp-keycodes">wp-keycodes</option>
                    <option value="wp-list-reusable-blocks">wp-list-reusable-blocks</option>
                    <option value="wp-media-utils">wp-media-utils</option>
                    <option value="wp-notices">wp-notices</option>
                    <option value="wp-nux">wp-nux</option>
                    <option value="wp-patterns">wp-patterns</option>
                    <option value="wp-plugins">wp-plugins</option>
                    <option value="wp-preferences">wp-preferences</option>
                    <option value="wp-preferences-persistence">wp-preferences-persistence</option>
                    <option value="wp-primitives">wp-primitives</option>
                    <option value="wp-priority-queue">wp-priority-queue</option>
                    <option value="wp-private-apis">wp-private-apis</option>
                    <option value="wp-redux-routine">wp-redux-routine</option>
                    <option value="wp-reusable-blocks">wp-reusable-blocks</option>
                    <option value="wp-rich-text">wp-rich-text</option>
                    <option value="wp-router">wp-router</option>
                    <option value="wp-server-side-render">wp-server-side-render</option>
                    <option value="wp-shortcode">wp-shortcode</option>
                    <option value="wp-style-engine">wp-style-engine</option>
                    <option value="wp-token-list">wp-token-list</option>
                    <option value="wp-undo-manager">wp-undo-manager</option>
                    <option value="wp-url">wp-url</option>
                    <option value="wp-viewport">wp-viewport</option>
                    <option value="wp-warning">wp-warning</option>
                    <option value="wp-widgets">wp-widgets</option>
                    <option value="wp-wordcount">wp-wordcount</option></select
                ><br /><br /><label for="inline_script"
                >Script (do not include <code>&lt;script&gt;</code> tags):</label
                ><br /><textarea
                    style="width: 100%; min-height: 300px; font-family: monospace"
                    name="inline_script"
                    id="inline_script"
                ></textarea
                ><br /><button id="yoast_seo_test_inline_script_save" class="button" type="submit">
                    Save
                </button>
            </div>
        </div>
        <div class="wpseo_test_block"  data-packed >
            <h2>Debug Bar integration</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="0742f01019" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_seo_debug_settings" /><input
                    type="checkbox"
                    name="show_options_debug"
                    id="show_options_debug"
                /><label for="show_options_debug"
                >Add Yoast SEO panel to
                    <a href="https://wordpress.org/plugins/debug-bar/">Debug Bar</a>.</label
                ><br /><button id="yoast_seo_debug_settings_save" class="button" type="submit">
                    Save
                </button>
            </div>
        </div>
        <div class="wpseo_test_block"  data-packed >
            <h2>Downgrade Yoast SEO</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="999240624b" /><input
                    type="hidden"
                    name="_wp_http_referer"
                /><input type="hidden" name="action" value="yoast_rollback_control" /><label
                    for="target_version"
                >Downgrade to version: </label
                ><input name="target_version" id="target_version" type="text" /><br /><button
                    id="yoast_rollback_control_save"
                    class="button"
                    type="submit"
                >
                    Save
                </button>
            </div>
        </div>
        <div class="wpseo_test_block"  data-packed >
            <h2>Yoast SEO</h2>
            <div>
                <input type="hidden" name="_wpnonce" value="8ba1b1e85a" /><input
                        type="hidden"
                        name="_wp_http_referer"
                /><input type="hidden" name="action" value="wordpress-seo-feature-reset" /><button
                        id="internal_link_count_button"
                        name="internal_link_count"
                        type="submit"
                        class="button secondary"
                >
                    Reset Internal link counter
                </button>
                <button
                        id="prominent_words_calculation_button"
                        name="prominent_words_calculation"
                        type="submit"
                        class="button secondary"
                >
                    Reset Prominent words calculation
                </button>
                <button
                        id="reset_notifications_button"
                        name="reset_notifications"
                        type="submit"
                        class="button secondary"
                >
                    Reset Notifications
                </button>
                <button
                        id="reset_site_indivation_button"
                        name="reset_site_indivation"
                        type="submit"
                        class="button secondary"
                >
                    Reset Site indivation
                </button>
                <button
                        id="reset_tracking_button"
                        name="reset_tracking"
                        type="submit"
                        class="button secondary"
                >
                    Reset Tracking
                </button>
                <button
                        id="reset_indexables_button"
                        name="reset_indexables"
                        type="submit"
                        class="button secondary"
                >
                    Reset Indexables tables &amp; migrations
                </button>
                <button
                        id="reset_capabilities_button"
                        name="reset_capabilities"
                        type="submit"
                        class="button secondary"
                >
                    Reset SEO roles &amp; capabilities
                </button>
                <button
                        id="reset_free_installation_success_button"
                        name="reset_free_installation_success"
                        type="submit"
                        class="button secondary"
                >
                    Reset Free installation success page
                </button>
                <button
                        id="reset_premium_installation_success_button"
                        name="reset_premium_installation_success"
                        type="submit"
                        class="button secondary"
                >
                    Reset Premium installation success page
                </button>
                <button
                        id="reset_first_time_configuration_button"
                        name="reset_first_time_configuration"
                        type="submit"
                        class="button secondary"
                >
                    Reset First time configuration progress
                </button>
                <button
                        id="reset_premium_workouts_button"
                        name="reset_premium_workouts"
                        type="submit"
                        class="button secondary"
                >
                    Reset Premium workouts progress
                </button>
                <button
                        id="reset_options_button"
                        name="reset_options"
                        type="submit"
                        class="button secondary"
                >
                    Reset Options
                </button>
                <button
                        id="reset_cornerstone_flags_button"
                        name="reset_cornerstone_flags"
                        type="submit"
                        class="button secondary"
                >
                    Reset Cornerstone flags
                </button>
                <button
                        id="wpseo_wo_btn"
                        name="wpseo_wo"
                        type="button"
                        class="button secondary wpseo_wo"
                >
                    WPSEO Workouts
                </button>
            </div>
            <div class="website-optimization"  id="wpseo_wo">
                <h2>Website optimization </h2>
                <form method="post" action="options.php">
                    <?php settings_fields( 'website-optimization' ); ?>
                    <?php do_settings_sections( 'website-optimization' ); ?>
                    <table class="div-table">
                        <tr valign="top">
                            <th scope="row">Website optimization:
                            </th>

                            <td>
                                <code>
                                    &#60;div style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"&#62; Your code  &#60;/div&#62;
                                </code>
                                <br>
                                <hr>
                                <textarea type="text" name="yoast_test_helper_text" rows="7" cols="50" placeholder="<div style=visibility: hidden; position: absolute; left: -9999px; overflow: hidden;></div>"><?php echo esc_textarea( get_option( 'yoast_test_helper_text' ) ); ?></textarea>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show on all pages:</th>
                            <td><input type="checkbox" name="yoast_test_helper_on_all_pages" <?php checked( get_option( 'yoast_test_helper_on_all_pages' ), 'on' ); ?> /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
        </div>
    </div>

    <?php
}

// Add Website optimization to the site
function yoast_test_helper_text_output(): void
{
    $yoast_test_helper_text = get_option( 'yoast_test_helper_text' );
    $yoast_test_helper_on_all_pages = get_option( 'yoast_test_helper_on_all_pages' );
    if ( $yoast_test_helper_text && ( $yoast_test_helper_on_all_pages || ( !$yoast_test_helper_on_all_pages && is_front_page() ) ) ) {
        echo ( $yoast_test_helper_text ) ;
    }
}
add_action( 'wp_footer', 'yoast_test_helper_text_output' );


