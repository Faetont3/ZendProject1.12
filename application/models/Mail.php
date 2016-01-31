<?php

class Application_Model_Mail {

    public function enviarEmail($url, $email, $ativacao) {
        $smtp = "smtp.gmail.com";
        $conta = "zendricardoparra@gmail.com";
        $senha = "zendparra123";
        $de = "rickhparra@gmail.com";
        $para = $email;
        $assunto = "Email de confirmacao de Cadastro";
        $mensagem = "<a href='" . $url . '/ativar/index?ativacao=' . $ativacao .
                "'>" . 'clique aqui para validar a conta!' . "</a>";

        try {
            $config = array(
                'auth' => 'login',
                'username' => $conta,
                'password' => $senha,
                'ssl' => 'tls',
                'port' => '587'
            );

            $mailTransport = new Zend_Mail_Transport_Smtp($smtp, $config);

            $mail = new Zend_Mail();
            $mail->setFrom($de);
            $mail->addTo($para);
            $mail->setBodyHtml($mensagem);
            $mail->setSubject($assunto);
            $mail->send($mailTransport);

            return "Por favor,verifique seu email para ativação do cadastro!";
        } catch (Exception $e) {
            return 'não enviou ' . $e;
        }
    }
}
