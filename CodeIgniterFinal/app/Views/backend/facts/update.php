<section>
    <h2><?= esc($title) ?></h2>

    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors() ?>

    <form action="<?= base_url('admin/createFact')?>" method="post" <!-- enctype="multipart/form-data"-->
    <?= csrf_field() ?>

    <label for="facts">Facts</label>
    <input type="input" name="fact_text" value="<?= set_value('fact_text') ?>" size="100">
    <br>

    <label for="wonders">Wonder:</label>
    <select name="wonder_id">
        <?php if ($wonders !== []): ?>
            <?php foreach($wonders as $wonder_item) : ?>
                <option value="<?= esc($wonder_item['id'])?>">
                    <?= $wonder_item['wonder']?>
                </option>
            <?php endforeach ?>
        <?php endif ?>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Create new fact">
    </form>
</section>