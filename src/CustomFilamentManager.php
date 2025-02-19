<?php

namespace DiogoGPinto\FilamentPageContext;

use Filament\FilamentManager;
class CustomFilamentManager extends FilamentManager
{
    public function pageContext(): FilamentPageContext
    {
        return new FilamentPageContext;
    }
}
