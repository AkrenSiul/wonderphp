<main style="background-color: #dddddd">
    <section>
        <?php $session = session()?>
        <h2><?= esc($title)?></h2>

        <h3>Bienvenid@ <?= $session->get('user')?></h3>
    </section>
</main>
