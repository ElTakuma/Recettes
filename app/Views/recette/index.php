
<button type="button" class="button button-green" onclick="window.location='/recette/new'">Crée une recette</button>

<ul>
    <?php
    if (!empty($recettes) && is_array($recettes)):
        foreach ($recettes as $recette): ?>
        <li>
            <a href="/recette/<?= esc($recette['id'], 'url') ?>">
                <?= esc($recette['titre']) ?>
            </a>
        </li>
        <?php endforeach; ?>
    <div style="display: flex; flex-wrap: wrap; align-content: space-between; margin-top: 15px">
        <div style="margin: auto">
            <?= $pager->links() ?>
        </div>
    </div>
    <?php endif; ?>
</ul>
