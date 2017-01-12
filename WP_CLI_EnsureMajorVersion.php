<?php

if(defined('WP_CLI') && WP_CLI){
  /**
   * Extends core with ensure command to force highest minor version within major
   */
  class EnsureMajorVersion extends \Core_Command {

    /**
  	 * Update WordPress to the latest minor release in a given major version.
  	 *
  	 * <version>
  	 * : Major version (4.7)
  	 *
  	 * ## EXAMPLES
  	 *
  	 *     # Update WordPress to the current latest minor.
  	 *     # At time of writing this would force update WordPress 4.7.1
  	 *     $ wp core ensure_major_version ensure 4.7
  	 *
  	 */
    function ensure( $_, $assoc_args ){
      include( ABSPATH . WPINC . '/version.php' );
      global $wp_version;
      WP_CLI::line( "Current version is {$wp_version}" );
      $satisfied = \Composer\Semver\Semver::satisfies($wp_version, $_[0].'.*');
      if($satisfied){
        WP_CLI::line( "Current major version seems to be correct, only doing minor update" );
        $this->update(null, array(
          'minor'=>true
        ));
      }else{
        WP_CLI::line( "Current major version is not what we expected {$satisfied}" );
        $this->update(null, array(
          'force'=>true,
          'version'=>$_[0],
        ));
        $this->update(null, array(
          'minor'=>true
        ));
      }
    }
  }
  WP_CLI::add_command('ensure-major-version', "\EnsureMajorVersion");
}
