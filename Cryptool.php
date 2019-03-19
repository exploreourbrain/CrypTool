<?php
/**
* @author Krypton aka 0x00b0 aka GreyCat - ExploreOurBrain
* @package CTF Tool
*
*/

require "Krypton.php";

class Cryptool
{

    public static function main()
    {
        echo self::banner();
        self::printMenu();
        $option = fopen ("php://stdin","r");
        echo "\nOption : ";
        $choosed= trim(fgets($option));

        self::choosen($choosed);
        
        echo "\n\n\nDo U Want Continue ?  y or n - ";
        $handle = fopen ("php://stdin","r");
        $line = trim(fgets($handle));

        if ( $line != 'y') 
        {
            die();
        }
        else
        {
            self::main();
        }
    }  

    public static function choosen($choosed='')
    {
        switch ($choosed) {
            case '1':
                echo self::base64();
            break;
            
            case '2':
                echo self::base32();
            break;

            case '3':
                echo self::base16();
            break;

            case '4':
                echo self::binary();
            break;

            case '5':
                echo self::hexadecimal();
            break;

            case '6':
                echo self::decimal();
            break;

            case '7':
                echo self::rot13();
            break;

            case '8':
                echo self::caesar();
            break;

            case '9':
                echo self::reversed_text();
            break;

            case '10':
                echo self::md5_hash();
            break;

            case '11':
                echo self::sha1_hash();
            break;

            case '12':
                echo self::sha256_hash();
            break;

            case '13':
                echo self::sha512_hash();
            break;

            case '14':
                echo self::xor_cipher();
            break;

            default:
                echo "U Were Choosed Option not Available Menu !";
                break;
        }
    }

    public static function options()
    {
        $opt = "";
        $opt.= "[1] Encode\n";
        $opt.= "[2] Decode\n";

        return $opt;
    } 

    public static function options1()
    {
        $opt = "";
        $opt.= "[1] Encrypt\n";
        $opt.= "[2] Decrypt\n";

        return $opt;
    } 

    public static function options2()
    {
        $opt = "";
        $opt.= "[1] Hash\n";
        $opt.= "[2] unHash\n";

        return $opt;
    } 

    public static function printMenu()
    {
        $list = '';
        $list .= "[1] Base64"."\n";
        $list .= "[2] Base32"."\n";
        $list .= "[3] Base16"."\n";
        $list .= "[4] Binary"."\n";
        $list .= "[5] Hexadecimal"."\n";
        $list .= "[6] Decimal"."\n";
        $list .= "[7] ROT13"."\n";
        $list .= "[8] Caesar"."\n";
        $list .= "[9] Reversed Text"."\n";
        $list .= "[10] MD5 Hash"."\n";
        $list .= "[11] SHA1 Hash"."\n";
        $list .= "[12] SHA256 Hash"."\n";
        $list .= "[13] SHA512 Hash"."\n";
        $list .= "[14] X0r"."\n";
        echo $list;
    }

    public static function banner()
    {
        $x =  "╔═╗┬─┐┬ ┬┌─┐╔╦╗┌─┐┌─┐┬  
║  ├┬┘└┬┘├─┘ ║ │ ││ ││  
╚═╝┴└─ ┴ ┴   ╩ └─┘└─┘┴─┘"."Mini Crypto Helper for CTF  \n";
        $x .= "< ".get_current_user()."@".gethostname()." : > echo @author : Krypton a.k.a 0x00b0 \n\n";
        return $x;
    }

    public static function base64()
    {
        echo self::options();
        echo "\nOption : ";
        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = base64_encode($str);
        }
        else{
            $res = base64_decode($str);
        }

