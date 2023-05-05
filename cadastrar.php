<?php 
    include_once("./lib/connection.php");

    $success = ""; 

    $error = "";

    if(isset($_POST['btn'])) {

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $senhaPadrao = $_POST['senha']; 

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?"); 

        $stmt->bindParam(1, $email);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($email) || empty($senhaPadrao)) {
            $error = "Preencha os campos para cadastrar";
        }       
        
        
        else if($usuario) {
            $error = "Este email já está cadastrado, tente outro";
        }


        else {

        $senhaPadrao = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (?,?)");

        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $senhaPadrao);

        $stmt->execute();

        $success = "Usúario cadastrado com sucesso";

        }
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #error {
            color: red;
        }

        #success  {
            color: green;
        }

     
    </style>
</head>

<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-center">
            <img src="./assets/logo.png" alt="">
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Realize seu cadastro</p>
          </div>

          <?php 
            if(!empty($error)):
          ?>

        <p id="error"> <?= $error ?> </p>

        <?php endif; ?>

        <?php 
            if(!empty($success)):
          ?>

        <p id="success"> <?= $success ?> </p>

        <?php endif; ?>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email</label>
            <input type="text" id="form3Example3" name="email" class="form-control form-control-lg"
              placeholder="Digite seu e-mail" />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
          <label class="form-label" for="form3Example3">Senha</label>
            <input type="password" id="form3Example4" name="senha" class="form-control form-control-lg"
              placeholder="Digite sua senha" />
      
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn">Cadastrar</button>
          </div>
           <br>
            <a href="login.php">Voltar</a>
          
        </form>
        
      </div>
    </div>
  </div>
  
  </div>
  
</section>
</body>
</html>
