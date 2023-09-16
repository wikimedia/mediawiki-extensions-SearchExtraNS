<?php

namespace MediaWiki\Extension\SearchExtraNS;

use MediaWiki\Search\Hook\SearchAfterNoDirectMatchHook;
use MediaWiki\Title\Title;

class Hooks implements SearchAfterNoDirectMatchHook {

	/**
	 * @param string $term
	 * @param Title &$title
	 * @return bool
	 */
	public function onSearchAfterNoDirectMatch( $term, &$title ) {
		global $wgSearchExtraNamespaces;

		if ( !is_array( $wgSearchExtraNamespaces ) ) {
			return true;
		}

		foreach ( $wgSearchExtraNamespaces as $ens ) {
			$title = Title::newFromText( $term, $ens );
			if ( $title && $title->exists() ) {
				return false;
			}
		}

		return true;
	}
}
