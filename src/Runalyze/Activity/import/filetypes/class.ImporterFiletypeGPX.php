<?php
/**
 * This file contains class::ImporterFiletypeGPX
 * @package Runalyze\Import\Filetype
 */
/**
 * Importer: *.gpx
 *
 * @author Hannes Christiansen
 * @package Runalyze\Import\Filetype
 */
class ImporterFiletypeGPX extends ImporterFiletypeAbstract {
	/**
	 * Set parser
	 * @param string $String string to parse
	 */
	protected function setParserFor($String) {
            if($this->isFromRuntastic($String))
		$this->Parser = new ParserGPXRuntasticMultiple($String);
            else 
                $this->Parser = new ParserGPXMultiple($String);
             
                
	}
        
	/**
	 * Is this string from Sigma DataCenter => V4?
	 * @param string $String
	 * @return bool
	 */
	private function isFromRuntastic(&$String) {
		return strpos($String, 'runtastic') !== false;
	} 
}