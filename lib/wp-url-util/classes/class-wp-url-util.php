<?php
/**
 * @package WP_Url_Util
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Url_Util {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Url_Util
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Url_Util Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Converts a path to a file into a url to the file.
     *
     * Note that the file must be in the WordPress content directory. File can be in a subdirectory.
     *
     * @param string $file_path Path to file.
     * @return string Url to file.
     */
    function convert_path_to_url( $file_path ) {

        // Remove WordPress content path from file path.
        $file_base = str_replace( WP_CONTENT_DIR, '', $file_path );

        // Add WordPress content url to file base.
        $file_url = content_url() . $file_base;

        return $file_url;

    }

    /**
     * Converts a url to a file into a path to the file.
     *
     * Note that the file must be in the WordPress content directory. File can be in a subdirectory.
     *
     * @param string $file_url Path to file.
     * @return string Url to file.
     */
    function convert_url_to_path( $file_url ) {

        // Remove WordPress content url from file url.
        $file_base = str_replace( content_url(), '', $file_url );

        // Add WordPress content path to file base.
        $file_path = WP_CONTENT_DIR . $file_base;

        return $file_path;

    }

    /**
     * Determines if a file is externally hosted based on url.
     *
     * @param string $file_url File url.
     * @return boolean Whether a file is externally hosted or not.
     */
    public function is_external_file( $file_url ) {

        // Set default return value.
        $is_external_file = false;

        // Parse url.
        $parsed_file_url = parse_url( $file_url );

        // Parse site url.
        $parsed_site_url = parse_url( site_url() );

        // Check if hosts don't match.
        if ( $parsed_file_url[ 'host' ] !== $parsed_site_url[ 'host' ] ) {

            // We now know the file is externally hosted.
            $is_external_file = true;

        }

        return $is_external_file;

    }

    /**
     * Determines if a file is a file that was uploaded to WordPress.
     *
     * @param string $file_url File url.
     * @return string Image path.
     */
    public function is_uploaded_file( $file_url ) {

        // Set default return value.
        $is_uploaded_file = false;

        // Get WordPress upload directory information.
        $wp_upload_directory = wp_upload_dir();

        // Check if the WordPress upload directory url matches the file url.
        if ( false !== strpos( $file_url, $wp_upload_directory[ 'baseurl' ] ) ) {

            // We now know the file is one that was uploaded to WordPress.
            $is_uploaded_file = true;

        }

        return $is_uploaded_file;

    }

    /**
     * Removes the query string from a url.
     *
     * @param string $url A url.
     * @return string Supplied url with the query string removed.
     */
    public function remove_query_string( $url ) {

        // Remove everything after the ? in a url.
        return strtok( $url, '?' );

    }

}
