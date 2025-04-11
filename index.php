<?php include_once('./header.php'); ?>

    <section class="hero is-primary is-bold is-medium">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title is-1">
                    Welkom op onze website
                </h1>
                <h2 class="subtitle is-3">
                    Wij bieden de beste digitale oplossingen
                </h2>
                <div class="buttons is-centered mt-5">
                    <a href="#features" class="button is-light is-large">Ontdek meer</a>
                    <a onclick="showComingSoon()" class="button is-outlined is-light is-large">Neem contact op</a>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-8 has-text-centered">
                    <h2 class="title is-2 mb-6">Onze diensten</h2>
                </div>
            </div>

            <div class="columns is-multiline">
                <div class="column is-one-third">
                    <div class="box has-text-centered p-5 feature-box">
          <span class="icon is-large has-text-primary">
            <i class="fas fa-rocket fa-3x"></i>
          </span>
                        <h3 class="title is-4 mt-4">Snelle oplossingen</h3>
                        <p>Wij bieden snelle en effectieve technische oplossingen voor uw bedrijf.</p>
                        <button onclick="showComingSoon()" class="button is-small is-primary mt-3">Meer details</button>
                    </div>
                </div>

                <div class="column is-one-third">
                    <div class="box has-text-centered p-5 feature-box">
          <span class="icon is-large has-text-primary">
            <i class="fas fa-lock fa-3x"></i>
          </span>
                        <h3 class="title is-4 mt-4">Veilig en beveiligd</h3>
                        <p>Onze oplossingen voldoen aan de hoogste beveiligingsstandaarden.</p>
                        <button onclick="showComingSoon()" class="button is-small is-primary mt-3">Meer details</button>
                    </div>
                </div>

                <div class="column is-one-third">
                    <div class="box has-text-centered p-5 feature-box">
          <span class="icon is-large has-text-primary">
            <i class="fas fa-headset fa-3x"></i>
          </span>
                        <h3 class="title is-4 mt-4">Complete technische ondersteuning</h3>
                        <p>Ons ondersteuningsteam staat 24/7 voor u klaar.</p>
                        <button onclick="showComingSoon()" class="button is-small is-primary mt-3">Meer details</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section is-light">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-half">
                    <h2 class="title is-2">Over ons</h2>
                    <p class="is-size-5">
                        Wij zijn een team van toegewijde professionals die innovatieve digitale oplossingen bieden. Wij geloven dat technologie voor iedereen toegankelijk moet zijn en werken hard om uw ervaring met ons bijzonder te maken.
                    </p>
                    <button onclick="showComingSoon()" class="button is-primary is-medium mt-4">Meer over ons</button>
                </div>
                <div class="column is-half">
                    <figure class="image is-16by9">
                        <img src="images/about-us.jpg" alt="Ons team" class="has-rounded-corners">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-8 has-text-centered">
                    <h2 class="title is-2 mb-6">Wat onze klanten zeggen</h2>

                    <div class="testimonials">
                        <div class="testimonial box p-5">
                            <div class="content">
                                <p class="is-italic is-size-5">
                                    "Dit team heeft ons geholpen ons idee te realiseren. De service was uitstekend en de technische ondersteuning was snel en effectief."
                                </p>
                                <div class="author mt-4">
                                    <p class="has-text-weight-bold">Ahmed Mohamed</p>
                                    <p class="has-text-grey">Directeur van Tech Company</p>
                                </div>
                            </div>
                        </div>
                        <button onclick="showComingSoon()" class="button is-primary mt-4">Meer testimonials</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section is-primary">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-8 has-text-centered">
                    <h2 class="title is-2 has-text-white">Klaar om te beginnen?</h2>
                    <p class="subtitle is-4 has-text-white">Neem vandaag nog contact met ons op voor een gratis consult</p>
                    <button onclick="showComingSoon()" class="button is-light is-large mt-4">Contacteer ons nu</button>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" id="comingSoonModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Binnenkort beschikbaar</p>
                <button class="delete" aria-label="close" onclick="closeModal()"></button>
            </header>
            <section class="modal-card-body">
                <div class="content has-text-centered">
                    <span class="icon is-large has-text-primary">
                        <i class="fas fa-cog fa-spin fa-3x"></i>
                    </span>
                    <h3 class="title is-3 mt-4">Deze functie komt binnenkort!</h3>
                    <p>We werken hard aan deze nieuwe functionaliteit en zullen deze zo snel mogelijk beschikbaar maken.</p>
                    <p>Bedankt voor uw geduld en begrip.</p>
                </div>
            </section>
            <footer class="modal-card-foot is-justify-content-center">
                <button class="button is-primary" onclick="closeModal()">Begrepen</button>
            </footer>
        </div>
    </div>

    <script>
        function showComingSoon() {
            document.getElementById('comingSoonModal').classList.add('is-active');
        }

        function closeModal() {
            document.getElementById('comingSoonModal').classList.remove('is-active');
        }
    </script>

<?php include_once('./footer.php'); ?>