<?php

if ( !defined( 'MEDIAWIKI' ) ) {
        die( 'This file is a MediaWiki extension, it is not a valid entry point' );
}


$wgExtensionFunctions[] = 'wfSetupSearchExtraNS';
$wgExtensionCredits['parserhook'][] = array( 'name' => 'SearchExtraNS', 'url' => 
'http://wikivoyage.org/tech/SearchExtraNS-Extension', 'author' => 'Roland Unger / Hans Musil' );



class SearchExtraNS
{
  public static function NearMatch( $term, &$title)
  {
		global $wgSearchExtraNamespaces;

		if( !is_array( $wgSearchExtraNamespaces )){ return true;};

		foreach( $wgSearchExtraNamespaces as $ens)
		{
			$title = Title::newFromText( $term, $ens );
			if ( $title && $title->exists() ) {
				return false;
			}
		};

		return true;
	}
}



function wfSetupSearchExtraNS()
{
	global $wgHooks;

	$wgHooks['SearchEngineAfterNoDirectMatch'][] = 'SearchExtraNS::NearMatch';
}


?>
