<style>
    .pagination {
        display: inline-block;
    }

    .pagination li {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #dddddd;
        list-style-type: none;
    }
    .pagination li:hover{
        box-shadow: 0 0 5px 0;
    }

    .pagination li.active {
        background-color: dodgerblue;
        color: white;
        border: 1px solid dodgerblue;
    }

    .pagination li.active:hover {
        /*color: white;*/
    }

    .pagination a:link, .pagination a:visited, .pagination a:hover {
        text-decoration: none;
    }

    .pagination a:hover:not(.active) {background-color: #ddd;}
</style>

<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($pager->hasPrevious()) : ?>
            <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                <li>
                    <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                </li>
            </a>
            <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                <li>
                    <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                </li>
            </a>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <a href="<?= $link['uri'] ?>">
                <li <?= $link['active'] ? 'class="active"' : '' ?>>
                        <?= $link['title'] ?>
                </li>
            </a>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                <li>
                    <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                </li>
            </a>
            <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                <li>
                    <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                </li>
            </a>
        <?php endif ?>
    </ul>
</nav>