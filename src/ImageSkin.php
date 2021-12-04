<?php

declare (strict_types=1);

namespace ShockedPlot7560\minecraftskin;

use GdImage;

class ImageSkin {

    /**
     * @var GdImage $image
     */
    private $image;

    public function __construct(GdImage $image) {
        $this->image = $image;
    }

    /**
     * @return GdImage
     */
    public function getImage(): GdImage {
        return $this->image;
    }

    /**
     * @return array [width, height]
     */
    public function getSize(): array {
        list($width, $height) = getimagesizefromstring($this->getImageString());
        return [$width, $height];
    }

    /**
     * @return int
     */
    public function getWidth(): int {
        return $this->getSize()[0];
    }

    /**
     * @return int
     */
    public function getHeight(): int {
        return $this->getSize()[1];
    }

    /**
     * @return array [width, height]
     */
    public function getGridProportion(): array {
        if ($this->getHeight() == $this->getWidth()) {
            return [
                (int) round($this->getWidth() / 8),
                (int) round($this->getHeight() / 8)
            ];
        } else {
            return [
                (int) round($this->getWidth() / 8),
                (int) round($this->getHeight() / 4)
            ];
        }
    }

    /**
     * @return int The width divided by 8 rounded
     */
    public function getWidthProportion(): int {
        return $this->getGridProportion()[0];
    }

    /**
     * @return int The height divided by 8 rounded
     */
    public function getHeightProportion(): int {
        return $this->getGridProportion()[1];
    }

    /**
     * @return string
     */
    public function getImageString(): string {
        ob_start();
        imagepng($this->getImage());
        $data = ob_get_contents();
        ob_get_clean();
        return $data;
    }
}