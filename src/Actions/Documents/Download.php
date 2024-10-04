<?php

namespace JamesDordoy\HTMLable\Actions\Documents;

use JamesDordoy\HTMLable\Enums\Folder;
use JamesDordoy\HTMLable\Models\Document;
use Spatie\TemporaryDirectory\TemporaryDirectory;
use ZipArchive;

class Download
{
    public function __invoke(Document $document): string
    {
        $temporaryDirectory = (new TemporaryDirectory)->create();

        $tempPath = $temporaryDirectory->path();

        $htmlContent = $document->renderWithLocalPaths();

        $indexFileName = config('htmlable.zip_document');
        $assetsFolderName = config('htmlable.zip_download_asset_folder_name');

        $htmlFilePath = "$tempPath/{$indexFileName}.html";
        file_put_contents($htmlFilePath, $htmlContent);

        $assetsDir = "{$tempPath}/{$assetsFolderName}";
        if (! file_exists($assetsDir)) {
            mkdir($assetsDir, 0755, true);
        }

        foreach ($document->getMedia('images') as $media) {
            $mediaPath = $media->getPath();
            $fileName = $media->file_name;
            copy($mediaPath, $assetsDir.DIRECTORY_SEPARATOR.$fileName);
        }

        $zipFileName = "{$document->name}.zip";
        $zipFilePath = $tempPath.DIRECTORY_SEPARATOR.$zipFileName;

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {

            $zip->addFile($htmlFilePath, "{$indexFileName}.html");

            $files = scandir($assetsDir);
            foreach ($files as $file) {
                if (Folder::isFolder($file)) {
                    $zip->addFile($assetsDir.DIRECTORY_SEPARATOR.$file, "{$assetsFolderName}/".$file);
                }
            }

            $zip->close();
        }

        return $zipFilePath;
    }
}
