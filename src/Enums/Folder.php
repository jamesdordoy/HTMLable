<?php

namespace JamesDordoy\HTMLable\Enums;

enum Folder: string
{
    case DOT = '.';
    case DOUBLEDOT = '..';

    public static function isFolder(string $path): bool
    {
        return $path != self::DOT->value && $path != self::DOUBLEDOT->value;
    }
}
