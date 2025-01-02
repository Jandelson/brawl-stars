<?php

namespace App\Services;

use App\Contracts\BrawlDataCombinedInterface;

class BrawDataCombinedService implements BrawlDataCombinedInterface
{
    private $brawlsMerge;
    public function setDataCombined(array $data1, array $data2): array
    {
        $this->brawlsMerge = [];
        if (!empty($data1) and !empty($data2)) {
            foreach($data1 as $objectData1) {
                foreach($data2 as $objectData2) {
                    if ($objectData1->id == $objectData2->id) {
                        $this->brawlsMerge[$objectData1->id] = array_merge(
                            (array) $objectData2, (array) $objectData1
                        );
                    }
                }
            }
        }
        return $this->brawlsMerge;
    }
    public function getDataCombined(): array
    {
        return $this->brawlsMerge;
    }
}
