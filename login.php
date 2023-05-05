<?php 
    include_once("./lib/connection.php");

    $error = false;

    if(isset($_POST['btn'])) {
        $email = $_POST['email']; 
        $senha = $_POST['senha'];

        if(empty($email) || empty($senha)){
            $error = "Preencha as informações!";
        }

        else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?"); 

        $stmt->bindParam(1, $email);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

       if($usuario) {
        if(password_verify($senha, $usuario['senha'])){ // Comparando a senha do formulario com a senha do banco criptografada
            echo "Logado!";
        }
        else {
            $error = "Erro ao logar, verifique suas informações!";
        }
       }
       else {
        $error = "Esse email não existe";
       }
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
</head>

<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="./assets//draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <img src="./assets/logo.png" alt="">
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">ACESSAR</p>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <?php 
                if(isset($error) || !empty($error)):
            ?>

         <p class='red'><?= $error?></p>
        <?php 
            endif;
        ?>
            <label class="form-label" for="form3Example3">Email</label>
            <input type="email" id="form3Example3" name="email" class="form-control form-control-lg"
              placeholder="Digite seu e-mail" />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
          <label class="form-label" for="form3Example3">Senha</label>
            <input type="password" id="form3Example4" name="senha" class="form-control form-control-lg"
              placeholder="Digite sua senha" />
      
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Lembrar-me
              </label>
            </div>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btn">Entrar</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Ainda não possui uma conta? <a href="cadastrar.php"
                class="link-danger">Registrar</a></p>
                
          </div>
        </form>
        
      </div>
    </div>
  </div>
  
  </div>
  
</section>
</body>
</html>
