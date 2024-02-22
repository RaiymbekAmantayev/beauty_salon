<!--Header_section-->
<header id="header_wrapper">
    <div class="container">
        <div class="header_box">
            <!--<div class="logo"><a href="#">Resume</a></div>-->
            <nav class="navbar navbar-inverse" role="navigation">
<!--                <div class="navbar-header">-->
<!--                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">-->
<!--                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>-->
<!--                </div>-->
                <div id="main-nav" class="collapse navbar-collapse navStyle">
                    <ul class="nav navbar-nav">
                        <?php
                        session_start();
                        if (isset($_SESSION['login']) && !empty($_SESSION['login']) && $_SESSION['login'] != 'admin') {
                            ?>
                            <li class="active">
                                <a href="/#carousel" class="scroll-link">Үйге</a>
                            </li>
                            <li>
                                <a href="/my_signs.php" class="scroll-link">Менің тіркелімім</a>
                            </li>
                            <li>
                                <a href="/#service" class="scroll-link">Қызметтер</a>
                            </li>
                            <li>
                                <a href="/#experience" class="scroll-link">Пікірлер</a>
                            </li>
                            <li>
                                <a href="/#contact" class="scroll-link">Байланысу</a>
                            </li>
                            <li>
                                <a href="/auth/logout.php">Шығу</a>
                            </li>
                            <?php
                        } else if(isset($_SESSION['login']) && $_SESSION['login'] === 'admin') {
                            ?>
                            <li class="active">
                                <a href="/#carousel" class="scroll-link">Үйге</a>
                            </li>
                            <li>
                                <a href="/admin/addService_form.php">Қызметтерді қосу</a>
                            </li>
                            <li>
                                <a href="/admin/employeers_view.php">Қызметкерлер</a>
                            </li>
                            <li>
                                <a href="/admin/consultation_view.php">Өтінімдер</a>
                            </li>
                            <li>
                                <a href="/admin/zapis_view.php">Тіркелімдер</a>
                            </li>
                            <li>
                                <a href="/auth/logout.php">Шығу</a>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li>
                                <a href="/auth/Login.php">Кіру</a>
                            </li>
                            <li>
                                <a href="/auth/SignUp.php">Тіркелу</a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!--Header_section-->