<?php

namespace RlPWA\Services;


class MetaService
{
    public function render($appName = 'app')
    {
        return "<?php \$config = (new \RlPWA\Services\ManifestService)->generate($appName); echo \$__env->make( 'RlPWA::meta' , ['config' => \$config])->render(); ?>";
    }

}
