<h1>UTM Statistics</h1>
<?php if (empty($tree)): ?>
    <p>No UTM data found.</p>
<?php endif; ?>
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

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
    <?php endif; ?>

    <span>Page <?php echo h($page); ?></span>

    <a href="?page=<?php echo $page + 1; ?>">Next</a>
</div>