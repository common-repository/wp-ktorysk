<?php
/*
Plugin Name: WP ktory.sk
Version: 0.1
Description: Format magic string to ktory.sk question for sharing.
Author: Jozef Rusnak
Author URI: http://www.graphystudio.sk/
Plugin URI: http://www.ktory.sk/wp-plugin/
License: A "Slug" license name e.g. GPL2
wp-ktorysk
*/

global $wp_version;
$exit_msg='WP ktory.sk requires WordPress 2.5 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
if (version_compare($wp_version,"2.5","<"))
{
exit ($exit_msg);
}
//converting question URL [http://ktory.sk/?id=1] into share script or [http://ktory.sk/?id=1&width=500] or [http://ktory.sk/?id=5&amp;height=600] or [http://ktory.sk/?id=5&amp;width=600&amp;height=600]

function WP_ktory_sk_question_convert($str){
 $replace = "<script type=\"text/javascript\">document.write('<div style=\"width: \$3px; border: solid silver 1px; overflow-x: hidden;\"><iframe src=\"http://ktory.sk/share.php?id=\$1&amp;width=\$3&amp;height=\$300\" width=\"\$3\" height=\"\$5\" frameborder=\"0\" style=\"overflow-x: hidden;\"></iframe><br /><a href=\"http://ktory.sk/?id=\$1\" style=\"text-decoration: underline; color: #fff; font-family: arial; font-size: 10px; display: block; text-align: right; padding: 0 5px 0 0; margin: 0; background: #cc0000\" target=\"_blank\" title=\"Prejsť na diskusné fórum ktory.sk prepojené na Facebook\">ktory.sk</a></div>');</script>";
 $str = preg_replace("`\[http://ktory.sk/\?id=(\d+)\]`i","[http://ktory.sk/?id=\$1&amp;width=300&amp;height=300]",$str);
 $str = preg_replace("`\[http://ktory.sk/\?id=(\d+)(&amp;|&|&#038;)width=(\d+)\]`i","[http://ktory.sk/?id=\$1&amp;width=\$3&amp;height=300]",$str);
 $str = preg_replace("`\[http://ktory.sk/\?id=(\d+)(&amp;|&|&#038;)height=(\d+)\]`i","[http://ktory.sk/?id=\$1&amp;width=300&amp;height=\$3]",$str);
 $str = preg_replace("`\[http://ktory.sk/\?id=(\d+)(&amp;|&|&#038;)height=(\d+)(&amp;|&|&#038;)width=(\d+)\]`i","[http://ktory.sk/?id=\$1&amp;width=\$5&amp;height=\$3]",$str);
 $ret = preg_replace("`\[http://ktory.sk/\?id=(\d+)(&amp;|&|&#038;)width=(\d+)(&amp;|&|&#038;)height=(\d+)\]`i",$replace,$str);
 return $ret;
}

add_filter('the_content', 'WP_ktory_sk_question_convert');
?>