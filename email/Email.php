<?php   
    // Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
    require_once("PHPMailer/PHPMailerAutoLoad.php");

    // Inicia a classe PHPMailer 
    $mail = new PHPMailer(); 
    
    // Método de envio 
    $mail->IsSMTP(); 
    
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // Enviar por SMTP 
    $mail->Host = "smtp.gmail.com"; 
    // $mail->Host = gethostbyname('smtp.gmail.com');

    $mail->SMTPSecure = "tls"; // conexão segura com TLS
    
    // Você pode alterar este parametro para o endereço de SMTP do seu provedor 
    $mail->Port = 587;
    
    // Usar autenticação SMTP (obrigatório) 
    $mail->SMTPAuth = true; 
    
    // Usuário do servidor SMTP (endereço de email) 
    // obs: Use a mesma senha da sua conta de email 
    $mail->Username = "smarthouse.unip@gmail.com"; 
    $mail->Password = "smart1234house";

    
    // Configurações de compatibilidade para autenticação em TLS 
    //$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
    
    // Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
    //$mail->SMTPDebug = 2; 
    
    // Define o remetente 
    // Seu e-mail 
    $mail->From = "smarthouse.unip@gmail.com"; 
    
    // Seu nome 
    $mail->FromName = "Smart House"; 

    function enviarEmail($email) {
        global $mail;
        // Define o(s) destinatário(s) 
        //echo $email["email"] . "<br>";
        $mail->AddAddress($email["email"], $email["nome"]); 
        
        // Opcional: mais de um destinatário
        // $mail->AddAddress('fernando@email.com'); 
        
        // Opcionais: CC e BCC
        // $mail->AddCC('joana@provedor.com', 'Joana'); 
        // $mail->AddBCC('roberto@gmail.com', 'Roberto'); 
        
        // Definir se o e-mail é em formato HTML ou texto plano 
        // Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
        $mail->IsHTML(true); 
        
        // Charset (opcional) 
        $mail->CharSet = 'UTF-8'; 
        
        // Assunto da mensagem 
        $mail->Subject = $email["assunto"]; 
        
        // Corpo do email
        if ($email["corpo"] == "Enviado") {
            $mail->Body = file_get_contents(dirname( __FILE__ ) . '/enviado.html');
        } else if ($email["corpo"] == "Aprovado") {
            $mail->Body = file_get_contents(dirname( __FILE__ ) . '/aprovado.html');
        } else {
            $mail->Body = $email["corpo"];
        }
    
        // Opcional: Anexos 
        // $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 
        
        // Envia o e-mail 
        $enviado = $mail->Send(); 
        
        // Exibe uma mensagem de resultado 
        if ($enviado) 
        { 
            return true;
        } else {
            echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
            die("Houve um erro enviando o email: ".$mail->ErrorInfo); 
        } 
    
    }
?>