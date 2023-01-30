<?php

  require_once("globals.php");
  require_once("db.php");
  require_once("models/User.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $userDao = new UserDAO($conn, $BASE_URL);

  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Verificação do tipo de formulário
  if($type === "register") {

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Verificação de dados mínimos 
    if($name && $lastname && $email && $password) {

      // Verificar se as senhas batem
      if($password === $confirmpassword) {

         //verificar se o email existe no sistema
          if($userDao->findByEmail($email) === false) {
 
            $user = new User();

            //criação de token e e senha
            $userToken = $user->generateToken();
            $finalPassword = $user->generatePassword($password);


            $user->name = $name;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->password = $finalPassword;
            $user->token = $userToken;

            $auth = true;


            $userDao->create($user, $auth);


          } else {
            // Enviar uma msg de erro, usuario já cadastrado
            $message->setMessage("Usuário já cadastrado tente outro e-mail.", "error", "back");

          }

      } else {

        // Enviar uma msg de erro, de senhas não batem
        $message->setMessage("As senhas não são iguais.", "error", "back");

      }

    } else {

      // Enviar uma msg de erro, de dados faltantes
      $message->setMessage("Por favor, preencha todos os campos.", "error", "back");

    }

  } else if($type === "login") {

    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    //tenta autenticar usuario
    if($userDao->authenticateUser($email, $password)) {

      message->setMessage("Seja bem-vindo!", "success", "editprofile.php");

     //redireciona usuario caso não conseguir autenticar
    } else {

      $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");
     
    }

  } else {
    
    $message->setMessage("Informações invalidas", "error", "index.php");

  }