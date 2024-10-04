<?php

namespace JamesDordoy\HTMLable\Actions\Documents;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use JamesDordoy\HTMLable\Models\Document;
use Spatie\TemporaryDirectory\TemporaryDirectory;
use ZipArchive;

class Import
{
    public function __invoke(string $path, Model $model, bool $validate = true): Document
    {
        $zip = new ZipArchive;

        if (! $zip->open($path, ZipArchive::CREATE) === true) {
            throw new Exception('cannot open zip');
        }

        $document = app(Create::class)($model, pathinfo($zip->filename, PATHINFO_FILENAME), config('htmlable.default_doctype'));
        $indexFileName = config('htmlable.zip_document');

        $temporaryDirectory = (new TemporaryDirectory)->create();
        $extractPath = $temporaryDirectory->path();
        $fullpath = $extractPath.DIRECTORY_SEPARATOR.pathinfo($zip->filename, PATHINFO_FILENAME);

        $zip->extractTo($extractPath);
        $zip->close();

        $this->importAssetFolders($document, $fullpath, config('htmlable.zip_import_assets'));

        if (file_exists("{$fullpath}/{$indexFileName}.html")) {
            $document->parse(file_get_contents("{$fullpath}/{$indexFileName}.html"));
        }

        $temporaryDirectory->delete();

        return $document;
    }

    protected function importAssetFolders(Document $document, string $basePath, array $folders)
    {
        foreach ($folders as $folder) {
            $this->importAssets($document, "{$basePath}/{$folder}");
        }
    }

    protected function importAssets(Document $document, string $assetPath)
    {
        if (! file_exists($assetPath)) {
            return;
        }

        $assetFiles = File::allFiles($assetPath);

        foreach ($assetFiles as $file) {
            if ($this->isImage($file)) {
                $document->addMedia($file->getRealPath())->toMediaCollection('images');
            }
        }
    }

    protected function isImage(string $file): bool
    {
        return preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
    }

    protected function validate(ZipArchive $zip): array
    {
        return [];
    }
}
