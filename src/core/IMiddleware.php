<?php

namespace Core;

interface IMiddleware{
    public function handle(mixed $request, callable $next);
}