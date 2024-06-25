<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Factura;
use App\Models\Cybersource;
use Carbon\Carbon;
use DB;

class PagoController extends Controller
{
  
    
    public function index(Request $request,$token)
    {
        $factura = Factura::obtenerFacturaPorToken($token);
        session()->put('token', $token);

        $merchant_id = Cybersource::getMerchantId();
        $df_org_id = Cybersource::getOrgId();
        $profile_id = Cybersource::getProfileId();
        $access_key_secure_acceptance = Cybersource::getAccessKeySecureAcceptance();
        $secret_key_secure_acceptance = Cybersource::getSecretKeySecureAcceptance();

        $payment_url = Cybersource::getPaymentUrl();
        $create_token_url = Cybersource::getCreateTokenUrl();
        $update_token_url = Cybersource::getUpdateTokenUrl();


        $customer_ip_address = $request->ip();
        $signed_data_time = gmdate("Y-m-d\TH:i:s\Z");
        $session_id = Cybersource::getIdentificador();


        return view('pago.index', [
                    "factura"=>$factura,           
                    "profile_id"=>$profile_id,
                    "access_key_secure_acceptance"=>$access_key_secure_acceptance,
                    "secret_key_secure_acceptance"=>$secret_key_secure_acceptance,
                    "payment_url"=>$payment_url,
                    "create_token_url"=>$create_token_url,
                    "update_token_url"=>$update_token_url,
                    "customer_ip_address"=>$customer_ip_address,
                    "transaction_uuid"=> uniqid(),
                    "signed_data_time" => $signed_data_time,
                    "merchant_id"=> $merchant_id,
                    "df_org_id"=> $df_org_id,
                    "session_id"=> $session_id,
                    "token"=>$token,
                    "identificador"=>$factura->id
                ]);
    }

    
    public function confirmar(Request $request)
    {
        $token = session()->get('token');

        $card_number = preg_replace('/\D/', '',trim($request->card_number));
        $request->request->add(['card_number' => $card_number]);
        $card_expiry_date = str_replace(' ', '', $request->card_expiry_date);
        $expiracion = explode('/', $card_expiry_date);
        $mes = $expiracion[0];
        $year = $expiracion[1];
        $type_card_number = "";
        
        if(Cybersource::verificarNumberCardLuhn($request->card_number)){
            if(Cybersource::validateDate($mes,$year)){
                if(Cybersource::verificarExpiracion($mes,$year)){
                    $type_card_number = Cybersource::getCardType($request->card_number);
                    if($type_card_number=="001" || $type_card_number=="002"){
                        $request->request->add(['card_type' => $type_card_number]);
                        $request->request->add(['card_expiry_date' => $mes.'-'.$year]);
                        $payment_url = Cybersource::getPaymentUrl();
                        $endpoint_url = $payment_url;
                        $sign = Cybersource::sign($request->all());

                       
                        return view("pago.confirmar",[
                            "endpoint_url"=>$endpoint_url,
                            "sign"=>$sign,
                            "token"=>$token,
                            "params"=>$request->all()
                        ]);
                    }else{
                        session()->flash('message', 'Tipo de tarjeta no permitida, se permite solo tarjetas visa y mastercard');
                        return $this->index($request,$token);
                    }
                }else{
                    session()->flash('message', 'La fecha de expiración ingresada se encuentra vencida.');
                    return $this->index($request,$token);
                }
            }else{
                session()->flash('message', 'La fecha de expiración ingresada no es valida.');
                return $this->index($request,$token);
            }

        }else{
            session()->flash('message', 'Número de tarjeta invalida');
            return $this->index($request,$token);
        }
    }



    public function callback(Request $request,$token)
    {
        //dd($request);
        $message = "";
        $response = $request->all();
        if($response['reason_code']=="100" && $response['decision']=="ACCEPT"){   
            $identificador =$response['transaction_id'];          
            Factura::marcarFacturaComoPagada($token,$identificador);
            $message = "Transacción realizada exitosamente";
            return view('pago.finalizar',['mensaje'=>$message]);

        }else{
            $message = $response['message'];
            return view('pago.finalizar',['mensaje'=>$message]);
        }
    }


}
