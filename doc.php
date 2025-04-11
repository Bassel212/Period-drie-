<?php include_once('./header.php'); ?>

    <section class="hero is-primary is-bold">  <!-- Changed from is-info to is-primary -->
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-1">
                    Documentatie
                </h1>
                <h2 class="subtitle is-4">
                    Alles wat u moet weten over onze producten en diensten
                </h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    <aside class="menu">
                        <p class="menu-label">
                            Algemene documentatie
                        </p>
                        <ul class="menu-list">
                            <li><a href="#getting-started" class="is-active">Aan de slag</a></li>
                            <li><a href="#installation">Installatie</a></li>
                            <li><a href="#configuration">Configuratie</a></li>
                        </ul>
                        <p class="menu-label">
                            Geavanceerde onderwerpen
                        </p>
                        <ul class="menu-list">
                            <li><a href="#api">API Referentie</a></li>
                            <li><a href="#troubleshooting">Probleemoplossing</a></li>
                            <li><a href="#faq">Veelgestelde vragen</a></li>
                        </ul>
                    </aside>
                </div>

                <div class="column is-9">
                    <div class="content box" id="getting-started">
                        <h2 class="title is-2">Aan de slag</h2>
                        <p>
                            Welkom bij onze documentatie. Deze gids helpt u snel op weg met onze producten.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan, metus ultrices eleifend gravida,
                            nulla nunc varius lectus, nec rutrum justo nibh eu lectus.
                        </p>
                        <h3 class="title is-3 mt-5">Basisvereisten</h3>
                        <ul>
                            <li>PHP 7.4 of hoger</li>
                            <li>MySQL 5.7 of MariaDB 10.2</li>
                            <li>Composer voor dependency management</li>
                        </ul>
                    </div>

                    <div class="content box mt-6" id="installation">
                        <h2 class="title is-2">Installatie</h2>
                        <p>
                            Volg deze stappen om ons product te installeren:
                        </p>
                        <div class="mt-4">
                            <pre><code class="language-bash">composer require onze/package
php artisan vendor:publish --provider="Onze\PackageServiceProvider"</code></pre>
                        </div>
                        <div class="notification is-primary mt-4">  <!-- Changed from is-info to is-primary -->
                            <strong>Tip:</strong> Zorg ervoor dat u alle vereisten hebt geïnstalleerd voordat u begint met de installatie.
                        </div>
                    </div>

                    <div class="content box mt-6" id="configuration">
                        <h2 class="title is-2">Configuratie</h2>
                        <p>
                            Na installatie moet u enkele basisconfiguraties instellen:
                        </p>
                        <h3 class="title is-3 mt-4">Omgevingsvariabelen</h3>
                        <p>
                            Bewerk het .env bestand in uw projectroot:
                        </p>
                        <pre><code class="language-env">ONZE_API_KEY=uw_api_sleutel_hier
ONZE_ENV=production</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section is-primary">  <!-- Changed from has-background-light to is-primary -->
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-8 has-text-centered">
                    <h2 class="title is-2 has-text-white">Hulp nodig?</h2>  <!-- Added has-text-white -->
                    <p class="subtitle is-4 has-text-white">  <!-- Added has-text-white -->
                        Ons supportteam staat voor u klaar als u aanvullende hulp nodig hebt.
                    </p>
                    <a href="contact.php" class="button is-light is-medium mt-4">Contacteer support</a>  <!-- Changed from is-info to is-light -->
                </div>
            </div>
        </div>
    </section>

<?php include_once('./footer.php'); ?>