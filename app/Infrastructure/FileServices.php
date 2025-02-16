<?php

namespace App\Infrastructure;

use CodeIgniter\Files\File;

class FileServices
{
    protected string $baseUploadPath;

    protected array $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    protected int $maxFileSize = 5 * 1024 * 1024;

    public function __construct()
    {
        $this->baseUploadPath = ROOTPATH . 'public/uploads/';
    }

    public function saveImage(File $file, string $context = 'general', ?string $customFileName = null): string
    {
        $extension = $file->getExtension();
        if (!in_array(strtolower($extension), $this->allowedImageExtensions)) {
            throw new \RuntimeException("Invalid file type. Allowed types: " . implode(', ', $this->allowedImageExtensions));
        }

        if ($file->getSize() > $this->maxFileSize) {
            throw new \RuntimeException("File size exceeds the allowed limit of " . $this->maxFileSize / 1024 / 1024 . " MB.");
        }

        return $this->moveFile($file, $context, $customFileName);
    }

    public function saveFile(File $file, string $context = 'general', ?string $customFileName = null): string
    {
        return $this->moveFile($file, $context, $customFileName);
    }

    private function moveFile(File $file, string $context, ?string $customFileName = null): string
    {
        $uploadPath = $this->baseUploadPath . $context . '/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileName = $customFileName ? $customFileName : $file->getRandomName();

        if ($file->move($uploadPath, $fileName)) {
            return $fileName;
        }

        throw new \RuntimeException("File upload failed.");
    }

    public function deleteFile(string $fileName, string $context = 'general'): bool
    {
        $filePath = $this->baseUploadPath . $context . '/' . $fileName;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }

    public function isSameFile(File $newFile, string $existingFileName, string $context): bool
    {
        $existingFilePath = $this->baseUploadPath . $context . '/' . $existingFileName;

        if (!file_exists($existingFilePath)) {
            return false;
        }

        return hash_file('md5', $existingFilePath) === md5_file($newFile->getRealPath());
    }

    public function renameFile(string $oldFileName, string $newFileName, string $context): bool
    {
        $oldFilePath = $this->baseUploadPath . $context . '/' . $oldFileName;
        $newFilePath = $this->baseUploadPath . $context . '/' . $newFileName;

        if (!file_exists($oldFilePath)) {
            return false;
        }

        return rename($oldFilePath, $newFilePath);
    }
}
