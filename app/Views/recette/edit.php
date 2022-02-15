<style>

</style>
<form action="/recette/update/<?php echo $recette['id'] ?>" method="post">
    <?php csrf_field() ?>

    <div style="margin: 4%;">
        <label for="titre" class="label" style="margin-bottom: 15px">
            <span>Titre</span>
            <input type="text" name="titre" class="text-form" value="<?php echo $recette['titre'] ?>">
        </label>
        <br><br>
        <label for="slug" class="label" style="margin-bottom: 15px">
            <span>Slug</span>
            <input type="text" name="slug" class="text-form" value="<?php echo $recette['slug'] ?>">
        </label>
<br><br>
        <p class="label">Ingredients</p>
        <table style="width: 100% ; border-spacing: 15px;  border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" >
            <thead>
            <th style="width: 5%">#</th>
            <th style="width: 30%">Quantité</th>
            <th>Ingredient</th>
            </thead>
            <tbody>
            <?php
            if ($ingredients):
                $i=-1;
                $h = 0;
                foreach ($ingredients as $ingredient):
                    $i++;
                    $h++;
                    ?>
                    <tr>
                        <td style="text-align: center; font-weight: bold"><?php echo $h ?></td>
                        <td>
                            <label for="quantite" style="margin-bottom: 15px">
                                <input type="hidden" name="id_<?php echo $i ?>" class="text-form" value="<?php echo $ingredient['id'] ?>">
                                <input type="text" name="quantite_<?php echo $i ?>" class="text-form" value="<?php echo $ingredient['quantite'] ?>">
                            </label>
                        </td>
                        <td>
                            <label for="nom" style="margin-bottom: 15px">
                                <input type="text" name="nom_<?php echo $i ?>" class="text-form" value="<?php echo $ingredient['nom'] ?>">
                            </label>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>

            <?php
            $j = count($ingredients);
            if ($j<8):
                for ($k = $i+1; $k<7; $k++):
                    ?>
                    <tr>
                        <td style="text-align: center; font-weight: bold"><?php echo $k+1 ?></td>
                        <td>
                            <label for="quantite" style="margin-bottom: 15px">
<!--                                <input type="hidden" name="id_--><?php //echo $h ?><!--" class="text-form">-->
                                <input type="text" name="quantite_<?php echo $k ?>" class="text-form">
                            </label>
                        </td>
                        <td>
                            <label for="nom" style="margin-bottom: 15px">
                                <input type="text" name="nom_<?php echo $k ?>" class="text-form">
                            </label>
                        </td>
                    </tr>
                <?php endfor; endif;?>
            </tbody>
        </table>
        <br><br>
        <p class="label">Préparation</p>
        <label for="instructions" style="margin-bottom: 15px">
        <textarea name="instructions" class="text-form" style="height: 250px; padding: 10px">
            <?php echo $recette['instructions'] ?>
        </textarea>
        </label>
        <div style="margin-top: 50px; margin-left: 15px">
            <button type="button" onclick="window.history.back()" class="button button-black">Retour</button>
            <button type="submit" class="button button-blue">Sauvegarder</button>
        </div>
    </div>
</form>