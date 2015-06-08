<?php
/**
 * This class is the base for all rulers
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


class Base {
	protected $regex;
	protected $id;
	public function __construct($regex = ''){
		$this->id = get_class($this);
		$this->regex = apply_filters('vno_regex_'.$this->id, $regex);
	}
	public function callback($matches, $attr, $url, $rawattr){
		$embedCode = $this->generateEmbedCode($matches, $attr, $url, $rawattr);
		$embedCode = apply_filters('vno_embedcode_'.$this->id, $embedCode);
		return $embedCode;
	}
	public function getRegex(){
		return $this->regex;
	}
	public function generateEmbedCode($matches, $attr, $url, $rawattr){
		return '';
	}
}