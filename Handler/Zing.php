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


class Zing extends Base{
	public function __construct(){
		parent::__construct('#https?://(www\.)?mp3.zing.vn/(bai-hat|video-clip|album|playlist)/([a-zA-Z,\-]+)/([a-zA-Z,\d]*).html#i');
	}
	public function generateEmbedCode($matches, $attr, $url, $rawattr){
		$embed = $url;
		$pattern = '';
		switch ($matches[2]) {
			case 'bai-hat':
				$pattern = '<iframe class="zingmp3embed song-embed" width="410" height="100" src="http://mp3.zing.vn/embed/song/%1$s?autostart=false" frameborder="0" allowfullscreen="true"></iframe>';
				break;
			case 'video-clip':
				$pattern = '<iframe class="zingmp3embed video-embed" width="450" height="291" src="http://mp3.zing.vn/embed/video/%1$s?autostart=false" frameborder="0" allowfullscreen="true"></iframe>';
				break;
			case 'album':
			case 'playlist':
				$pattern = '<iframe class="zingmp3embed album_playlist-embed" width="410" height="300" src="http://mp3.zing.vn/embed/album/%1$s?autostart=false" frameborder="0" allowfullscreen="true"></iframe>';
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