<?php

//禁止WordPress自动生成缩略图
function hui_remove_image_size($sizes) {
//unset( $sizes['thumbnail'] );     			//禁止生成特色图像作用 150x150
//unset( $sizes['medium'] );        			//禁止生成媒体库缩略图 300x300
//unset( $sizes['medium_large'] );    	//禁止生成768x0 禁用
unset( $sizes['large'] );           					//禁止生成large 0x0
unset( $sizes['1536x1536'] );       			//禁止生成1536x1536
unset( $sizes['2048x2048'] );       			//禁止生成2048x2048
return $sizes;
}
add_filter('image_size_names_choose', 'hui_remove_image_size');

// 添加自定义图片尺寸
add_action( 'after_setup_theme', function() {
    add_image_size( 'medium_large_700', 700, 325,true);
    add_image_size( 'medium_large_900', 900, 325,true);
    add_image_size( 'medium_large_1200', 1200, 325,true);
} ); 

//当图像超大生成  -scaled 缩略图(禁用scaled功能)
add_filter('big_image_size_threshold', '__return_false');


//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');


//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


//WordPress文章插入图片显示方式(尺寸/对齐方式/链接到)
add_action( 'after_setup_theme', 'default_attachment_display_settings' );
function default_attachment_display_settings() {
    update_option( 'image_default_align', 'center' ); //居中显示
    update_option( 'image_default_link_type', ' file ' ); //连接到媒体文件本身
    update_option( 'image_default_size', 'full' ); //完整尺寸
}


//为发图便利做改善 - 文章内图片支持fancy
/** 图片灯箱自动为图片添加链接 **/ 
add_filter('the_content', 'fancybox'); 
function fancybox($content){ 
 $pattern = array( "/<img(.*?)src=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf|webp)('|\")(.*?)>/i", "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf|webp)('|\")(.*?)>(.*?)<\/a>/i" );
 $replacement = array( '<a$1href=$2$3.$4$5 data-fancybox="gallery"><img$1src=$2$3.$4$5$6></a>', '<a$1href=$2$3.$4$5 data-fancybox="gallery"$6>$7</a>' ); 
 $content = preg_replace($pattern, $replacement, $content); 
 return $content; 
 }



//禁止响应式图片
function disable_srcset( $sources ) {
return false;
}
add_filter( 'wp_calculate_image_srcset', 'disable_srcset' );


//自动添加特色图像
function huitheme_auto_set_featured_image() {
   global $post;
   $featured_image_exists = has_post_thumbnail($post->ID);
      if (!$featured_image_exists)  {
         $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
         if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {set_post_thumbnail($post->ID, $attachment_id);}
         }
      }
}

$author_url = 'https://www.aiyunbox.com';
add_action('the_post', 'huitheme_auto_set_featured_image');
 