<?php

	//require_once( "../../../../../../wp-config.php" );
	//require( ABSPATH . WPINC . '/pluggable.php' );

	//require_once( "../class.db.php" );

	//global $wpdb;

	$data = $_POST;
/*
			if (eregi('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
			        $emailsender='robert@gallardodesigner.com.br'; // Substitua essa linha pelo seu e-mail@seudominio
			} else {
			        $emailsender = "robert@" . $_SERVER[HTTP_HOST];
			        //    Na linha acima estamos forçando que o remetente seja 'webmaster@seudominio',
			        // Você pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
			}
			 */
			/* Verifica qual éo sistema operacional do servidor para ajustar o cabeçalho de forma correta.  */
		/*	if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
			else $quebra_linha = "\n"; //Se "nÃ£o for Windows"
			 
			// Passando os dados obtidos pelo formulário para as variáveis abaixo
			$nomeremetente     = $_POST['nomeremetente'];
			$emailremetente    = $_POST['robert@gallardodesigner.com.br'];
			$emaildestinatario = $_POST['robert@gallardodesigner.com.br'];
			$comcopia          = $_POST['comcopia'];
			$comcopiaoculta    = $_POST['comcopiaoculta'];
			$assunto           = $_POST['assunto'];
			$mensagem          = $_POST['mensagem'];
			 
			 */
			/* Montando a mensagem a ser enviada no corpo do e-mail. */
		/*	$mensagemHTML = '<P>Esse email &eacute; um teste enviado no formato HTML via PHP mail();!</P>
			<P>Aqui está a mensagem postada por você; formatada em HTML:</P>
			<p><b><i>'.$mensagem.'</i></b></p>
			<hr>';
			 
		*/	 
			/* Montando o cabeÃ§alho da mensagem */
		/*	$headers = "MIME-Version: 1.1" .$quebra_linha;
			$headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
			// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
			$headers .= "From: " . $emailsender.$quebra_linha;
			$headers .= "Cc: " . $comcopia . $quebra_linha;
			$headers .= "Bcc: " . $comcopiaoculta . $quebra_linha;
			$headers .= "Reply-To: " . $emailremetente . $quebra_linha;
			// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
		*/	 
			/* Enviando a mensagem */

			//É obrigatório o uso do parâmetro -r (concatenação do "From na linha de envio"), aqui na Locaweb:
/*
			if(!mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
			    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
			    mail($emaildestinatario, $assunto, $mensagemHTML, $headers );
			}
			 */
/*
	$headers = 'From: '.$data['name'].' <'.$data['email'].'>' . '\r\n';
	$mail = mail( 'robert@gallardodesigner.com.br' , 'Juan lopez se baña en la cabaña' , 'fredo godofredo me gusta el yogurt' );

	$mail = mail( 'amontenegro.sistemas@gmail.com' , $data['subject'] , $data['message'] );
	$mail = wp_mail( 'alex_100aleman@hotmail.com', $data['subject'], $data['message'] , $headers );
	
	if($mail):
		$html = 'Your message has been sent';
	else:
		$html = 'We had an error sending your message, please retry again later';
	endif;

	echo $html;
*/
# ------------------------------------------------

  /*include ("../smtp.class.php");
  $host = "smtp.gmail.com"; //host do servidor SMTP 
  $mail = "amontenegro.sistemas@gmail.com";//o endereço de e-mail deve ser válido.
  $senha = "23498535";
  date_default_timezone_set('America/Sao_Paulo');
  // Configuração da classe.e smtp.class.php 
  $smtp = new Smtp($host, 465);
  $smtp->user = $mail; #usuario do servidor SMTP 
  $smtp->pass = $senha; # senha do usuario do servidor SMTP
  $smtp->debug = true; #ativa a autenticacao SMTP 

  # Prepara a mensagem para ser enviada. 
  $from = $data['email'];
  $to = $mail;
  $subject = $data['subject'];
  $msg = "<b>Esta mensagem é um teste da <font color=red>Locaweb.</font><</b><br />";
  $msg .= $data['message'];

  # faz o envio da mensagem 
  $enviou = $smtp->Send($to, $from, $subject, $msg, "text/html") ? 'enviou' : 'falhou';
  echo $enviou;
  //header('Location:index.php?status='.$enviou, "-r".$from);*/

#----------------------------------------------------------

  require '../phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;


	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'amontenegro.sistemas@gmail.com';                 // SMTP username
	$mail->Password = '23498535';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->From = 'amontenegro.sistemas@gmail.com';
	$mail->FromName = 'Mailer';
	$mail->addAddress('theguitarplayer.am@gmail.com', 'Alexis Montenegro');     // Add a recipient
	$mail->addAddress('robertdacorte@gmail.com', 'Robert Dacorte');               // Name is optional
	$mail->addReplyTo('amontenegro.sistemas@gmail.com', 'Alexis Montenegro');
	$mail->addCC('alex_100aleman@gmail.com');
	$mail->addBCC('alexisanderson@ovi.com');

	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Here is the subject';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	return "Response";
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	return "Response";
	    echo 'Message has been sent';
	}

?>

