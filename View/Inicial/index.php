<?php
    include VIEW . "/Includes/header.php";
    include VIEW . "/Includes/navbar.php";
?>
    <!-- BANNER -->
    <section class="py-5 text-center">

        <div class="container py-5">

            <h1 class="display-4 fw-bold">
                Soluções em Tecnologia
            </h1>

            <p class="lead text-secondary mt-3">
                Tecnologia simples, eficiente e preparada para o seu negócio.
            </p>

            <a href="#servicos" class="btn btn-dark btn-lg mt-3">
                Conheça nossos serviços
            </a>

        </div>

    </section>


    <!-- SERVIÇOS -->
    <section id="servicos" class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    Nossos Serviços
                </h2>

                <p class="text-secondary">
                    Soluções tecnológicas para apoiar o crescimento da sua empresa.
                </p>

            </div>


            <div class="row g-4 justify-content-center">

                <!-- CARD 1 -->
                <div class="col-md-4">

                    <div class="card h-100 shadow-sm">

                        <div class="card-body p-4">

                            <h3 class="card-title">
                                Desenvolvimento
                            </h3>

                            <p class="card-text text-secondary">
                                Desenvolvimento de sistemas e aplicações
                                para empresas.
                            </p>

                            <a href="#" class="btn btn-outline-dark">
                                Saiba mais
                            </a>

                        </div>

                    </div>

                </div>


                <!-- CARD 2 -->
                <div class="col-md-4">

                    <div class="card h-100 shadow-sm">

                        <div class="card-body p-4">

                            <h3 class="card-title">
                                Consultoria
                            </h3>

                            <p class="card-text text-secondary">
                                Consultoria em tecnologia e soluções
                                digitais.
                            </p>

                            <a href="#" class="btn btn-outline-dark">
                                Saiba mais
                            </a>

                        </div>

                    </div>

                </div>


                <!-- CARD 3 -->
                <div class="col-md-4">

                    <div class="card h-100 shadow-sm">

                        <div class="card-body p-4">

                            <h3 class="card-title">
                                Suporte
                            </h3>

                            <p class="card-text text-secondary">
                                Suporte técnico e manutenção de sistemas.
                            </p>

                            <a href="#" class="btn btn-outline-dark">
                                Saiba mais
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <?php
   include VIEW . "/Includes/footer.php";
?>