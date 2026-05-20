<h1>UTM Statistics</h1>

<?php foreach ($tree as $source => $mediums): ?>

    <div style="margin-bottom: 20px;">

        <h2><?php echo h($source); ?></h2>

        <?php foreach ($mediums as $medium => $campaigns): ?>

            <div style="margin-left: 20px; margin-bottom: 10px;">

                <strong><?php echo h($medium); ?></strong>

                <?php foreach ($campaigns as $campaign => $contents): ?>

                    <div style="margin-left: 20px; margin-top: 5px;">

                        <?php echo h($campaign); ?>

                        <?php foreach ($contents as $content => $terms): ?>

                            <div style="margin-left: 20px;">

                                Content:
                                <?php echo h($content); ?>

                                <?php foreach ($terms as $term): ?>

                                    <div style="margin-left: 20px;">
                                        Term:
                                        <?php echo h($term); ?>
                                    </div>

                                <?php endforeach; ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endforeach; ?>

    </div>

<?php endforeach; ?>

<hr>

<div>
    <a href="?page=<?php echo max(1, $page - 1); ?>">
        Previous
    </a>

    |

    <a href="?page=<?php echo $page + 1; ?>">
        Next
    </a>
</div>