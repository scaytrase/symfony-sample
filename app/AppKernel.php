<?php

namespace ScayTrase\Symfony\Sample\Kernel;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use ScayTrase\Symfony\Sample\Blog\BlogBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    /** {@inheritdoc} */
    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new TwigBundle(),
            new DoctrineBundle(),
            new SensioFrameworkExtraBundle(),

            // Source code
            new BlogBundle(),
        ];

        if ('prod' !== $this->getEnvironment()) {
            $bundles[] = new DebugBundle();
            $bundles[] = new WebProfilerBundle();
        }

        return $bundles;
    }

    /** {@inheritdoc} */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
