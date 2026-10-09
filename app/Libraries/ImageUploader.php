<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Files\UploadedFile;

/**
 * Validates, stores, and prepares uploaded images for display.
 * Used by both product images and staff avatars so the logic lives in one place.
 */
class ImageUploader
{
    private const DISPLAY_SIZE = 300; // pixels, square

    /** @param string $subfolder folder inside public/uploads, e.g. "products" or "avatars" */
    public function __construct(private string $subfolder)
    {
    }

    /** Validation rules for an optional image field: JPG/PNG only, max 2 MB. */
    public static function rules(string $field): array
    {
        return [
            'rules' => [
                "uploaded[{$field}]",
                "is_image[{$field}]",
                "max_size[{$field},2048]", // KB
                "mime_in[{$field},image/jpeg,image/png]",
                "ext_in[{$field},jpg,jpeg,png]",
            ],
        ];
    }

    /** True when the person actually chose a file (the field is optional). */
    public static function wasSent(?UploadedFile $file): bool
    {
        return $file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE;
    }

    /**
     * Save a validated upload under a random server-side name, crop it to a
     * square thumbnail, delete the previous file, and return the new filename.
     */
    public function store(UploadedFile $file, ?string $previous = null): string
    {
        $dir = $this->directory();
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $name = $file->getRandomName(); // never trust the client's filename
        $file->move($dir, $name);

        // Re-encoding through GD also strips anything unexpected hiding in the file.
        service('image')
            ->withFile($dir . '/' . $name)
            ->fit(self::DISPLAY_SIZE, self::DISPLAY_SIZE, 'center')
            ->save($dir . '/' . $name);

        $this->delete($previous);

        return $name;
    }

    /** Remove a stored file; basename() blocks any path tricks. */
    public function delete(?string $filename): void
    {
        if (empty($filename)) {
            return;
        }

        $path = $this->directory() . '/' . basename($filename);
        if (is_file($path)) {
            unlink($path);
        }
    }

    private function directory(): string
    {
        return rtrim(FCPATH, '/\\') . '/uploads/' . $this->subfolder;
    }
}
