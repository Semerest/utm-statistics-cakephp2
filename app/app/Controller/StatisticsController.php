<?php

class StatisticsController extends AppController
{
    public $uses = array('UtmData');

    public function utm_list()
    {
        $page = max(1, (int)$this->request->query('page'));
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $sources = $this->UtmData->query("
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

        if (!empty($sourceNames)) {
            $quotedSources = array();

            foreach ($sourceNames as $sourceName) {
                $quotedSources[] = "'" . addslashes($sourceName) . "'";
            }

            $rows = $this->UtmData->query("
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
        }

        $this->set(compact('tree', 'page'));
    }
}