<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        
        $loader->load($this->getProjectDir().'/config/services.yaml');
    }
}
?>