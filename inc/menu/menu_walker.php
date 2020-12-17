<?php

class NAU_Walker_Main_Nav_Menu extends Walker_Nav_Menu {      
    function start_lvl( &$output, $depth = 0, $args = array() ) {            
        $classes = array(
            'sub-nav',            
            'menu-depth-' . $depth
        );
        $class_names = implode( ' ', $classes );
 
        // Build HTML for output.
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }
};


class NAU_Walker_Access_Menu extends Walker_Nav_Menu {      

    var $cnt = 0;

    function start_lvl( &$output, $depth = 0, $args = array() ) {            
        $classes = array(
            'sub-nav',
            'access-menu',
            'menu-depth-' . $depth
        );
        $class_names = implode( ' ', $classes );
 
        // Build HTML for output.
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }


    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= '<li' . $id . $value . $class_names .">\n";

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        
        if($this->cnt < 1) {
          $atts['id']     = 'register';
        } else {
          $atts['id']     = 'login_image';
        }
        $this->cnt++;

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after . "\n";

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    
}

?>