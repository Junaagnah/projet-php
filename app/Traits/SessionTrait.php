<?php

namespace App\Traits;

use ParagonIE\Cookie\Cookie;

trait SessionTrait {

    /**
     * @param string $value
     * @return Void
     */
    public static function setSessionCookie(string $value): Void {
        // Setting cookie
        Cookie::setcookie(COOKIE_SESSION_KEY, SessionTrait::encryptCookieValue($value), 1000000000000, '/', 'localhost', false, true);
    }

    /**
     * @param string $cookieValue
     * @return String
     */
    public static function getSessionCookieValue(string $cookieValue): String {
        return SessionTrait::decryptCookieValue($cookieValue);
    }

    /**
     * @return Void
     */
    public static function unsetSessionCookie(): Void {
        // When the user disconnects, we set an empty cookie and unset the user variable in $_SESSION
        unset($_SESSION['user']);
        Cookie::setcookie(COOKIE_SESSION_KEY, '', time() - 3600);
    }

    /**
     * @param string $value
     * @return String
     */
    private static function encryptCookieValue(string $value): String {
        // Generating Initialization Vector Size
        $iv_size = openssl_cipher_iv_length(COOKIE_CYPHER);
        try {
            // Generating Initialization Vector
            $iv = random_bytes($iv_size);
        } catch (\Exception $e) {
            // If no random byte generation method is found, we die
            die();
        }
        // Returns encrypted value + iv
        return openssl_encrypt($value, COOKIE_CYPHER, COOKIE_SECRET, 0, $iv) . '|' . $iv;
    }

    /**
     * @param string $value
     * @return String
     */
    private static function decryptCookieValue(string $value): String {
        // Getting the encrypted value and iv
        $valueAndIv = explode('|', $value);
        $decryptedValue = '';

        try {
            $decryptedValue = openssl_decrypt($valueAndIv[0], COOKIE_CYPHER, COOKIE_SECRET, 0, $valueAndIv[1]);
        } catch (\Exception $e) {
            // If we encounter an error, we return an empty string and we unset the cookie
            SessionTrait::unsetSessionCookie();
        }
        return $decryptedValue;
    }
}
