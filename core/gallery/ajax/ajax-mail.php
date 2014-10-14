<?php

	require_once( "../../../../../../wp-config.php" );
	require( ABSPATH . WPINC . '/pluggable.php' );

	require_once( "../class.db.php" );

	global $wpdb;

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

	/*$headers = 'From: '.$data['name'].' <'.$data['email'].'>' . '\r\n';
	$mail = mail( 'robert@gallardodesigner.com.br' , 'Juan lopez se baña en la cabaña' , 'fredo godofredo me gusta el yogurt' );

	//$mail = mail( 'amontenegro.sistemas@gmail.com' , $data['subject'] , $data['message'] );
	//$mail = wp_mail( 'alex_100aleman@hotmail.com', $data['subject'], $data['message'] , $headers );
	
	if($mail):
		$html = 'Your message has been sent';
	else:
		$html = 'We had an error sending your message, please retry again later';
	endif;

	echo $html;*/

?>

