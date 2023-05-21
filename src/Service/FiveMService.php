<?php 

namespace App\Service;

/**
 * Experimental
 * @author amtbzh@gmail.com
 */
class FiveMService
{

    /**
     * Check connection from your server FiveM
     */
    public function checkFiveMServerStatus()
    {
        $ip = '104.143.3.92';
        $port = 3001;

        $connection = @fsockopen($ip, $port, $errno, $errstr, 5);

        if ($connection) {
            echo 'The server is Online';
            fclose($connection);
        } else {
            echo 'The server is offline';
        }
    }

}