<?php

class StatisticsController extends AppController
{
    const PAGE_SIZE = 20;

    public $uses = array('UtmData');

    public function utm_list()
    {
        $page = max(1, (int)$this->request->query('page'));

        $tree = $this->UtmData->getGroupedTree($page, self::PAGE_SIZE);
        $totalSources = $this->UtmData->countSources();
        $totalPages = max(1, (int)ceil($totalSources / self::PAGE_SIZE));

        $this->set(compact('tree', 'page', 'totalPages'));
    }
}