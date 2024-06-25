<?php

namespace App\Models;


class FirebaseNotificacion {

	public $API_ACCESS_KEY;

	public function __construct() {
		$this->API_ACCESS_KEY = 'AAAACvx6ML0:APA91bFfp2sGQcFXZMKlX7QT_hZauuJLh9XfVXudhenZzc_moMEQAmiRqu_3p_4VZ3rfTgEjkSCQPKiwS_GGgfeTT6ZWA0WLQo_Lbzzh_lS9nM_EZ3RgphCZTd1y3PE5_arYFJqOdo6X';
	}


	public function enviarNotificacion($titulo,$cuerpo,$tokenFirebase,$tipo,$idContenido)
	{
		return $this->enviarNotificacionAndroid($titulo,$cuerpo,$tokenFirebase,$tipo,$idContenido);
	}



	public function enviarNotificacionAndroid($titulo,$cuerpo,$tokenFirebase,$tipo,$idContenido)
	{
		$data = array
		(
			'title' => $titulo,
			'alert'	=> $cuerpo,
			'tipo'	=> $tipo,
			'idContenido'	=> $idContenido
		);

		$fields = array
		(
			'registration_ids'    => [$tokenFirebase],
			'data'	=> $data
		);  

		$headers = array
		(
			'Authorization: key=' .$this->API_ACCESS_KEY,
			'Content-Type: application/json'
		);


		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );	

		return $result;
	}

}

?>
