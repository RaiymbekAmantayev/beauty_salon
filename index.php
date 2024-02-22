<?php global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";  ?>

<?php
$service = $pdo->prepare("SELECT * FROM service order by id desc LIMIT 4");
$service->execute();
$res_serv = $array = $service->fetchAll(PDO::FETCH_OBJ);

$comments = $pdo->prepare("SELECT c.id, c.text, c.image, s.id as servId, s.title, s.price, u.login FROM comments c INNER JOIN service s ON c.serviceID = s.id INNER JOIN users u ON c.userID = u.id order by id desc LIMIT 3;");
$comments->execute();
$res_comments = $comments->fetchAll(PDO::FETCH_OBJ);
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1">
<title>Beauty Salon Bootstrap HTML5 Template | Webthemez</title>
<link rel="icon" href="favicon.png" type="image/png">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css"> 
<link href="css/font-awesome.css" rel="stylesheet" type="text/css"> 
<link href="css/animate.css" rel="stylesheet" type="text/css">
 
<!--[if lt IE 9]>
    <script src="js/respond-1.1.0.min.js"></script>
    <script src="js/html5shiv.js"></script>
    <script src="js/html5element.js"></script>
<![endif]-->
 
</head>
<body>
 <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
        <div class="active item">
		<div class="caption zoomIn wow animated"> 		 
              <h2>BEAUTY <br/><strong>Сұлулықты барлық нәрседен көруге болады</strong></h2>
              </div>
			  
		<img class="" src="admin/realise/img/slide1.jpg" alt=""></div>
        <div class="item">
		<div class="caption zoomIn wow animated"> 		 			 
              <h2>SPA<br/><strong>Ең жақсы армандар орындалады</strong></h2>
              </div>
			  <img class="" src="admin/realise/img/slide2.jpg" alt=""></div>
        <div class="item">
		<div class="caption zoomIn wow animated"> 		 			
              <h2>HAIR STYLE<br/><strong>Кеш болмай тұрып алыңыз</strong></h2>
             </div><img class="" src="admin/realise/img/slide3.jpg" alt=""></div>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>
</div>

<?php
require "navbar/header.php";
?>

<section id="aboutUs"><!--Aboutus-->
<div class="inner_wrapper about-us aboutUs-container fadeInLeft animated wow">
  <div class="container">
    <h2>Біз туралы</h2>
	<h6>Табиғат пен оның туындыларын сүйетін адам</h6>
    <div class="inner_section">
 <div class="row">
      <div class="col-md-6"> <img class="img-responsive" src="admin/realise/img/about1.png" align=""> </div>
      <div class="col-md-6">
        <h3>Трендтік стильдер</h3>
        <p>Біздің орталықтың табалдырығын аттаған соң, сіз қонақжайлылық пен талғампаз интерьер атмосферасында боласыз. Сабырлы музыканың үні, экзотикалық эфир майларының қалықтаған хош иісі, шамдардың жыпылықтауы және сұлулық пен денсаулықтың таңғажайып рәсімдері сізді қаланың күйбең тірлігінен бәрі сіз үшін және сіз үшін болатын жұмаққа апарады. Бұл үшеуі бір кәсіпорын, мұнда әрбір аумақ – имидж, сұлулық және SPA – бір тұжырымдамада және жоғары деңгейде сақталады.
          Барлық бөлмелер соңғы үлгідегі косметологиялық жабдықтармен, душ кабиналарымен, кондиционермен, жарықты басқару және процедуралардың музыкалық сүйемелдеуімен жабдықталған. Киім ауыстыратын бөлмеде жұмсақ түкті халат пен тәпішке киюге болады.</p> 
         
        <p>Біз өз қонақтарымызға СПА-процедураның тиімді кешеніне, бірегей массаж әдістеріне, сондай-ақ эстетикалық косметология саласындағы соңғы әзірлемелерге негізделген денеге, бетке, қолдар мен аяқтарға күтім жасау қызметтерінің теңдестірілген пакетін ұсынамыз. Аппараттық құралдардың, қолмен және инъекциялық әдістердің үйлесімі, жан-жақты, эстетикалық және сауықтыру әсерін қамтамасыз ететін жоғары сапалы өнімдерді пайдалану.
          Процедураларды аяқтағаннан кейін сіз «релаксация бөлмесінде» демалуға болады. 
									</p>

									<ul class="about-us-list">
										<li class="points">Біздің орталықта сонымен қатар тәжірибелі тырнақ сервисінің мамандары, шаш стилисттерінің шығармашылық тобы және тамаша макияж мамандары жұмыс істейді.</li> 
                                        <li class="points">BEAUTY & SPA CENTER Қазақстан Республикасының танымал жобаларына белсенді қатысады, мысалы: X-Factor, Star Factory, Karaoke Killer, Voice of Kazakhstan және т.б. </li>
										<li class="points">Табысты салон табысты адамдарға арналған!!!</li>
									</ul><!-- /.about-us-list -->
								 
      </div>
    </div>
	     </div>
  </div> 
  </div>
