<?php

namespace App\Helpers;

use Imagick;
use ImagickDraw;
use ImagickPixel;

class ImageImagickHelper
{
    private Imagick $image;
    private int $width;
    private int $height;

    public function setBackground(array $background)
    {
        $this->width = $background["width"];
        $this->height = $background["height"];

        $this->image = new Imagick();
        $bgColor = new ImagickPixel("white");

        if ($background["type"] === "color") {
            $bgColor = new ImagickPixel($background["color"]);
        } elseif ($background["type"] === "random_color") {
            $bgColor = new ImagickPixel($background["colors"][rand(0, count($background["colors"]) - 1)]);
        }

        $this->image->newImage($this->width, $this->height, $bgColor);
        $this->image->setImageFormat('png');

        if ($background["type"] === "image") {
            $bg = new Imagick($background["image"]);
            $bg->resizeImage($this->width, $this->height, Imagick::FILTER_LANCZOS, 1);
            $this->image->compositeImage($bg, Imagick::COMPOSITE_OVER, 0, 0);
        }
    }

    public function setExtraData($data)
    {
        foreach ($data as $value) {
            if ($value->type === "text" || $value->type === "random_text") {
                $text = $value->type === "text" ? $value->text : explode(",", $value->text)[rand(0, count(explode(",", $value->text)) - 1)];
                $this->drawText($text, $value);
            } elseif ($value->type === "paragraph") {
                $this->drawParagraph($value);
            } elseif ($value->type === "image") {
                $this->drawImage($value);
            }
        }
    }

    private function drawText(string $text, $value)
    {
        $draw = new ImagickDraw();
        $draw->setFont(public_path(config('paths.fonts') . $value->font));
        $draw->setFontSize($value->font_size);
        $draw->setFillColor(new ImagickPixel($value->text_color));

        $metrics = $this->image->queryFontMetrics($draw, $text);
        $x = $value->text_align === "center" ? ($this->width - $metrics['textWidth']) / 2 : $value->left;
        $y = $value->top;

        $this->image->annotateImage($draw, $x, $y, $value->angle ?? 0, $text);
    }

    private function drawParagraph($value)
    {
        $lines = explode("\n", wordwrap($value->text, 50));
        $font = public_path(config('paths.fonts') . $value->font);
        $y = $value->top;
        $colorIndex = 0;
        $colorArr = !empty($value->text_color_multiline) ? explode(",", $value->text_color_multiline) : [$value->text_color];

        foreach ($lines as $line) {
            $draw = new ImagickDraw();
            $draw->setFont($font);
            $draw->setFontSize($value->font_size);
            $draw->setFillColor(new ImagickPixel($colorArr[$colorIndex % count($colorArr)]));

            $metrics = $this->image->queryFontMetrics($draw, $line);
            $x = $value->text_align === "center" ? ($this->width - $metrics['textWidth']) / 2 : $value->left;
            $this->image->annotateImage($draw, $x, $y, $value->angle ?? 0, $line);
            $y += $metrics['textHeight'] + 5;
            $colorIndex++;
        }
    }

    private function drawImage($value)
    {
        $img = new Imagick($value->add_image ?? config('paths.images.dynamic_data') . $value->image);
        $img->resizeImage($value->width, $value->height, Imagick::FILTER_LANCZOS, 1);

        $x = $value->text_align === "center" ? ($this->width - $value->width) / 2 : $value->left;
        $y = $value->text_align_v === "center" ? ($this->height - $value->height) / 2 : $value->top;

        $this->image->compositeImage($img, Imagick::COMPOSITE_OVER, $x, $y);
    }

    public function setWatermark()
    {
        $wm = new Imagick(config('paths.images.dynamic') . "indiastic_watermark.png");
        $wm->resizeImage(340, 530, Imagick::FILTER_LANCZOS, 1);
        $this->image->compositeImage($wm, Imagick::COMPOSITE_OVER, ($this->width - 340) / 2, ($this->height - 530) / 2);
    }

    public function showImage(bool $download = false)
    {
        header("Content-Type: image/png");
        if ($download) {
            header("Content-Disposition: attachment; filename='gujjuticks-image.png'");
        }
        echo $this->image;
    }

    public function showBase64()
    {
        return base64_encode($this->image->getImageBlob());
    }

    public function saveAsPng(string $fileName = 'text-image', string $location = ''): bool
    {
        $path = rtrim($location, '/') . '/' . $fileName . '.png';
        return $this->image->writeImage($path);
    }

    public function saveAsJpg(string $fileName = 'text-image', string $location = ''): bool
    {
        $path = rtrim($location, '/') . '/' . $fileName . '.jpg';
        $this->image->setImageFormat('jpg');
        return $this->image->writeImage($path);
    }
}
