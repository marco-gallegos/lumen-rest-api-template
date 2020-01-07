<?php

namespace App\Transformers;

use App\Authorization;
use League\Fractal\TransformerAbstract;

class AuthorizationTransformer extends TransformerAbstract
{
    public function transform(Authorization $authorization)
    {
        return $authorization->toArray();
    }
}