</section>
<!--Aboutus--> 


<!--Service-->
<section  id="service">
  <div class="container">
    <h2>Біздің қызметтер</h2>
	<h6>Қызметтердің бағалары</h6>
    <a class="service_wrapper">
      <div class="row">
          <?php foreach($res_serv as $serv):?>
        <div class="col-md-3">
            <a href="detail.php?id=<?php echo $serv->id; ?>" class="black-link">
            <img style=" width: 80%; height: 70%; border-radius: 5%" src="admin/realise/img/<?php echo $serv->image?>" class="card-img-top" alt="...">
          <div class="service_block">
            <h3 class="animated fadeInUp wow"><?php echo $serv->title?></h3>
            <p class="animated fadeInDown wow">
               </p>
          </div>
          </a>
        </div>
          <?php endforeach; ?>
      </div>
        <a style="margin-left:90%" href="service_view.php"><button class="btn btn-outline-primary">Показать больше</button></a>
    </div>
  </div>
</section>
<!--Service-->
 <section id="experience">
     <div class="container">
         <section id="news" class="white-bg padding-top-bottom">
             <div class="section-title">
                 <h2>Отзывы</h2>
             </div>
             <section id="carousel">
                 <div style="margin-top: 5%; height: 200px" class="container">
                     <div class="row">
                         <div class="col-md-8 col-md-offset-2">
                             <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                                 <!-- Carousel indicators -->
                                 <!-- Carousel items -->
                                 <div class="carousel-inner">
                                     <?php foreach(array_chunk($res_comments, 4) as $key => $chunk): ?>
                                         <div class="carousel-item <?php echo ($key === 0) ? 'active ' : ''; ?>">
                                             <div class="row">
                                                 <?php foreach($chunk as $com): ?>
                                                     <div class="col-md-4">
                                                         <div class="profile-circle">
                                                             <a href="/detail.php?id=<?php echo $com->servId; ?>#<?php echo $com->id; ?>" class="black-link">
                                                                 <img class="profile-circle"  src="admin/realise/img/<?php echo $com->image; ?>"></div>
                                                         </a>
                                                         <blockquote>
                                                             <h3><?php echo $com->login; ?></h3>
                                                             <p><?php echo $com->text; ?></p>
                                                         </blockquote>
                                                     </div>
                                                 <?php endforeach; ?>
                                             </div>

                                     <?php endforeach; ?>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </section>
         </section>
     </div>
 </section>


<!--Footer-->
 <?php
 require "navbar/footer.php";
 ?>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-scrolltofixed.js"></script>
<script type="text/javascript" src="js/jquery.nav.js"></script> 
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.isotope.js"></script>
<script src="js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script> 
<script type="text/javascript" src="js/wow.js"></script> 
<script type="text/javascript" src="js/custom.js"></script>

</body>
</html>

