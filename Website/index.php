<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.min.css">
  <meta name="author" content="Clément Lazzarini">

  <title>Relax'Sens - Accueil</title>
  <meta name="description" content="Relax'Sens - Institut de beauté Digoin - Accueil">
  <link rel="icon" href="img/makeup-pouch.png">
</head>

<body>
    <header>
      <nav class="navbar dark-mode" role="navigation">
        <a href="index.html"  class="navbar__logo"><div></div></a>    
        <ul class="navbar__links">
          <li class="navbar__link first"><a href="index.html">Accueil</a></li>
          <li class="navbar__link second"><a href="nos_marques.html">Nos marques</a></li>
          <li class="navbar__link third"><a href="tarifs.html">Tarifs</a></li>
          <li class="navbar__link four"><a href="a_propos.html">A propos</a></li>
          <li class="navbar__link fifth"><a href="contact.html">Contact</a></li>
        </ul>   
        <button class="burger">
          <span class="bar"></span>  
        </button>   
      </nav>
        <div class="cover">
          <h1 class="title">Relax’Sens</h1>
          <a href="tel:+33358420899" class="cta">Nous contacter</a>
        </div>

    </header>
    <main>
      <div class="carousel">
        <div class="carousel_inner">
            <!-- Première page : Offre Guinot -->
            <div class="carousel_item active">
                <?php
                // On charge les données ou on met des valeurs par défaut
                $file = 'offre_data.json';
                if (file_exists($file)) {
                    $data = json_decode(file_get_contents($file), true);
                } else {
                    $data = [
                        'titre' => 'En ce moment',
                        'texte' => 'Aucune offre pour le moment.',
                        'image' => 'img/default.jpg'
                    ];
                }
              ?>

              <div class="offer">
                  <img class="offer_img" src="<?php echo htmlspecialchars($data['image']); ?>" alt="Offre du moment" style="width: 18rem; height: 18rem; object-fit: cover;">
                  <div class="offer_desc">
                      <h2><?php echo htmlspecialchars($data['titre']); ?></h2>
                      <p><?php echo nl2br(htmlspecialchars($data['texte'])); ?></p> <a href="nos_marques.html" class="cta_offer">Découvrir nos marques</a>
                  </div>
              </div>
            </div>
    
            <!-- Deuxième page : Images uniquement -->
            <div class="carousel_item">
              <div class="offer" style="justify-content: center;">
                  <div class="image_gallery">
                    <h2 style="text-align: center;font-size: 1.8rem;
                    margin-bottom: 1rem;
                    text-transform: uppercase;
                    font-weight: 400;
                    font-family: 'Antic Didone', serif;">Notre Institut a fait peau neuve ! ✨</h2>
                    <div class="gallery_container">
                      <img src="img/newinstitut1.jpeg" alt="Image 1" class="gallery_img">
                      <img src="img/newinstitut2.jpeg" alt="Image 2" class="gallery_img">
                      <img src="img/newinstitut3.jpeg" alt="Image 3" class="gallery_img">
                    </div>
                </div>
              </div>
            </div>
        </div>
     
        <!-- Boutons de navigation -->
        <button class="carousel_btn prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="carousel_btn next" onclick="moveSlide(1)">&#10095;</button>
    </div>
    
        <section class="menu">
            <h2>Nos prestations</h2>
            <div class="menu_grid">
              
                <a href="tarifs.html#modelages" class="card modelage">
                    <div class="card__overlay">
                      <div class="card__header">
                        <div class="card__header-text">
                          <h3 class="card__title">Modelages<h3>            
                        </div>
                      </div>
                      <p class="card__description">Venez vous faire plaisir avec nos différents modelages (Californien, Oriental,...)</p>
                    </div>
                </a>

                <a href="tarifs.html#soinsvisages" class="card visage">
                    <div class="card__overlay">
                      <div class="card__header">
                        <div class="card__header-text">
                          <h3 class="card__title">Soins visages et corps<h3>            
                        </div>
                      </div>
                      <p class="card__description">Prenez soins de vous avec nos prestations soins du corps et visage.</p>
                    </div>
                </a>

                <a href="tarifs.html#manucure" class="card mains">
                    <div class="card__overlay">
                      <div class="card__header">
                        <div class="card__header-text">
                          <h3 class="card__title">Soins mains et pieds<h3>            
                        </div>
                      </div>
                      <p class="card__description">Envie d'une manucure ? D'un soins des mains et des pieds ? On vous attends.</p>
                    </div>
                </a>

                <a href="tarifs.html#maquillage" class="card maquillage">
                    <div class="card__overlay">
                      <div class="card__header">
                        <div class="card__header-text">
                          <h3 class="card__title">Maquillage<h3>            
                        </div>
                      </div>
                      <p class="card__description">Des festivités en vue ? Venez vous faire maquiller à l'Institut et ayez l'esprit tranquille.</p>
                    </div>
                </a>

                <a href="tarifs.html#epilations" class="card epilation">
                    <div class="card__overlay">
                      <div class="card__header">
                        <div class="card__header-text">
                          <h3 class="card__title">Epilations<h3>            
                        </div>
                      </div>
                      <p class="card__description">Venez vous faire épiler. Finis les poils !</p>
                    </div>
                </a>

                <a href="contact.html" class="card gift">
                    <div class="card__overlay">
                      <div class="card__header">
                        <div class="card__header-text">
                          <h3 class="card__title">Cartes cadeaux<h3>            
                        </div>
                      </div>
                      <p class="card__description">Vous voulez faire plaisir à un proche ? Offrez lui un bon cadeau !</p>
                    </div>
                </a>

            </div>
        </section>

    </main>
    <footer>
        <div class="footer">
            <div class="footer_logo-box">
              <div class="footer_logo"></div>
          </div>
            <div class="footer_adress-box">
              <div class="footer_adress">
                <h2>RELAX'SENS</h2>
                <p>Espace commercial “Les Donjons”</br>
                  Galerie Centre E.LECLERC</br>
                  71160 DIGOIN</p>
              </div>
            </div>
            <div class="footer_contact">
                <h2>CONTACT</h2>
                <a href="tel:+33358420899" class="footer_contact-tel">
                    <div class="contact-tel-img"></div>
                    <p>03 58 42 08 99</p>
                </a>
                <a href="mailto:
                relaxsens.sarl@sfr.fr" class="footer_contact-mail">
                    <div class="contact-mail-img"></div>
                    <p>relaxsens.sarl@sfr.fr</p>
                </a>
            </div>
            <div class="footer_mentions-box">
              <div class="footer_mentions">
                <a href="mentions.html">MENTIONS LÉGALES</a>
              </div>  
            </div>
        </div>

    </footer>
    <script defer>
      function toggleMenu () {  
        const navbar = document.querySelector('.navbar');
        const burger = document.querySelector('.burger');
        burger.addEventListener('click', (e) => {    
        navbar.classList.toggle('show-nav');
        });    
      }
      toggleMenu();

      let currentIndex = 0;
      const slides = document.querySelectorAll(".carousel_item");

      function moveSlide(step) {
          slides[currentIndex].classList.remove("active");
          currentIndex = (currentIndex + step + slides.length) % slides.length;
          slides[currentIndex].classList.add("active");
      }
    </script>
</body>
</html>