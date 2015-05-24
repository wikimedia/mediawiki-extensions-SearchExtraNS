<?php

class SearchExtraNS {

	/**
	* @param $term string
	* @param $title Title
	* @return bool
	*/
	public static function NearMatch( $term, &$title ) {
		global $wgSearchExtraNamespaces;

		if( !is_array( $wgSearchExtraNamespaces ) ){
			return true;
		}

		foreach( $wgSearchExtraNamespaces as $ens ) {
			$title = Title::newFromText( $term, $ens );
			if ( $title && $title->exists() ) {
				return false;
			}
		}

		return true;
	}
}
