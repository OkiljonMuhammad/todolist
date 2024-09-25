<?php

namespace Modules\Items\Http\Contracts\Status;

interface CompleteItemInterface
{
    public function execute(string $id);
    
}