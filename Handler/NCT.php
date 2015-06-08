<?php
/**
 * Summary
 *
 * Description.
 *
 * @since 0.9.0
 *
 * @package
 * @subpackage 
 *
 * @author nguyenvanduocit
 */

namespace VN_OEmbed\Handler;


class NCT extends Base{
	public function __construct(){
		parent::__construct('#https?://(www\.)?nhaccuatui\.com/(bai-hat|video|playlist)/([a-zA-Z,\-,\d]+)\.(.*)\.html#i');
	}
	public function generateEmbedCode($matches, $attr, $url, $rawattr){
		$embed = $url;
		$pattern = '';
		switch ($matches[2]) {
			case 'bai-hat':
				$pattern = '<object class="nctembed song-embed" width="300" height="286">  <param name="movie" value="http://www.nhaccuatui.com/m/%1$s" />  <param name="quality" value="high" />  <param name="wmode" value="transparent" />  <param name="allowscriptaccess" value="always" /> <param name="allowfullscreen" value="true"/> <param name="flashvars" value="autostart=false" />  <embed src="http://www.nhaccuatui.com/m/%1$s" flashvars="target=blank&autostart=false" allowscriptaccess="always" allowfullscreen="true" quality="high" wmode="transparent" type="application/x-shockwave-flash" width="300" height="286"></embed></object>';
				break;
			case 'video':
				$pattern = '<object width="100%" height="386">  <param name="movie" value="http://www.nhaccuatui.com/video/xem-clip/%1$s" />  <param name="quality" value="high" />  <param name="wmode" value="transparent" />  <param name="allowscriptaccess" value="always" /> <param name="allowfullscreen" value="true"/> <param name="flashvars" value="autostart=false" />  <embed src="http://www.nhaccuatui.com/video/xem-clip/%1$s" flashvars="target=blank&autostart=false" allowscriptaccess="always" allowfullscreen="true" quality="high" wmode="transparent" type="application/x-shockwave-flash" width="620" height="386"></embed></object>';
				break;
			case 'playlist':
				$pattern = '<object class="nctembed album_playlist-embed" width="300" height="428">  <param name="movie" value="http://www.nhaccuatui.com/l/%1$s" />  <param name="quality" value="high" />  <param name="wmode" value="transparent" />  <param name="allowscriptaccess" value="always" /> <param name="allowfullscreen" value="true"/> <param name="flashvars" value="autostart=false" />  <embed src="http://www.nhaccuatui.com/l/%1$s" flashvars="target=blank&autostart=false" allowscriptaccess="always" allowfullscreen="true" quality="high" wmode="transparent" type="application/x-shockwave-flash" width="300" height="428"></embed></object>';
				break;
		}
		if ($pattern) {
			$embed = sprintf(
				$pattern,
				esc_attr($matches[4])
			);
		}
		return $embed;
	}
}