<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  
  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['password']);

	//prepared statement
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

	//parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string
  
  //database executes the statement
  $stmt->execute();
  
  //menampung hasil eksekusi
  $hasil = $stmt->get_result();
  
  //mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  //check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    //jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['username'];

    //mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
	  //jika tidak ada (gagal), alihkan kembali ke halaman login
    header("location:login.php");
  }

	//menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <!-- Link Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Bootstrap Icons (optional) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
    // Variabel untuk menampung error
    $usernameError = $passwordError = "";
    $username = $password = "";

    // Cek apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi email
        if (empty($_POST["username"])) {
            $usernameError = "Please enter your username.";
        } else {
            $email = filter_var($_POST["username"], FILTER_SANITIZE_USERNAME); // Sanitasi input email
            if (!filter_var($usernameError, FILTER_VALIDATE_USERNAME)) {
                $emailError = "Invalid username format.";
            }
        }

        // Validasi password
        if (empty($_POST["password"])) {
            $passwordError = "Please enter your password.";
        } else {
            $password = $_POST["password"]; // Simpan password
        }
    }
    ?>

  <section class="login d-flex">
    <div class="login-left w-50 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-6">
          <div class="header">
            <h1>Login</h1>
            <login>Hi, Silahkan masuk terlebih dahulu !!!</p>
          </div>

          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control <?php echo !empty($usernameError) ? 'is-invalid' : ''; ?>"
                id="username" name="username" placeholder="Enter your username"
                value="<?php echo htmlspecialchars($username); ?>">
              <div class="invalid-feedback">
                <?php echo $usernameError; ?>
              </div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control <?php echo !empty($passwordError) ? 'is-invalid' : ''; ?>"
                id="password" name="password" placeholder="Enter your password">
              <div class="invalid-feedback">
                <?php echo $passwordError; ?>
              </div>
            </div>

            <a href="#" class="text-decoration-none d-block mb-3">Forgot password?</a>
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
          </form>

          <div class="text-center mt-3">
            <span>Don't have an account? <a href="#" class="text-decoration-none">Sign up for Free</a></span>
          </div>
        </div>
      </div>
    </div>

    <div class="login-right w-50 h-100">
      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./gambar/pict1.avif" class="d-block w-100" alt="First Slide">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>
<?php
}
?>