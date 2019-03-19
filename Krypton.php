<?php
//Base32 Pack
class Base32 {

   private static $map = array(
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
        'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
        'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
        'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
        '='  // padding char
    );
    
   private static $flippedMap = array(
        'A'=>'0', 'B'=>'1', 'C'=>'2', 'D'=>'3', 'E'=>'4', 'F'=>'5', 'G'=>'6', 'H'=>'7',
        'I'=>'8', 'J'=>'9', 'K'=>'10', 'L'=>'11', 'M'=>'12', 'N'=>'13', 'O'=>'14', 'P'=>'15',
        'Q'=>'16', 'R'=>'17', 'S'=>'18', 'T'=>'19', 'U'=>'20', 'V'=>'21', 'W'=>'22', 'X'=>'23',
        'Y'=>'24', 'Z'=>'25', '2'=>'26', '3'=>'27', '4'=>'28', '5'=>'29', '6'=>'30', '7'=>'31'
    );
    
    public static function encode($input, $padding = true) {
        if(empty($input)) return "";
        $input = str_split($input);
        $binaryString = "";
        for($i = 0; $i < count($input); $i++) {
            $binaryString .= str_pad(base_convert(ord($input[$i]), 10, 2), 8, '0', STR_PAD_LEFT);
        }
        $fiveBitBinaryArray = str_split($binaryString, 5);
        $base32 = "";
        $i=0;
        while($i < count($fiveBitBinaryArray)) {    
            $base32 .= self::$map[base_convert(str_pad($fiveBitBinaryArray[$i], 5,'0'), 2, 10)];
            $i++;
        }
        if($padding && ($x = strlen($binaryString) % 40) != 0) {
            if($x == 8) $base32 .= str_repeat(self::$map[32], 6);
            else if($x == 16) $base32 .= str_repeat(self::$map[32], 4);
            else if($x == 24) $base32 .= str_repeat(self::$map[32], 3);
            else if($x == 32) $base32 .= self::$map[32];
        }
        return $base32;
    }
    
    public static function decode($input) {
        if(empty($input)) return;
        $paddingCharCount = substr_count($input, self::$map[32]);
        $allowedValues = array(6,4,3,1,0);
        if(!in_array($paddingCharCount, $allowedValues)) return false;
        for($i=0; $i<4; $i++){ 
            if($paddingCharCount == $allowedValues[$i] && 
                substr($input, -($allowedValues[$i])) != str_repeat(self::$map[32], $allowedValues[$i])) return false;
        }
        $input = str_replace('=','', $input);
        $input = str_split($input);
        $binaryString = "";
        for($i=0; $i < count($input); $i = $i+8) {
            $x = "";
            if(!in_array($input[$i], self::$map)) return false;
            for($j=0; $j < 8; $j++) {
                $x .= str_pad(base_convert(@self::$flippedMap[@$input[$i + $j]], 10, 2), 5, '0', STR_PAD_LEFT);
            }
            $eightBits = str_split($x, 8);
            for($z = 0; $z < count($eightBits); $z++) {
                $binaryString .= ( ($y = chr(base_convert($eightBits[$z], 2, 10))) || ord($y) == 48 ) ? $y:"";
            }
        }
        return $binaryString;
    }
}

class Base16 
{
    public static function encode($text)
    {
        return bin2hex($text);
    }
    
    public static function decode($base16)
    {
        return pack("H*", $base16);
    }
}


class Binary
{

    function bin2bstr($input)
    {
        if (!is_string($input)) return null; // Sanity check
        return pack('H*', base_convert($input, 2, 16));
    }

    function bstr2bin($input)
    {
        if (!is_string($input)) return null; // Sanity check
        $value = unpack('H*', $input);
        return base_convert($value[1], 16, 2);
    }
}
//Hex Pack

class Hexadecimal
{
    public static function String2Hex($string){
        return bin2hex($string);
    }
 
