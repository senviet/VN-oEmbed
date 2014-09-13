<?php
require_once dirname(__FILE__) . '/EmbedRuler.php';

class Wpos_Code
{
    private $rulers;
    private static $instance;

    function __construct()
    {
        $this->rulers = array(
            'mp3.zing.vn' => new EmbedRuler('#https?://(www\.)?mp3.zing.vn/(bai-hat|video-clip|album|playlist)/([a-zA-Z,\-]+)/([a-zA-Z,\d]*).html#i', 'generateZingEmbedCode'),
            'nhaccuatui.com' => new EmbedRuler('#https?://(www\.)?nhaccuatui.com/(bai-hat|video|playlist)/([a-zA-Z,\-,\d]+).([a-zA-Z,\d]*).html#i', 'generateNhaccuatuiEmbedCode'),
            'nhacso.net' => new EmbedRuler('#https?://(www\.)?nhacso.net/(nghe-nhac|xem-video)/([a-zA-Z,\-,\d]+).([a-zA-Z,\d,=?]*).html#i', 'generateNhacsoEmbedCode')
        );
    }

    public static function instance()
    {
        if (self::$instance) {
            return self::$instance;
        } else {
            self::$instance = new self();
            return self::$instance;
        }
    }

    public function init()
    {
        foreach ($this->rulers as $key => $ruler) {
            wp_embed_register_handler($key, $ruler->getRegex(), array($this, $ruler->getCallback()));
        }
    }

    /*
    2.	[7-18]	`mp3.zing.vn`
    3.	[19-26]	`bai-hat`
    4.	[27-52]	`Lang-Nghe-Tim-Em-Dong-Nhi`
    5.	[53-61]	`ZW6B9ZWZ`
     */
public function generateZingEmbedCode($matches, $attr, $url, $rawattr)
{
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
    return apply_filters('generateZingEmbedCode', $embed, $matches, $attr, $url, $rawattr);
}

    /*
        1.	[7-11]	`www.`
        2.	[11-25]	`nhaccuatui.com`
        3.	[26-33]	`bai-hat`
        4.	[34-49]	`khong-tua-karik`
        5.	[50-62]	`QYHI75yFus3G`
     */
    public function generateNhaccuatuiEmbedCode($matches, $attr, $url, $rawattr)
    {
        $embed = $url;
        $pattern = '';
        switch ($matches[2]) {
            case 'bai-hat':
                $pattern = '<object class="nctembed song-embed" width="300" height="286">  <param name="movie" value="http://www.nhaccuatui.com/m/%1$s" />  <param name="quality" value="high" />  <param name="wmode" value="transparent" />  <param name="allowscriptaccess" value="always" /> <param name="allowfullscreen" value="true"/> <param name="flashvars" value="autostart=false" />  <embed src="http://www.nhaccuatui.com/m/%1$s" flashvars="target=blank&autostart=false" allowscriptaccess="always" allowfullscreen="true" quality="high" wmode="transparent" type="application/x-shockwave-flash" width="300" height="286"></embed></object>';
                break;
            case 'video':
                $pattern = '<object width="620" height="386">  <param name="movie" value="http://www.nhaccuatui.com/video/xem-clip/%1$s" />  <param name="quality" value="high" />  <param name="wmode" value="transparent" />  <param name="allowscriptaccess" value="always" /> <param name="allowfullscreen" value="true"/> <param name="flashvars" value="autostart=false" />  <embed src="http://www.nhaccuatui.com/video/xem-clip/%1$s" flashvars="target=blank&autostart=false" allowscriptaccess="always" allowfullscreen="true" quality="high" wmode="transparent" type="application/x-shockwave-flash" width="620" height="386"></embed></object>';
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
        return apply_filters('generateNhaccuatuiEmbedCode', $embed, $matches, $attr, $url, $rawattr);
    }

    /*
        2.	[7-17]	`nhacso.net`
        3.	[18-28]	`nghe-album`
        4.	[29-41]	`ballad-vol-1`
        5.	[42-50]	`V1BVVEZY`
        6.	[50-52]	`==`
     */
    public function generateNhacsoEmbedCode($matches, $attr, $url, $rawattr)
    {
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
        return apply_filters('generateNhacsoEmbedCode', $embed, $matches, $attr, $url, $rawattr);
    }
}