        return "Result : ".( trim($res) == false ? 'Error, Probably not '.__FUNCTION__.' format !' : trim($res) )."\n";
    }

    public static function base32()
    {
        echo self::options();
        echo "\nOption : ";
        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = Base32::encode($str);
        }
        else{
            $res = Base32::decode($str);
        }

        return "Result : ".( trim($res) == false ? 'Error, Probably not '.__FUNCTION__.' format !' : trim($res) )."\n";
    }

    public static function base16()
    {
        echo self::options();
        echo "\nOption : ";
        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = Base16::encode($str);
        }
        else{
            $res = Base16::decode($str);
        }

        return "Result : ".( trim($res) == false ? 'Error, Probably not '.__FUNCTION__.' format !' : trim($res) )."\n";
    }

    public static function binary()
    {
        echo self::options();
        echo "\nOption : ";
        
        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = Binary::bstr2bin($str);
        }
        else{
            $res = Binary::bin2bstr($str);
        }

        return "Result : ".( trim($res) == false ? 'Error, Probably not '.__FUNCTION__.' format !' : trim($res) )."\n";
    }

    public static function hexadecimal()
    {
        echo self::options();
        echo "\nOption : ";

        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = Hexadecimal::String2Hex($str);
        }
        else{
            $res = Hexadecimal::Hex2String($str);
        }

        return "Result : ".( trim($res) == false ? 'Error, Probably not '.__FUNCTION__.' format !' : trim($res) )."\n";
    }

    public static function decimal()
    {
        echo self::options();
        echo "\nOption :";


        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = implode("",Decimal::ascii_to_dec($str));
        }
        else{
            $res = Decimal::dec_to_ascii($str);
        }

        return "Result : ".( trim($res) == false ? 'Error, Probably not '.__FUNCTION__.' format !' : $res) ."\n";
    }

    public static function rot13()
    {
        echo "ROT13 en/dec : ";
        $str    = fopen ("php://stdin","r");
        $str    = trim(fgets($str));
        $res    = str_rot13($str);
        return "Result : ".( trim($res) == false ? 'Error, Probably not '.__FUNCTION__.' format !' : $res) ."\n";
    }

    public static function caesar()
    {
        $opt = "";
        $opt.= "\n[1] Encrypt\n";
        $opt.= "[2] Decrypt - Known Shift\n";
        $opt.= "[3] Decrypt - Brute Shift\n";
        echo $opt;

        echo 'Option : ';
        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));

        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));


        $res = "";
        if ($choosed == 1) 
        {
            $key    = fopen ("php://stdin","r");
            echo "Key Number : ";
            $key = trim(fgets($key));
            $res = CaesarCipher::Encipher($str,$key);
        }
        elseif($choosed == 2)
        {
            $key    = fopen ("php://stdin","r");
            echo "Key Number : ";
            $key = trim(fgets($key));
            $res = CaesarCipher::DecipherKey($str,$key);
        }
        else
        {
            $res = CaesarCipher::DeCipherBrute($str);
        }

        echo "\n";
        foreach ($res as $key => $value) 
        {
            echo $key.' - '. $value."\n";
        }
    }

    public static function reversed_text()
    {
        $optt   = fopen ("php://stdin","r");

        echo "String : ";
        $str = fopen ("php://stdin","r");
        $str = trim(fgets($str));

        $res = "";
        if (!empty($str)) 
        {
            $res = strrev($str);
        }

        return "Result : ".( trim($res) == false ? 'Error, Probably not '.__FUNCTION__.' format !' : trim($res) )."\n";
    }

    public static function md5_hash()
    {
        echo self::options2();
        echo "\nOption : ";

        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = MD5::md5_hash($str);
        }
        else{
            $res = MD5::md5_unhash($str);
        }

        return "Result : ".( trim($res) == false ? 'Failed to unHash !' : trim($res) )."\n";
    }

    public static function sha1_hash()
    {
        echo self::options2();
        echo "\nOption : ";

        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = SHA1::sha1_hash($str);
        }
        else{
            $res = SHA1::sha1_unhash($str);
        }

        return "Result : ".( trim($res) == false ? 'Failed to unHash !' : trim($res) )."\n";
    }



    public static function sha256_hash()
    {
        echo self::options2();
        echo "\nOption : ";

        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = SHA256::sha256_hash($str);
        }
        else{
            $res = SHA256::sha256_unhash($str);
        }

        return "Result : ".( trim($res) == false ? 'Failed to unHash !' : trim($res) )."\n";
    }


    public static function sha512_hash()
    {
        echo self::options2();
        echo "\nOption : ";

        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));

        $res = "";
        if ($choosed == 1) 
        {
            $res = SHA512::sha512_hash($str);
        }
        else{
            $res = SHA512::sha512_unhash($str);
        }

        return "Result : ".( trim($res) == false ? 'Failed to unHash !' : trim($res) )."\n";
    }

    public static function xor_cipher()
    {
        $opt = "";
        $opt.= "[1] EN/DE\n";
        $opt.= "[2] Decrypt Brute Force\n";
        echo $opt;
        echo "\nOption : ";

        $optt   = fopen ("php://stdin","r");
        $choosed= trim(fgets($optt));
        $str    = fopen ("php://stdin","r");
        echo "String : ";
        $str = trim(fgets($str));
        
        $res = "";
        if ($choosed == 1) 
        {
            $key    = fopen ("php://stdin","r");
            echo "Key Number : ";
            $key = trim(fgets($key));
            $res = Xor_cipher::xor_this($str,$key);
    
            return "Result : ".( trim($res) == false ? 'Failed to decrypt !' : trim($res) )."\n";
        }
        else
        {
            $res = "";
            foreach (range(0, 256) as $key => $value) 
            {
                $crypt = Xor_cipher::xor_this($str,$value);
                if (ctype_print($crypt)) 
                {
                    echo $value. " => ".$crypt."\n";
                }
            }
        }
    }

}

Cryptool::main();


