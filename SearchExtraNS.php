<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is a MediaWiki extension, it is not a valid entry point' );
}

$wgExtensionCredits['parserhook'][] = array(
	'name' => 'SearchExtraNS',
	'url' => '',
	'author' => array( 'Roland Unger', 'Hans Musil' ),
);

$wgSearchExtraNamespaces = false;

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

$wgHooks['SearchEngineAfterNoDirectMatch'][] = 'SearchExtraNS::NearMatch';
