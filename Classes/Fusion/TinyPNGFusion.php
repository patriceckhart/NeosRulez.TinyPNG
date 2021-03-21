<?php
namespace NeosRulez\TinyPNG\Fusion;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class TinyPNGFusion extends AbstractFusionObject {

    /**
     * @var array
     */
    protected $settings;

    /**
     * @param array $settings
     * @return void
     */
    public function injectSettings(array $settings) {
        $this->settings = $settings;
    }

    /**
     * @return void
     */
    public function evaluate() {
        $imageUri = $this->fusionValue('imageUri');
        if($imageUri) {
            $relativeUri = parse_url($imageUri);
            \Tinify\setKey($this->settings['apiKey']);
            \Tinify\fromFile(rawurldecode(constant('FLOW_PATH_ROOT') . 'Web' . $relativeUri['path']))->toFile(rawurldecode(constant('FLOW_PATH_ROOT') . 'Web' . $relativeUri['path']));
        }
    }

}
