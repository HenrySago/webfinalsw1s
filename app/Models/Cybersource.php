<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;


class Cybersource extends Model
{
    
	public static function getUrlBase()
	{
		return "https://medicinets.com/apiCyberSource/api/";
	}

    public static function getMerchantId()
    {
        return "lectormedidorpagos";
    }



    public static function getProfileId()
    {
        return "94B57125-6A82-4275-8C74-8D3DA3B18614";
    }



    public static function getAccessKeySecureAcceptance()
    {
        return "e835ec04e4e3346bb28442e6fcd01237";
    }



    public static function getSecretKeySecureAcceptance()
    {
        return "15e1d8397c6249248882f265ebc41a174da1c0cb15ba43aca2bccb6670349ce52a25d339b46d4c0fb9efe54b97caf53d618613fa968746319923a246b121af15ad7033965c32405eb1286fb6a0e44171dea233808ad14c1a93330ede8055095c28a6cbe3bf544aa5b26e7633f1fe97bb501a1b95ecea4986b0ac2826a3c4ffea";
    }




    public static function getPaymentUrl()
    {
        return "https://testsecureacceptance.cybersource.com/silent/pay";
    }


    public static function getCreateTokenUrl()
    {
        return "https://testsecureacceptance.cybersource.com/token/create";
    }


    public static function getUpdateTokenUrl()
    {
        return "https://testsecureacceptance.cybersource.com/token/update";
    }


    public static function getOrgId()
    {
        //return "9ozphlqx";
        return "45ssiuz3";
    }

    public static function getFpServer()
    {
        return "h.online-metrix.net";
    }
   
    public static function getIdentificador() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }



    public static function getCardType($cc, $extra_check = false){
        $cards = array(
            "visa" => "(4\d{12}(?:\d{3})?)",
            "mastercard" => "(5[1-5]\d{14})"/*,
            "amex" => "(3[47]\d{13})",
            "jcb" => "(35[2-8][89]\d\d\d{10})",
            "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
            "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
            "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",*/
        );
        $names = array("001","002"/*, "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch"*/);
        $matches = array();
        $pattern = "#^(?:".implode("|", $cards).")$#";
        $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
        if($extra_check && $result > 0){
            $result = (validatecard($cc))?1:0;
        }
        return ($result>0)?$names[sizeof($matches)-2]:false;
    }



    public static function verificarNumberCardLuhn($number) {
      // Set the string length and parity
      $number_length=strlen($number);
      $parity=$number_length % 2;

      // Loop through each digit and do the maths
      $total=0;
      for ($i=0; $i<$number_length; $i++) {
        $digit=$number[$i];
        // Multiply alternate digits by two
        if ($i % 2 == $parity) {
          $digit*=2;
          // If the sum is two digits, add them together (in effect)
          if ($digit > 9) {
            $digit-=9;
          }
        }
        // Total up the digits
        $total+=$digit;
      }

      // If the total mod 10 equals 0, the number is valid
      return ($total % 10 == 0) ? TRUE : FALSE;
    }


    public static function verificarExpiracion($mes,$year) {
        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $year.'-'.$mes.'-01 00:00:00', 'America/La_Paz');
        $startDate = Carbon::now(); //returns current day
        $firstDay = $startDate->firstOfMonth();  
        if($fecha>$firstDay){
            return true;
        }else{
            return false;
        }
    }


    public static function validateDate($mes,$year, $format = 'Y-m-d H:i:s')
    {
        $date = $year.'-'.$mes.'-01 00:00:00';
        //$d = \DateTime::createFromFormat($format, $date);
        //return $d && $d->format($format) == $date;
        return $date;
    }



    public static function sign($params) {

        $secret_key_secure_acceptance = Cybersource::getSecretKeySecureAcceptance();
        return Cybersource::signData(Cybersource::buildDataToSign($params), $secret_key_secure_acceptance);
    }

    public static function signData($data, $secretKey) {
        return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
    }

    public static function buildDataToSign($params) {
        $signedFieldNames = explode(",", $params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }

        return implode(",", $dataToSign);
    }



}
