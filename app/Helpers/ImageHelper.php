<?php

namespace App\Helpers;

class ImageHelper
{
    private $image;
    private $height;
    private $width;

    function setBackground($background)
    {
        $this->image = imagecreatetruecolor($background["width"], $background["height"]);
        $this->height = $background["height"];
        $this->width = $background["width"];
        if ($background["type"] == "color") {
            $backgroundColor = $this->hexToRGB($background["color"]);
            $backgroundColor = imagecolorallocate($this->image, $backgroundColor['r'], $backgroundColor['g'], $backgroundColor['b']);
            imagefilledrectangle($this->image, 0, 0, $background["width"] - 1, $background["height"] - 1, $backgroundColor);
        } else if ($background["type"] == "image") {
            $backgroundImage = imagecreatefromstring(file_get_contents($background["image"]));
            imagecopy($this->image, $backgroundImage, 0, 0, 0, 0, $background["width"], $background["height"]);
        } else if ($background["type"] == "random_color") {
            $backgroundColor = $this->hexToRGB($background["colors"][rand(0, count($background["colors"]) - 1)]);
            $backgroundColor = imagecolorallocate($this->image, $backgroundColor['r'], $backgroundColor['g'], $backgroundColor['b']);
            imagefilledrectangle($this->image, 0, 0, $background["width"] - 1, $background["height"] - 1, $backgroundColor);
        }
        return true;
    }

