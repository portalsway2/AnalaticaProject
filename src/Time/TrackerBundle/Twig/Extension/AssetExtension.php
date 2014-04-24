<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 4/5/14
 * Time: 3:13 PM
 */

namespace Time\TrackerBundle\Twig\Extension;


use Symfony\Component\HttpFoundation\File\File;

class AssetExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'image64' => new \Twig_Function_Method($this, 'image64'),
        );
    }

    public function image64($path)
    {
        $file = new File($path, false);

        if (!$file->isFile() || 0 !== strpos($file->getMimeType(), 'image/')) {
            return;
        }

        $binary = file_get_contents($path);

        return sprintf('data:image/%s;base64,%s', $file->guessExtension(), base64_encode($binary));
    }

    public function getName()
    {
        return 'demo_asset';
    }
}

