<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerVfovuPi\srcApp_KernelProdContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerVfovuPi/srcApp_KernelProdContainer.php') {
    touch(__DIR__.'/ContainerVfovuPi.legacy');

    return;
}

if (!\class_exists(srcApp_KernelProdContainer::class, false)) {
    \class_alias(\ContainerVfovuPi\srcApp_KernelProdContainer::class, srcApp_KernelProdContainer::class, false);
}

return new \ContainerVfovuPi\srcApp_KernelProdContainer([
    'container.build_hash' => 'VfovuPi',
    'container.build_id' => 'c0b0e1b7',
    'container.build_time' => 1587903207,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerVfovuPi');