    function setExtraData($data)
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if ($value->type == "text") {
                    $font = str_replace('\\', '/', public_path(config('paths.fonts') . $value->font));
                    $textColor = $this->hexToRGB($value->text_color);
                    $textColor = imagecolorallocatealpha($this->image, $textColor['r'], $textColor['g'], $textColor['b'], $value->opacity);
                    if ($value->text_align == "center") {
                        $textBox = imagettfbbox($value->font_size, $value->angle, $font, $value->text);
                        $textWidth = abs(max($textBox[2], $textBox[4]));
                        $left = (imagesx($this->image) - $textWidth) / 2;
                    } else {
                        $left = $value->left;
                    }
                    imagettftext($this->image, $value->font_size, $value->angle, $left, $value->top, $textColor, $font, $value->text);
                } else if ($value->type == "paragraph") {
                    $colorArr = array();
                    if (trim($value->text_color_multiline) != "") {
                        $colorArr = explode(",", $value->text_color_multiline);
                    }
                    $font = str_replace('\\', '/', public_path(config('paths.fonts') . $value->font));
                    $textColor = $this->hexToRGB($value->text_color);
                    $textColor = imagecolorallocatealpha($this->image, $textColor['r'], $textColor['g'], $textColor['b'], $value->opacity);

                    $maxWidth = $value->width; // max width for a line
                    $wrappedLines = [];

                    // Split by \n first, then wrap each line
                    $manualLines = explode("\n", $value->text);
                    foreach ($manualLines as $manualLine) {
                        $words = explode(" ", $manualLine);
                        $line = '';
                        foreach ($words as $word) {
                            $testLine = $line . ' ' . $word;
                            $testBox = imagettfbbox($value->font_size, $value->angle, $font, trim($testLine));
                            $testWidth = abs($testBox[2] - $testBox[0]);

                            if ($testWidth > $maxWidth && $maxWidth > 0 && $line != '') {
                                $wrappedLines[] = trim($line);
                                $line = $word;
                            } else {
                                $line = $testLine;
                            }
                        }
                        $wrappedLines[] = trim($line);
                    }

                    $left = $value->left;
                    $top = $value->top;
                    $keyToSet = 0;
                    $spaceBetweenLines = 15;
                    $lines = count($wrappedLines);

                    foreach ($wrappedLines as $keyTxt => $txt) {
                        if (!empty($colorArr)) {
                            if ($keyToSet == count($colorArr)) {
                                $keyToSet = 0;
                            }
                            $textColor = $this->hexToRGB($colorArr[$keyToSet]);
                            $textColor = imagecolorallocatealpha($this->image, $textColor['r'], $textColor['g'], $textColor['b'], $value->opacity);
                            $keyToSet++;
                        }

                        $textBox = imagettfbbox($value->font_size, $value->angle, $font, $txt);
                        $textWidth = abs(max($textBox[2], $textBox[4]));
                        $textHeight = abs(max($textBox[5], $textBox[7]));

                        // Horizontal align
                        if ($value->text_align == "center") {
                            $x = (imagesx($this->image) - $textWidth) / 2;
                        } else {
                            $x = $value->left;
                        }

                        // Vertical align
                        if ($value->text_align_v == "center") {
                            $y = (((imagesy($this->image) + $textHeight) / 2) - (($value->font_size + $spaceBetweenLines) * $lines)) + ($value->font_size * (count($wrappedLines) / 2)) + (count($wrappedLines) * $spaceBetweenLines);
                        } else {
                            $y = $top;
                        }

                        $lines = $lines - 1;
                        imagettftext($this->image, $value->font_size, $value->angle, $x, $y, $textColor, $font, $txt);
                        $top = $top + $textHeight + 20;
                    }
                } else if ($value->type == "image") {
                    $im_location = isset($value->add_image) ? $value->add_image : config('paths.images.dynamic_data') . $value->image;
                    $dataImage = imagecreatefromstring(file_get_contents($im_location));
                    $left = ($value->text_align == "center") ? (($this->width / 2) - ($value->width / 2)) : $value->left;
                    $top = ($value->text_align_v == "center") ? (($this->height / 2) - ($value->height / 2)) : $value->top;
                    imagecopy($this->image, $dataImage, $left, $top, 0, 0, $value->width, $value->height);
                } else if ($value->type == "random_text") {
                    $text = explode(",", $value->text);
                    $text = $text[rand(0, (count($text) - 1))];

                    $font = str_replace('\\', '/', public_path(config('paths.fonts') . $value->font));
                    $textColor = $this->hexToRGB($value->text_color);
                    $textColor = imagecolorallocatealpha($this->image, $textColor['r'], $textColor['g'], $textColor['b'], $value->opacity);
                    if ($value->text_align == "center") {
                        $textBox = imagettfbbox($value->font_size, $value->angle, $font, $text);
                        $textWidth = abs(max($textBox[2], $textBox[4]));
                        $left = (imagesx($this->image) - $textWidth) / 2;
                    } else {
                        $left = $value->left;
                    }
                    imagettftext($this->image, $value->font_size, $value->angle, $left, $value->top, $textColor, $font, $text);
                } else {
                }
            }
        }
        return true;
    }

    function setWatermark()
    {
        $im_location = config('paths.images.dynamic') . "indiastic_watermark.png";
        $imHeight = 530;
        $imWidth = 340;
        $dataImage = imagecreatefromstring(file_get_contents($im_location));
        imagecopy($this->image, $dataImage, ($this->width / 2) - ($imWidth / 2), ($this->height / 2) - ($imHeight / 2), 0, 0, $imWidth, $imHeight);
    }

    function hexToRGB($colour)
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return array('r' => $r, 'g' => $g, 'b' => $b);
    }

    function showImage($download = false, $data = [])
    {
        if (empty($data)) {
            $data = $_GET;
        }
        if (!empty($data)) {
            $download = (isset($data['download']) && $data['download'] == '1') ? rand(10000, 99999) . "-GujjuTicks-" . rand(00000, 99999) : false;
        }
        if ((isset($data['width']) && $data['width'] <= $this->width) && (isset($data['height']) && $data['height'] <= $this->height)) {
            $this->image = imagescale($this->image, $data['width'], $data['height']);
        }
        header('Content-Type: image/jpg');
        if ($download) {
            header('Content-Disposition: attachment; filename="' . $download . '.jpg"');
        }
        return imagejpeg($this->image);
    }

    function showBase64()
    {
        ob_start();
        imagejpeg($this->image);
        $buffer = ob_get_clean();
        ob_end_clean();
        return base64_encode($buffer);
    }

    function saveAsPng($fileName = 'text-image', $location = '')
    {
        $fileName = $fileName . ".png";
        $fileName = !empty($location) ? $location . $fileName : $fileName;
        return imagepng($this->image, $fileName);
    }

    function saveAsJpg($fileName = 'text-image', $location = '')
    {
        $fileName = $fileName . ".jpg";
        $fileName = !empty($location) ? $location . $fileName : $fileName;
        return imagejpeg($this->image, $fileName);
    }
}
