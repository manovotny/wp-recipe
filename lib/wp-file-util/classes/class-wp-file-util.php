<?php
/**
 * @package WP_File_Util
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_File_Util {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_File_Util
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_File_Util Instance of the class.
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
     * Gets an absolute path to a file based on a relative path.
     *
     * @param string $directory_path The directory you want to start from, typically __DIR__.
     * @param string $relative_path The relative path you want to navigate to.
     * @return string The absolutely path to file.
     */
    public function get_absolute_path( $directory_path, $relative_path ) {

        // Create absolute path based on relative path.
        return realpath( trailingslashit( $directory_path ) . $relative_path );

    }

    /**
     * Extracts file extension from a file, path, or url.
     *
     * @param string $file A file name, path, or url.
     * @return string The file extension.
     */
    public function get_file_extension( $file )  {

        return pathinfo( $file, PATHINFO_EXTENSION );

    }

    /**
     * Extracts file name from a file, path, or url.
     *
     * @param  string $file A file, path, or url.
     * @return string The file name.
     */
    public function get_file_name( $file ) {

        return pathinfo( $file, PATHINFO_FILENAME );

    }

    /**
     * Extracts file name and extension from a file, path, or url.
     *
     * @param string $file A file, path, or url.
     * @return string The file name and extension.
     */
    public function get_file_name_and_extension( $file ) {

        return pathinfo( $file, PATHINFO_BASENAME );

    }

}
