<h1>UTM Statistics</h1>

<?php if (empty($tree)): ?>
    <p>No UTM data found.</p>
<?php endif; ?>

<?php foreach ($tree as $source => $mediums): ?>

    <div class="utm-source">

        <div class="utm-source-title">
            <?php echo h($source); ?>
        </div>

        <?php foreach ($mediums as $medium => $campaigns): ?>

            <div class="utm-level utm-medium">
                <strong><?php echo h($medium); ?></strong>
            </div>

            <?php foreach ($campaigns as $campaign => $contents): ?>

                <div class="utm-level utm-campaign">
                    <?php echo h($campaign); ?>
                </div>

                <?php foreach ($contents as $content => $terms): ?>

                    <div class="utm-level utm-content">
                        Content: <?php echo h($content); ?>
                    </div>

                    <?php foreach ($terms as $term): ?>

                        <div class="utm-level utm-term">
                            Term: <?php echo h($term); ?>
                        </div>

                    <?php endforeach; ?>

                <?php endforeach; ?>

            <?php endforeach; ?>

        <?php endforeach; ?>

    </div>

<?php endforeach; ?>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
    <?php endif; ?>

    <span>
        Page <?php echo h($page); ?> of <?php echo h($totalPages); ?>
    </span>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Next</a>
    <?php endif; ?>
</div>