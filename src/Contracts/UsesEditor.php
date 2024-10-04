<?php

namespace JamesDordoy\HTMLable\Contracts;

interface UsesEditor
{
    public function getRootEditorElement(): string;

    public function getEditableElements(): array;
}
