<?php

/* @package fstheme
 *
 * ====================
 * Default Walker Class
 * ====================
 *
 */

class Walker_Nav_Primary_Mobile extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ){ //ul

        $indent = str_repeat("\t",$depth);

        /*
        if($depth > 0) {
            $output .= "\n$indent<ul style=\"height: 0px;\" class=\"mdc-list\" aria-hidden=\"true\" role=\"menu\" data-depth=\"$depth\">\n";
        } else {
            $output .= "\n$indent<ul class=\"mdc-list\" aria-hidden=\"true\" role=\"menu\" data-depth=\"$depth\">\n";
        }
        */

        $output .= "\n$indent<ul style=\"max-height: 0; transition: max-height 0.15s ease-out; overflow: hidden; padding:unset; align-self: left; width: 100%;\" class=\"mdc-list\" aria-hidden=\"true\" role=\"menu\" data-depth=\"$depth\">\n";


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
            $icon .= '<i class="material-icons mdc-list-item__graphic md-18">'.$icon_name.'</i>  ';
        }

        // $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'mdc-list-item';
        $classes[] = ($depth > 0) ? 'mdc-list-item' : '';

        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li '  . $value . $class_names . $li_attributes . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

        $attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="submenu-mobile"' : '';

        $caret = ($args->walker->has_children) ? '  <span class="caret">&#9660;</span>' : '';

        $item_output = $args->before;
        $item_output .= '<a'.$attributes.'>'.$icon.'<span>';
        $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$caret.$args->link_after;
        //$item_output .= '</a>';
        $item_output .= '</span>';
        $item_output .= ($depth == 0 && $args->walker->has_children) ? ' <b></b></a>' : '</a>';
        $item_output .= $args->after;

        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }


}