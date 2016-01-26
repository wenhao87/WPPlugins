<?php
/* ====================================================================================================
 *	Plugin Name: Hierarchical HTML Sitemap
 *	Description: This plugin is generate Hierarchical HTML Sitemap for your WordPress blog. It displays posts in categories which sorted hierarchically. Easy and fast. By using a shortcode <code>[htmlmap]</code> you can display sitemap on page or anywhere. Only PHP code, without additional CSS or JS files.
 *	Plugin URI: http://avovkdesign.com/plugin-hierarchical-html-sitemap.html
 *	Donate link: http://avovkdesign.com/bymecoffee
 *	Author: Alexandra Vovk
 *	Version: 1.1
 *	Author URI: http://avovkdesign.com/
 * ==================================================================================================== */



// HIERARHICAL BLOG MAP shortcode
function hierarchicalsitemap_shortcode_htmlmap( $atts , $content = null ) {

	$hidecloud = ( ''!=$atts && in_array('hidecloud', $atts) ) ? 1 : 0 ;
	$showpages = ( ''!=$atts && in_array('showpages', $atts) ) ? 1 : 0 ;
	
	/* new params - showdescription, hidedate
	 * @since v.1.1
	 */
	$showdescription = ( ''!=$atts && in_array('showdescription', $atts) ) ? 1 : 0 ;
	$hidedate = ( ''!=$atts && in_array('hidedate', $atts) ) ? 1 : 0 ;
	
	extract( shortcode_atts( array( 'exclude' => '', 'exclude_cat' => '' ), $atts ) );
	$exclude = ($exclude) ? '&exclude='.$exclude : '';
	$exclude_cat = ($exclude_cat) ? '&exclude='.$exclude_cat : '';
	
	//$html = hierarchicalsitemap_hierarchical_category_tree( 0, $exclude, $exclude_cat, $hidecloud );
	$html = hierarchicalsitemap_hierarchical_category_tree( 
		0, 
		$exclude, 
		$exclude_cat, 
		array( 
			'hidecloud' => $hidecloud, 
			'showdescription' => $showdescription, 
			'hidedate' => $hidedate, 
		) 
	);
	$out = ( $hidecloud ) ? "" : "<p id=\"htmlmap_cats\">". substr($html['cloud'], 2 ) ."</p>";
	$out .= "<div id=\"htmlmap_posts\">". $html['posts'] ."</div>";
	$out .= ( $showpages ) ? hierarchicalsitemap_get_pages_list( $exclude ) : "";
	
	return $out;
}
add_shortcode( 'htmlmap', 'hierarchicalsitemap_shortcode_htmlmap' );



/* RECURSIVE get html blog map 
 *
 * @param  (string)  $cid		category ID
 * @param  (string)  $ex		list posts IDs to exclude from HTML Map
 * @param  (string)  $ex_cat  	list categories IDs to exclude from HTML Map
 * @param  (array)   $arg		array with display options:
 *									hidecloud=1 - hide categories cloud
 *									showdescription=0 - show category description
 *									hidedate=0 - hide post date
 *
 * @return (string)  HTML code with sitemap
 */
//function hierarchicalsitemap_hierarchical_category_tree( $cid, $ex, $ex_cat, $hidecloud, $out = array( 'cloud' => '', 'posts' => '' ) ) {
function hierarchicalsitemap_hierarchical_category_tree( 
	$cid,	 
	$ex, 
	$ex_cat, 
	$arg = array( 
		'hidecloud' => 1,
		'showdescription' => 0,
		'hidedate' => 0,
	), 
	$out = array( 'cloud' => '', 'posts' => '' ) 
) {
	
	$categories = get_categories('hide_empty=false&orderby=name&order=ASC&parent=' . $cid . $ex_cat );

	if( $categories ) :    
		foreach( $categories as $cat ) :
			$out['cloud'] .= ", <span class=\"cat\"><a href=\"#cat_$cat->term_id\">$cat->name</a> <small>[$cat->count]</small></span>";
			$tocloudlink = ( $arg['hidecloud'] ) ? "" : " <a href='#htmlmap_cats'>&uarr;</a>";
	
			$tag = ( 0 == $cid ) ? "h2" : "h3";
			$out['posts'] .= "\n<$tag id='cat_$cat->term_id'>". $cat->name ." <small>[". $cat->count ."]</small>". $tocloudlink ."</$tag>\n";
			$out['posts'] .= ( "" != $cat->category_description && $arg['showdescription'] ) ? "<p><i>". $cat->category_description ."</i></p>\n" : '';
			$out['posts'] .= "<ul>\n";

			$posts = get_posts('posts_per_page=-1&orderby=post_date&order=DESC&category__in='.$cat->term_id . $ex );
	
			if ( count( $posts ) > 0 ) {
				$cnt = 0;
				foreach ( $posts as $post ) {
					$cnt++;
					$date = explode(" ", $post->post_date );
					$out['posts'] .= ( $arg['hidedate'] ) ? "<li>" : "<li><small>$date[0]</small>&nbsp;";
					$out['posts'] .= "<a href=\"".get_permalink( $post->ID )."\">$post->post_title</a>";
					if ( $cnt == count( $posts ) ) {
						$out = hierarchicalsitemap_hierarchical_category_tree( 
							$cat->term_id, 
							$ex, 
							$ex_cat, 
							$arg,
							$out 
						);
					}
					$out['posts'] .= "</li>\n";
				}
			}
			// check empty category for all childrens and show it
			else if ( 0 == count( $posts ) ) {
					$out['posts'] .= '<li class="null" style="list-style:none">';
					$out = hierarchicalsitemap_hierarchical_category_tree( 
						$cat->term_id, 
						$ex, 
						$ex_cat, 
						$arg,
						$out 
					);				
					$out['posts'] .= "</li>";
			}
	
			$out['posts'] .= "</ul>\n";
		endforeach;    
	endif;
	
	$out['posts'] .= "\n";
	return $out;
}



// get html pages list 
function hierarchicalsitemap_get_pages_list( $exclude ) {
	
	$html = "<ul id=\"htmlmap_pages\">";			
	$pages = get_pages( $exclude );
	foreach ( $pages as $page ){
		$id		= $page->ID;
		$title 	= $page->post_title;
		$link 	= apply_filters('the_permalink', get_permalink($id));
		$html  .= "<li><a href=\"$link\" title=\"$title\">$title</a></li>";
	}
	$html .= "</ul>";
	
	return "<h2>". __("All Pages") ."</h2>" . $html;
	
}
?>