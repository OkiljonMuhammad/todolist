<?php

namespace Modules\Items\Http\Contracts\Status;

interface RestoreItemInterface
{
    public function execute(string $id);
    
}