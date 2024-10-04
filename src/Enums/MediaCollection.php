<?php

namespace JamesDordoy\HTMLable\Enums;

enum MediaCollection: string
{
    case ASSETS = 'assets';
    case SCRIPTS = 'scripts';
    case STYLES = 'styles';
    case DOWNLOADS = 'downloads';
}
