<style>
    .title-lev1{
        margin-bottom: 10px;
        margin-top: 10px;
        font-size: 20px;
    }
    .title-lev2{
        margin-bottom: 7px;
        margin-top: 7px;
        font-size: 15px;
    }
</style>
<?php
//    if (isset($success)) {
//        print_r($success);
//    }
?>
<div style="margin-left: 50px; margin-top: 60px; margin-bottom: 60px; width: 50%">
    <ul style="list-style-type: none; font-weight: bolder; ">
        <li class="title-lev1">Ingredients</li>
        <ul style="list-style-type: circle; font-weight: normal">
            <?php if ($ingredients): ?>
            <?php foreach ($ingredients as $ingredient): ?>
            <li class="title-lev2">
                <?php echo $ingredient['quantite'] . '  ' . $ingredient['nom'] ?>
                <button type="button" class="button button-red" style="padding: 1px; border-radius: 20px" onclick="confirmationIngredient(<?= $ingredient['id'] ?>)"> x </button>
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <br>
        <li class="title-lev1">Preparation</li>
            <li style="font-weight: normal"><?php print_r( $recette['instructions'])?></li>
        </li>
    </ul>
        <div style="margin-top: 50px; margin-left: 15px">
            <button type="button" onclick="window.location='/recette'" class="button button-black">Retour</button>
            <a href="/recette/<?php echo $recette['id'] ?>/edit" class="button button-blue">Modifier</a>
            <button type="submit" class="button button-red" onclick="confirmation(<?= $recette['id'] ?>)">Supprimer</button>
        </div>
</div>
<script>
    function confirmation(id) {
        if (confirm("Vous êtes sur le point de supprimer une recètte") === true) {
            window.location='/recette/delete/' + id ;
        }
    }

    function confirmationIngredient(id) {
        if (confirm("Vous êtes sur le point de supprimer un ingrdient") === true) {
            window.location='/recette/delete_ingredient/' + id ;
        }
    }
</script>