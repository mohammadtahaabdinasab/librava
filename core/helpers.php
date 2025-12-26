<?php
function __(string $key, array $replace = []): string
{
    return \Core\Lang::t($key, $replace);
}
