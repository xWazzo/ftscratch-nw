<?php
//DOCS: http://code.tutsplus.com/tutorials/guide-to-creating-your-own-wordpress-editor-buttons--wp-30182

add_shortcode( 'css-container', 'css_container_short_code' );


function css_container_short_code( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'attr'          => "",
        'class'         => null,
        'id'            => null,
        'container'     => "div",
        'json'          =>  "",
        'label'         => false
    ), $atts ) );

    $output;

    $attr = $attr ? json_decode($attr, true):"";
    $html_attr = '';

    if(is_array($attr)){
        foreach ($attr as $key => $attr_val) {
            $checked = $key == 'checked' ? 'checked':'';

            $html_attr .= ' '.($checked ? $checked : $key.'="'.$attr_val .'"');
        }
    }

        $output .= '<'.$container.' class="'.$class.'"'.($id ? ' id="'.$id.'"':'').$html_attr.'>';
            $output .= do_shortcode($content);
        $output .= '</'.$container.'>';

    if ($attr['id'] && $json)
        $output .= '<script>var '.$attr['id'].' = '.$json.';</script>' ;
    return $output;
}

add_shortcode('css-container-inside','css_container_short_code_inside');

function css_container_short_code_inside( $atts, $content = null ) {
      return do_shortcode(css_container_short_code($atts, $content));
}

add_action( 'init', 'css_container_buttons' );

function css_container_buttons() {
    add_filter( "mce_external_plugins", "css_container_add_buttons" );
    add_filter( 'mce_buttons', 'css_container_register_buttons' );
}

function css_container_add_buttons( $plugin_array ) {
    $plugin_array['css_container'] = get_template_directory_uri() . '/lib/ftscratch-support/nw-shortcodes/css-container-editor-buttons/css-container-plugin.js';
    return $plugin_array;
}

function css_container_register_buttons( $buttons ) {
    array_push( $buttons, 'css_container', 'css_container_inside' ); // dropcap, css_container
    return $buttons;
}



?>