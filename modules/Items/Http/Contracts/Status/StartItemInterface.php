<?php

namespace Modules\Items\Http\Contracts\Status;

interface StartItemInterface
{
    public function execute(string $id);
    
}