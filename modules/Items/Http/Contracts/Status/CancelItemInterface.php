<?php

namespace Modules\Items\Http\Contracts\Status;

interface CancelItemInterface
{
    public function execute(string $id);
    
}