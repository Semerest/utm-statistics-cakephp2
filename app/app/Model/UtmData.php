<?php

class UtmData extends AppModel
{
    public $useTable = 'utm_data';

    /**
     * Build grouped UTM tree with pagination by unique source.
     *
     * Pagination is applied to unique source values, not raw rows.
     *
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getGroupedTree($page, $limit)
    {
        $page = max(1, (int)$page);
        $limit = max(1, (int)$limit);

        $sourceNames = $this->getPaginatedSources($page, $limit);

        if (empty($sourceNames)) {
            return array();
        }

        $rows = $this->find('all', array(
            'fields' => array(
                'UtmData.source',
                'UtmData.medium',
                'UtmData.campaign',
                'UtmData.content',
                'UtmData.term',
            ),
            'conditions' => array(
                'UtmData.source' => $sourceNames,
            ),
            'order' => array(
                'UtmData.source' => 'ASC',
                'UtmData.medium' => 'ASC',
                'UtmData.campaign' => 'ASC',
                'UtmData.content' => 'ASC',
                'UtmData.term' => 'ASC',
            ),
            'recursive' => -1,
        ));

        return $this->buildTree($rows);
    }

    /**
     * Return current page of unique source values.
     *
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getPaginatedSources($page, $limit)
    {
        $offset = ($page - 1) * $limit;

        $rows = $this->find('all', array(
            'fields' => array(
                'DISTINCT UtmData.source',
            ),
            'order' => array(
                'UtmData.source' => 'ASC',
            ),
            'limit' => $limit,
            'offset' => $offset,
            'recursive' => -1,
        ));

        $sources = array();

        foreach ($rows as $row) {
            $sources[] = $row['UtmData']['source'];
        }

        return $sources;
    }

    /**
     * Count unique source values.
     *
     * @return int
     */
    public function countSources()
    {
        return (int)$this->find('count', array(
            'fields' => 'DISTINCT UtmData.source',
            'recursive' => -1,
        ));
    }

    /**
     * Build nested tree from flat UTM rows.
     *
     * @param array $rows
     * @return array
     */
    protected function buildTree($rows)
    {
        $tree = array();

        foreach ($rows as $row) {
            $item = $row['UtmData'];

            $source = $item['source'];
            $medium = $item['medium'];
            $campaign = $item['campaign'];
            $content = $this->formatNullableValue($item['content']);
            $term = $this->formatNullableValue($item['term']);

            $tree[$source][$medium][$campaign][$content][] = $term;
        }

        return $tree;
    }

    /**
     * Convert database NULL values to visible NULL label.
     *
     * @param string|null $value
     * @return string
     */
    protected function formatNullableValue($value)
    {
        return $value === null ? 'NULL' : $value;
    }
}