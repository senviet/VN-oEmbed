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


class NhacSo extends Base{
	public function __construct(){
		parent::__construct('#https?://(www\.)?nhacso.net/(nghe-nhac|xem-video)/([a-zA-Z,\-,\d]+).([a-zA-Z,\d,=?]*).html#i');
	}
	public function generateEmbedCode($matches, $attr, $url, $rawattr){
		$embed = $url;
		$pattern = '';
		switch ($matches[2]) {
			case 'nghe-nhac':
				$pattern = '<object width="500" height="56" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0">
                                 <param name="movie" value="http://st.nhacso.net/f/v3/Playlistjs.swf">
                                 <param name="allowScriptAccess" value="always">
                                 <param name="quality" value="high">
                                 <param name="wmode" value="transparent">
                                 <param name="flashvars" value="xmlPath=http://nhacso.net/flash/song/xnl/1/id/%1$s&amp;colorAux=0x017CA6&amp;colorMain=0xafafaf&amp;colorBorder=0x333333&amp;typePlayer=single&amp;mAuto=false">
                                 <param name="allowfullscreen" value="true">
                                 <embed width="500" height="56" id="Playlistjs" name="Playlistjs" flashvars="xmlPath=http://nhacso.net/flash/song/xnl/1/id/%1$s&amp;colorAux=0x017CA6&amp;colorMain=0xafafaf&amp;colorBorder=0x333333&amp;typePlayer=single&amp;mAuto=false" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" src="http://st.nhacso.net/f/v3/Playlistjs.swf">
                                 </object>';
				break;
			case 'xem-video':
				$pattern = '<object id="videoplayer" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="630" height="387">
                             <param name="movie" value="http://st.nhacso.net/f/v3/nsplayer.swf">
                             <param name="allowScriptAccess" value="always">
                             <param name="quality" value="high">
                             <param name="wmode" value="transparent">
                             <param name="flashvars" value="xmlPath=http://nhacso.net/flash/video2/xnl/1/id/%1$s=&amp;colorAux=0x0099ff&amp;colorMain=0x000000&amp;colorBorder=0xcccccc&amp;mAuto=false&amp;typePlayer=single">
                             <param name="allowfullscreen" value="true">
                             <embed id="videoplayer" name="videoplayer" flashvars="xmlPath=http://nhacso.net/flash/video2/xnl/1/id/%1$s=&amp;colorAux=0x0099ff&amp;colorMain=0x000000&amp;colorBorder=0xcccccc&amp;mAuto=false&amp;typePlayer=single" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" src="http://st.nhacso.net/f/v3/nsplayer.swf" width="630" height="387">
                             </object>';
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