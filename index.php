<?php
include "koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Intel Technology</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS eksternal -->
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#"><b>Intel</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link text-dark" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="#article">Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="#gallery">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Homepage -->
  <section id="hero" class="carousel slide" data-ride="carousel" data-interval="1300">
    <div class="carousel-inner">
      <!-- Gambar 1 -->
      <div class="carousel-item active">
        <img src="https://intelcorp.scene7.com/is/image/intelcorp/deep-link-key-art:1648-927" class="d-block w-100"
          alt="...">
      </div>
      <!-- Gambar 2 -->
      <div class="carousel-item">
        <img
          src="https://www.intel.co.id/content/dam/www/central-libraries/us/en/images/intel-museum-11.jpg.rendition.intel.web.1648.927.jpg"
          class="d-block w-100" alt="...">
      </div>
      <!-- Gambar 3 -->
      <div class="carousel-item">
        <img
          src="https://community.intel.com/t5/image/serverpage/image-id/52874i2AD11A6C93E380E6/image-size/large?v=v2&px=999&whitelist-exif-data=Orientation%2CResolution%2COriginalDefaultFinalSize%2CCopyright"
          class="d-block w-100" alt="...">
      </div>
    </div>

    <a class="carousel-control-prev" href="#hero" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#hero" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </section><br><br><br>

  <!-- Article Section -->
  <section id="article" class="section py-5">
    <div class="container">
      <h2 class="text-center display-4">Article</h2>
      <div class="row">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while($row = $hasil->fetch_assoc()){
        ?>
        <div class="col">
          <div class="card h-100">
            <img src="gambar/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text <?= $row["isi"]?>
              </p>
            </div>
            <div class=" card-footer">
                <small class="text-body-secondary">
                  <?= $row["tanggal"]?>
                </small>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Gallery -->
  <section id="gallery" class="bg-danger-subtle text-center py-5 gallery" data-interval="1000">
    <div class="container">
      <h1 class="fw-bold display-4">Gallery</h1><br>
      <div id="galleryCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <!-- Gambar 1 -->
              <div class="col-md-3">
                <div class="card mb-3">
                  <img
                    src="https://intelcorp.scene7.com/is/image/intelcorp/adobestock-314928196:1920-1080?wid=416&hei=234"
                    class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Stabilitas yang lebih baik.</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </div>
              </div>
              <!-- Gambar 2 -->
              <div class="col-md-3">
                <div class="card mb-3">
                  <img
                    src="https://www.intel.co.id/content/dam/www/central-libraries/us/en/images/2022-09/adobestock-522559927.jpeg.rendition.intel.web.416.234.jpg"
                    class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Keamanan telah berlapis</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </div>
              </div>
              <!-- Gambar 3 -->
              <div class="col-md-3">
                <div class="card mb-3">
                  <img
                    src="https://www.intel.co.id/content/dam/www/central-libraries/us/en/images/2022-11/shutterstock-2088641575.jpg.rendition.intel.web.416.234.jpg"
                    class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Meningkatkan kecepatan</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </div>
              </div>
              <!-- Gambar 4 -->
              <div class="col-md-3">
                <div class="card mb-3">
                  <img src="./gambar/pict3.avif" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Performa AI ditingkatkan</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
  </section>


  <!-- Footer -->
  <footer>
    <div class="container text-center">
      <p>&copy; 2024 Source of <a href="https://www.intel.com/content/www/us/en/homepage.html" class="text-dark"
          target="_blank">Intel</a></p>
      <p>Developed by <a href="https://jonathannsite.blogspot.com/" class="text-dark" target="_blank">Jonathan</a></p>
      <div class="social-icons">
        <a href="https://github.com/D-Nathan" target="_blank"><i class="bi bi-github"></i></a>
        <a href="https://www.linkedin.com/in/jonathannaufalfarrel/" target="_blank"><i class="bi bi-linkedin"></i></a>
        <a href="https:// www.instagram.com/jonathan_nr2/" target="_blank"><i class="bi bi-instagram"></i></a>
        <a href="https://www.youtube.com/@JonathanNaufalFarrel" target="_blank"><i class="bi bi-youtube"></i></a>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>