    public static function Hex2String($hex){
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
}

class Decimal
{
    public static function ascii_to_dec($str)
    {
        for ($i = 0, $j = strlen($str); $i < $j; $i++) {
            $dec_array[] = ord($str{$i});
        }
        return $dec_array;
    }

    public function dec_to_ascii($str)
    {
        $n = strlen($str);
        $result = "";
        for ($x=0; $x<=$n; $x += 2) {
            $temp = intval(substr($str,$x,2));
            if($temp < 32) {
                $temp = intval(substr($str,$x,3));
                if($temp > 128) {
                    die ("Assumption error");
                }
                $x++;
            }
            $result .= chr($temp);
        }

        return  $result;
    }
}

//Caesar Pack
class CaesarCipher
{
    public static function EnCipher($str, $offset) {
        $encrypted_text = "";
        $offset = $offset % 26;
        if($offset < 0) {
            $offset += 26;
        }
        $i = 0;
        while($i < strlen($str)) {
            $c = strtoupper($str{$i}); 
            if(($c >= "A") && ($c <= 'Z')) {
                if((ord($c) + $offset) > ord("Z")) {
                    $encrypted_text .= chr(ord($c) + $offset - 26);
                } else {
                    $encrypted_text .= chr(ord($c) + $offset);
                }
            } else {
              $encrypted_text .= " ";
          }
          $i++;
        }
      
        return $encrypted_text;
    }

    public static function DeCipherKey($str, $offset) {
        $decrypted_text = "";
        $offset = $offset % 26;
        if($offset < 0) {
            $offset += 26;
        }
        $i = 0;
        while($i < strlen($str)) {
            $c = strtoupper($str{$i}); 
            if(($c >= "A") && ($c <= 'Z')) {
                if((ord($c) - $offset) < ord("A")) {
                    $decrypted_text .= chr(ord($c) - $offset + 26);
                } else {
                    $decrypted_text .= chr(ord($c) - $offset);
                }
            } else {
              $decrypted_text .= " ";
            }
          $i++;
        }
      return $decrypted_text;
    }

    public static function DeCipherBrute($str) {
        $arrRes = "";
        foreach (range(0, 25) as $key => $value) 
        {
            $arrRes[$key] = self::DeCipherKey($str,$value);
        }
        
        return $arrRes;
    }
}

class MD5 
{
    public function md5_hash($str)
    {
        return md5($str);
    }

    public function md5_unhash($str)
    {
        $unhash = file_get_contents('http://www.nitrxgen.net/md5db/'.$str);
        return $unhash;
    }
}

class SHA1
{
    public static function sha1_hash($str)
    {
        return sha1($str);
    }

    public static function sha1_unhash($str)
    {
        $unhash = file_get_contents('https://hashtoolkit.com/reverse-hash?hash='.$str);
        preg_match("'<span title=\"decrypted sha1 hash\">(.*?)</span>'", $unhash, $match);

        $res = "";
        if($match)
            $res = $match[1];

        return $res;
    }
}

class SHA256
{
    public function sha256_hash($str='')
    {
        return hash('sha256', $str);
    }

    public function sha256_unhash($str='')
    {
        $unhash = file_get_contents('https://hashtoolkit.com/reverse-hash?hash='.$str);
        preg_match("'<span title=\"decrypted sha256 hash\">(.*?)</span>'", $unhash, $match);

        $res = "";
        if($match)
            $res = $match[1];

        return $res;
    }
}

class SHA512
{
    public static function sha512_hash($str)
    {
        return hash('sha512',$str);
    }

    public function sha512_unhash($str)
    {
        $unhash = file_get_contents('https://hashtoolkit.com/reverse-sha512-hash/'.$str);
        preg_match("'<span title=\"decrypted sha512 hash\">(.*?)</span>'si", $unhash, $match);

        $res = "";
        if($match)
            $res = $match[1];
        return $res;
    }
}

class Xor_cipher
{
    public static function xor_this($input,$key) 
    {
        $output = '';
        for ($i = 0; $i < strlen($input); $i++) {
            $output .= chr( ord($input[$i]) ^ $key );
        }
        return $output;
    }
}

