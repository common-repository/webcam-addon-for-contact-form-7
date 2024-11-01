<?php
/**
* Plugin Name: Webcam Addon For Contact Form 7
* Plugin URI: www.linkedin.com/in/idrish-makda-2290751b9
* Description: This plugin use for capture picture and send in mail with help of Contact form 7.
* Version: 1.0
* WC tested up to: 5.8.2
* Author: Murtuza Makda(idrish)
* Author URI: https://www.upwork.com/freelancers/~018f06972fe4607ad0
* License: GPL v3
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
**/

defined('ABSPATH') or die('Keep Silent');


$wcacf_active = false;


function wcacf_plugins_loaded_callback() {
    $active_plugins = get_option( 'active_plugins' );
    $is_wc_active   = in_array( 'contact-form-7/wp-contact-form-7.php', $active_plugins, true );

    if ( current_user_can( 'activate_plugins' ) && false === $is_wc_active ) {
        $wcacf_active = false;
        add_action( 'admin_notices', 'wcacf_admin_notices_callback' );
    } else {
        wcacf_load_complete();
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wcacf_plugin_actions_callback' );
    }
}


function wcacf_admin_notices_callback() {
    $this_plugin_data = get_plugin_data( __FILE__ );
    $this_plugin      = $this_plugin_data['Name'];
    $wc_plugin        = 'Contact Form 7';
    ?>
    <div class="error">
        <p>
            <?php
            /* translators: 1: %s: strong tag open, 2: %s: strong tag close, 3: %s: this plugin, 4: %s: Advanced Custom Fields plugin, 5: anchor tag for Advanced Custom Fields plugin, 6: anchor tag close */
            echo wp_kses_post( sprintf( __( '%1$s%3$s%2$s is ineffective as it requires %1$s%4$s%2$s to be installed and active. Click %5$shere%6$s to install or activate it.', 'easy-reservations' ), '<strong>', '</strong>', esc_html( $this_plugin ), esc_html( $wc_plugin ), '<a target="_blank" href="' . admin_url( 'plugin-install.php?s=contact%20form%207&tab=search&type=term' ) . '">', '</a>' ) );
            ?>
        </p>
    </div>
    <?php
}


function wcacf_load_complete(){

  add_action( 'wpcf7_init', 'wcacf_add_form_tag_clock' );

}


add_action( 'plugins_loaded', 'wcacf_plugins_loaded_callback' );



add_action('wp_enqueue_scripts','wcacf_frontend_script');

function wcacf_frontend_script() {

wp_register_script( 'webcame', plugins_url('assets/js/webcam.min.js', __FILE__), array('jquery'), true );
wp_enqueue_script('webcame');

wp_register_script( 'custom-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), true );
wp_enqueue_script('custom-script');

}

 
function wcacf_add_form_tag_clock() {
  wpcf7_add_form_tag( 'camera', 'wcacf_camera_form_tag_handler' );
}
 
function wcacf_camera_form_tag_handler( $tag ) {
  return "<div class='web-cam-row'>
    <div class='web-cam-column-first'>
        <div id='my_camera' class='my_camera'></div>
        <br/>
        <input type=button value='Take Snapshot' class='takeimage' id='takeimage'>
        <input type='hidden' name='web-cam-image' class='image-tag'>
    </div>
    <div class='web-cam-column-second'>
        <div id='results'>Your captured image will appear here...</div>
    </div>
</div>";
}



function wcacf_plugin_actions_callback( $links ) {
    $this_plugin_links = array(
        '<a title="' . __( 'Docs', 'acf' ) . '" class="thickbox" href="#TB_inline?&width=600&height=550&inlineId=option-page-addon-for-acf-docs-popup">' . __( 'Docs', 'acf' ) . '</a>',
        '<a title="' . __( 'Support', 'acf' ) . '" href="' . esc_url('https://www.upwork.com/freelancers/~018f06972fe4607ad0') . '">' . __( 'Support', 'acf' ) . '</a>',
    );

    add_thickbox();
    ?>
    <style>
        .content {
            padding-left: 20px;
        }
        #TB_ajaxContent{
          width: auto !important;
          height: 90% !important;
        }
        .web-cam-admin-row{
          display: flex;
          margin-top: 30px;
        }
    </style>
    <div id="option-page-addon-for-acf-docs-popup" style="display:none;">
        <div class="content">
            <h2>How to Capture Image and recive in mail with form submission</h2>
            How to Camera module to contact form 7.<br>
            ------------------------------------------------<br>
            Just place this shortcode into your contact from and now you can see camera module open in front-end side.
            <code>
              [camera]
            </code>
            How to attach captured image in to mail.<br>
            ------------------------------------------------<br>
            1)Just go to Mail tab<br>
            2)Put belowe code in to your message body section
            <code>
              <pre>
                &lt;img src="[web-cam-image]" width="" height="" /&gt;
              </pre>
            </code>
            Note: Please check "Use HTML content type" check box, otherwise you will not get image in your mail.
            hurry!! now you can get captured image in your mail.
        </div>
        <div class="web-cam-admin-row">
          <div class="web-cam-admin-column">
            <img src="<?php echo plugins_url('assets/images/web-cam.svg', __FILE__) ?>" style="width:100px;height: 100px;">
            <h3><b>web-cam</b></h3>
            <h3>This is the only plugin which can access user's camera</h3>
            <h3>use case of this plugin</h3>
            <ul>
                <li>Authentication</li>
                <li>Verification</li>
                <li>Image capture</li>
                <li>Feedback Form</li>
                <li>Client Review Image</li>
                <li>Product Image</li>
            </ul>
            <br>
            <a href="https://wordpress.org/plugins/web-cam/" style="padding:10px 15px; color: white;background-color: #0073aa;">Download</a>
          </div>
          <div class="web-cam-admin-column">
            <img src="<?php echo plugins_url('assets/images/option-page-addon-for-acf.svg', __FILE__) ?>" style="width:100px;height: 100px;">
            <h3><b>Option Page addon for ACF</b></h3>
            <h3>using this plugin you can create option pages with acf free version</h3>
            <h3>use case of this plugin</h3>
            <ul>
                <li>theme custimization</li>
                <li>theme creation</li>
                <li>plugins options</li>
                <li>custom post type options</li>
            </ul>
            <br>
            <a href="https://wordpress.org/plugins/option-page-addon-for-acf/" style="padding:10px 15px; color: white;background-color: #0073aa;">Download</a>
          </div>
        </div>
    </div>
    <?php
    return array_merge( $this_plugin_links, $links );
}