<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use EasyCorp\Bundle\EasyAdminBundle\EasyAdminBundle;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
