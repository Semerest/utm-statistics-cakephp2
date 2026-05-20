<?php

class UtmData extends AppModel
{
    public $useTable = 'utm_data';

    /**
     * Build grouped UTM tree with pagination by unique source.
     *
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getGroupedTree($page, $limit)
    {
        $page = max(1, (int)$page);
        $limit = max(1, (int)$limit);
        $offset = ($page - 1) * $limit;

        $sources = $this->query("
            SELECT DISTINCT source
            FROM utm_data
            ORDER BY source
            LIMIT {$limit}
            OFFSET {$offset}
        ");

        $sourceNames = array();

        foreach ($sources as $row) {
            $sourceNames[] = $row['utm_data']['source'];
        }

        $tree = array();

        if (empty($sourceNames)) {
            return $tree;
        }

        $quotedSources = array();

        foreach ($sourceNames as $sourceName) {
            $quotedSources[] = "'" . addslashes($sourceName) . "'";
        }

        $rows = $this->query("
            SELECT source, medium, campaign, content, term
            FROM utm_data
            WHERE source IN (" . implode(',', $quotedSources) . ")
            ORDER BY source, medium, campaign, content, term
        ");

        foreach ($rows as $row) {
            $item = $row['utm_data'];

            $source = $item['source'];
            $medium = $item['medium'];
            $campaign = $item['campaign'];
            $content = $item['content'] === null ? 'NULL' : $item['content'];
            $term = $item['term'] === null ? 'NULL' : $item['term'];

            $tree[$source][$medium][$campaign][$content][] = $term;
        }

        return $tree;
    }
}