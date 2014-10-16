<?php
require 'class.phpmailer.php';
/**
* Clase email que se extiende de PHPMailer
*/
class email  extends PHPMailer{

    //datos de remitente
  var $tu_email = 'web@cosegem.com';
  var $tu_nombre = 'Webmaster Cosegem';
  var $tu_password ='webmaster@2013';

/*
 * Constructor de clase
 */
  public function __construct(){
    //configuracion general
     $this->IsSMTP(); // protocolo de transferencia de correo
     $this->Host = 'gecko.dongee.com';  // Servidor GMAIL
     $this->Port = 465; //puerto
     $this->SMTPAuth = true; // Habilitar la autenticación SMTP
     $this->Username = $this->tu_email;
     $this->Password = $this->tu_password;
     $this->SMTPSecure = 'ssl';  //habilita la encriptacion SSL
     //remitente
     $this->From = $this->tu_email;
     $this->FromName = $this->tu_nombre;
  }

/**
 * Metodo encargado del envio del e-mail
 */
    public function enviar( $para, $nombre, $titulo , $contenido)
    {

      echo $contenido;

      
       $this->AddAddress( $para ,  $nombre );  // Correo y nombre a quien se envia
       $this->WordWrap = 50; // Ajuste de texto
       $this->IsHTML(true); //establece formato HTML para el contenido
       $this->Subject =$titulo;
       $this->Body    =  $contenido; //contenido con etiquetas HTML
       $this->AltBody =  strip_tags($contenido); //Contenido para servidores que no aceptan HTML
       //envio de e-mail y retorno de resultado
       return $this->Send();
     }

}//--> fin clase

/* == se emplea la clase email == */

$contenido_html =  '<p>Hola, <strong>'.$_POST['name'].'</strong> ('.$_POST['mail'].') ha enviado un mensaje:</p> <p>'.$_POST['message'].'</p>';

$email = new email();
if ( $email->enviar( $_POST['to'] , $_POST['name'], $_POST['subject'] ,  $contenido_html ) )
 echo 'Mensaje enviado';
else
{
 echo 'El mensaje no se pudo enviar';
 $email->ErrorInfo;
}

?>