<?php

declare (strict_types=1);

namespace ShockedPlot7560\minecraftskin;

use GdImage;
use InvalidArgumentException;

class Skin {

    /**
     * @var string $imagePath
     */
    private $imagePath;

    /**
     * @var ImageSkin|null $image
     */
    private $image;


    /**
     * @param string $image The image path
     */
    public function __construct(string $image) {
        if (!is_file($image)) {
            throw new InvalidArgumentException();
        }
        $this->imagePath = $image;
        $this->image = $this->generateImage($this->imagePath);
    }

    public function getGdImage(): GdImage {
        return $this->getImage()->getImage();
    }

    public function getImage(): ?ImageSkin {
        return $this->image;
    }

    public function getSkin(): GdImage {
        return $this->getGdImage();
    }

    public function getHead(): GdImage {
        $image = $this->getImage();

        $canva = $this->generateTransparent($image->getWidthProportion(), $image->getHeightProportion());

        imagecopyresampled(
            $canva, 
            $this->getGdImage(), 
            0, 
            0, 
            $image->getWidthProportion() * 1, 
            $image->getHeightProportion() * 1, 
            $image->getWidthProportion(), 
            $image->getHeightProportion(),
            $image->getWidthProportion(),
            $image->getHeightProportion()
        );

        // TODO: Add support to simple skin : without second layer
        imagecopyresampled(
            $canva, 
            $this->getGdImage(), 
            0, 
            0, 
            $image->getWidthProportion() * 5, 
            $image->getHeightProportion() * 1, 
            $image->getWidthProportion(), 
            $image->getHeightProportion(),
            $image->getWidthProportion(),
            $image->getHeightProportion()
        );

        return $canva;
    }

    public function getBody(): GdImage {
        $image = $this->getImage();

        $widthProportion = $image->getWidthProportion();
        $heightProportion = $image->getHeightProportion();

        $canva = $this->generateTransparent($widthProportion * 2, $heightProportion * 4);
        $head = $this->getHead();

        imagecopyresampled($canva, $head, (int)($widthProportion * 0.5), 0, 0, 0, $widthProportion, $widthProportion, $widthProportion, $widthProportion);

        //TODO: add support to simple skin : without second layer

        //body base
        imagecopyresampled($canva, $image->getImage(), (int)($widthProportion * 0.5), $heightProportion, (int)($widthProportion * 2.5), (int)($heightProportion * 2.5), $widthProportion, (int)($heightProportion * 1.5), $widthProportion, (int)($heightProportion * 1.5));
        //second layer
        imagecopyresampled($canva, $image->getImage(), (int)($widthProportion * 0.5), $heightProportion, (int)($widthProportion * 2.5), (int)($heightProportion * 4.5), $widthProportion, (int)($heightProportion * 1.5), $widthProportion, (int)($heightProportion * 1.5));

        // left arm
        imagecopyresampled($canva, $image->getImage(), (int)($widthProportion * 1.5), $heightProportion, (int)($widthProportion * 4.5), (int)($heightProportion * 6.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5));
        // second layer
        imagecopyresampled($canva, $image->getImage(), (int)($widthProportion * 1.5), $heightProportion, (int)($widthProportion * 6.5), (int)($heightProportion * 6.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5));

        // right arm
        imagecopyresampled($canva, $image->getImage(), 0, $heightProportion, (int)($widthProportion * 5.5), (int)($heightProportion * 2.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5));
        // second layer
        imagecopyresampled($canva, $image->getImage(), 0, $heightProportion, (int)($widthProportion * 5.5), (int)($heightProportion * 4.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5));

        // right leg
        imagecopyresampled($canva, $image->getImage(), $widthProportion, (int)($heightProportion * 2.5), (int)($widthProportion * 0.5), (int)($heightProportion * 2.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5));
        // second layer
        imagecopyresampled($canva, $image->getImage(), $widthProportion, (int)($heightProportion * 2.5), (int)($widthProportion * 0.5), (int)($heightProportion * 6.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5));

        // left leg
        imagecopyresampled($canva, $image->getImage(), (int)($widthProportion * 0.5), (int)($heightProportion * 2.5), (int)($widthProportion * 2.5), (int)($heightProportion * 6.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5));
        // second layer
        imagecopyresampled($canva, $image->getImage(), (int)($widthProportion * 0.5), (int)($heightProportion * 2.5), (int)($widthProportion * 0.5), (int)($heightProportion * 4.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5), (int)($widthProportion * 0.5), (int)($heightProportion * 1.5));

        return $canva;
    }

    /**
     * @param string $path
     * 
     * @return ImageSkin
     */
    protected function generateImage(string $path): ImageSkin {
        $imageData = file_get_contents($path);
        $image = imagecreatefromstring($imageData);
        imagesavealpha($image, true);
        if ($image === false) {
            throw new InvalidArgumentException();
        }
        return new ImageSkin($image);
    }

    /**
     * @param int $width
     * @param int $height
     * 
     * @return GdImage A transparent image with dimension given
     */
    protected function generateTransparent(int $width, int $height): GdImage {
        $canva = imagecreatetruecolor($width, $height);

        imagealphablending($canva, true);
        imagesavealpha($canva, true);

        $tranparent = imagecolorallocatealpha($canva, 255, 255, 255, 127);
        imagefill($canva, 0, 0, $tranparent);

        return $canva;
    }
}