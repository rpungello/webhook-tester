<?php

namespace App\Support;

use Symfony\Component\HttpFoundation\Request;
use Vectorface\Whip\Request\RequestAdapter;

class SymfonyRequestAdapter implements RequestAdapter
{
    public function __construct(protected Request $request)
    {
    }

    /**
     * @inheritDoc
     */
    public function getRemoteAddr(): ?string
    {
        return $this->request->getClientIp();
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        $headers = [];
        foreach ($this->request->headers->all() as $name => $value) {
            $headers[$name] = implode(',', $value);
        }
        return $headers;
    }
}
