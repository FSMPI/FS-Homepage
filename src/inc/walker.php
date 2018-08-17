<?php

/* @package fstheme
 *
 * ====================
 * Default Walker Class
 * ====================
 *
 */

class Walker_Nav_Primary extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ){ //ul

        $indent = str_repeat("\t",$depth);


        $submenu = ($depth > 0) ? ' sub-menu' : '';
        //$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";

        if($depth > 0) {
            $output .= "<div style=\"position: relative;\" class=\"mdc-menu\" tabindex=\"-1\" id=\"demo-menu\" data-depth=\"$depth\">\n$indent<ul class=\"mdc-menu__items mdc-list\" aria-hidden=\"true\" role=\"menu\" data-depth=\"$depth\">\n";
            //$output .= "<li style=\"position: relative\" ";
        } else {
            $output .= "<div class=\"mdc-menu\" tabindex=\"-1\" id=\"demo-menu\" data-depth=\"$depth\">\n$indent<ul class=\"mdc-menu__items mdc-list\" aria-hidden=\"true\" role=\"menu\" data-depth=\"$depth\">\n";
        }

    }


    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ //li a span

        $indent = ( $depth ) ? str_repeat("\t",$depth) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $material = explode("\n", file_get_contents("https://raw.githubusercontent.com/google/material-design-icons/master/iconfont/codepoints"));
        $icon_names = array();
        foreach($material as $line) {
            $icon_names[] = explode(" ", $line)[0];
        }
        $icon_names = array_intersect($classes, $icon_names);
        $icon = '';

        foreach($icon_names as $icon_name) {
            $icon .= '<i class="material-icons mdc-button__icon md-18">'.$icon_name.'</i>  ';
        }

        //echo "<script>console.log( 'Debug Objects: " . var_export($classes, true) . "' );</script>";

        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;

        /*
        if( $depth && $args->walker->has_children ){
            $classes[] = 'dropdown-submenu';
        }
        */

        $classes[] = ($depth > 0) ? 'mdc-list-item' : '';

        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : ' id=menu-item-'.$item->ID;

        $role = ($depth > 0) ? ' role="menuItem"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $role . $li_attributes . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

        $attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="submenu"' : '';

        $caret = ($args->walker->has_children) ? '  <span class="caret">&#9660;</span>' : '';


        //echo '<script type="text/javascript">console.log(" '.$material_split[0].' ");</script>';

        $item_output = $args->before;
        $item_output .= '<a'.$attributes.'>';
        $item_output .= '<button class="menu_element mdc-button menu-button">'.$icon.'<span>';
        $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$caret.$args->link_after;
        $item_output .= '</span></button>';
        //$item_output .= '</a>';
        $item_output .= ($depth == 0 && $args->walker->has_children) ? ' <b></b></a>' : '</a>';
        $item_output .= $args->after;


        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );


    }


}