<?php
/**
 * Exporter for: Facebook
 * @author Hannes Christiansen <mail@laufhannes.de>
 */
class ExporterFacebook extends ExporterSocialShare {
	/**
	 * Is this exporter without a file?
	 * @return boolean 
	 */
	public static function isWithoutFile() {
		return true;
	}

	/**
	 * Set file content
	 */
	protected function setFileContent() {
		$Linklist = new BlocklinkList();
		$Linklist->addCompleteLink( $this->getLink() );
		$Linklist->display();

		echo HTML::info('
			<small>
				Du wirst zur Seite von Facebook weitergeleitet.<br />
				Dort kannst du selbst bestimmen, welcher Text angezeigt wird.
			</small>');
	}

	/**
	 * Get link
	 * @return string 
	 */
	protected function getLink() {
		$URL = 'https://facebook.com/sharer.php?u='.urlencode($this->getUrl()).'&t='.urlencode($this->getText());

		return '<a href="'.$URL.'" style="background-image:url(inc/export/icons/facebook.png);"><strong>Teilen!</strong></a>';
	}
}