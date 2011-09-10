<?php

class sys_versions {

    /**
     * Returns the Apache HTTPd Server Version Number
     * @author Bobby Allen (ballen@zpanelcp.com)
     * @version 10.0.0
     * @return string Apache Server version number.
     */
    static function ShowApacheVersion() {
        if (preg_match('|Apache\/(\d+)\.(\d+)\.(\d+)|', apache_get_version(), $apachever)) {
            $retval = str_replace("Apache/", "", $apachever[0]);
        } else {
            $retval = "Not found";
        }
        return $retval;
    }

    /**
     * Returns the PHP version number.
     * @author Bobby Allen (ballen@zpanelcp.com)
     * @version 10.0.0
     * @return string PHP version number
     */
    static function ShowPHPVersion() {
        return phpversion();
    }

    /**
     * Returns the MySQL server version number.
     * @author Bobby Allen (ballen@zpanelcp.com)
     * @version 10.0.0
     * @return string MySQL version number 
     */
    static function ShowMySQLVersion() {
        global $zdbh;
        $retval = $zdbh->query("SHOW VARIABLES LIKE \"version\"")->Fetch();
        return $retval['Value'];
    }

    /**
     * Returns a human readable copy of the Kernal version number running on the server.
     * @author Bobby Allen (ballen@zpanelcp.com)
     * @version 10.0.0
     * @param type $platform
     * @return string *NIX kernal version. - Will return 'N/A' for Microsoft Windows.
     */
    static function ShowOSKernalVersion($platform) {
        if ($platform == 'Linux') {
            $retval = exec('uname -r');
        } else {
            $retval = "N/A";
        }
        return $retval;
    }

    /**
     * Returns in human readable form the operating system platform (eg. Windows, Linux, FreeBSD, Other)
     * @author Bobby Allen (ballen@zpanelcp.com)
     * @version 10.0.0
     * @return string Human readable OS Platform name.
     */
    static function ShowOSPlatformVersion() {
        $os_abbr = strtoupper(substr(PHP_OS, 0, 3));
        if ($os_abbr == "WIN") {
            $retval = "Windows";
        } elseif ($os_abbr == "LIN") {
            $retval = "Linux";
        } elseif ($os_abbr == "FRE") {
            $retval = "FreeBSD";
        } else {
            $retval = "Other";
        }
        return $retval;
    }

    /**
     * Returns in human readable form the operating system name (eg. Windows, Ubuntu, CentOS, MacOSX, FreeBSD, Other)
     * @author Bobby Allen (ballen@zpanelcp.com)
     * @version 10.0.0
     * @return string Human readable OS name.
     */
    static function ShowOSName() {
        $uname = strtolower(php_uname());
        $retval = "";
        if (strpos($uname, "darwin") !== false) {
            $retval = "MacOSX";
        } else if (strpos($uname, "win") !== false) {
            $retval = "Windows";
        } else if (strpos($uname, "freebsd") !== false) {
            $retval = "FreeBSD";
        } else if (strpos($uname, "openbsd") !== false) {
            $retval = "OpenBSD";
        } else {
            /**
             * @todo convert the bottom bit to read from a list of OS's.
             */
            /*
            $list = @parse_ini_file("lib/zpanel/os.ini", true);
            foreach ($list as $section => $distribution) {
                if (!isset($distribution["Files"])) {
                    
                } else {
                    $intBytes = 4096;
                    $intLines = 0;
                    $intCurLine = 0;
                    $strFile = "";
                    foreach (preg_split("/;/", $distribution["Files"], -1, PREG_SPLIT_NO_EMPTY) as $filename) {
                        if (file_exists($filename)) {
                            if (isset($distribution["Name"])) {
                                $os = $distribution["Name"];
                            }
                        }
                    }
                    if ($os == null) {
                        $os = "Unknown";
                    }
                }
            } 
             */
        }
        return $retval;
    }

}

?>