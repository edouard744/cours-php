<?php

namespace Core;
class Validator
{
	public static function correctRequest(array $array, string $key): bool
	{
		return array_key_exists($key, $array);
	}

	public static function between(string $string, int $min = 1, int $max = INF): bool
	{
		return !(strlen(trim($string)) > $max || strlen(trim($string)) < $min);
	}

    public static function correctUser($userId,$note_userId):bool{

         if( $userId === $note_userId){
             return true;
        }else{
             return false;
         }
    }



    public static function correctPassword(string $password):bool{
        if (strlen($password) > 8 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password)){
            return true ;
        }else{
            return false;
        }
    }

    public static function lastPasswordCheck(string $lastPassword, string $newPassword):bool{
        $hash= $lastPassword;
        if (password_verify($newPassword,$hash)){
            return true;
        }else{
            return false;
        }
    }
}