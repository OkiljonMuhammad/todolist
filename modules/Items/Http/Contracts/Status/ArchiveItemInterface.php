<?php

namespace Modules\Items\Http\Contracts\Status;

interface ArchiveItemInterface
{
    public function execute(string $id);
    
}