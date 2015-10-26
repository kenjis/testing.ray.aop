<?php

use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;

class EverydayBlocker implements MethodInterceptor
{
    public function invoke(MethodInvocation $invocation)
    {
        throw new RuntimeException(
            $invocation->getMethod()->getName() . " not allowed every day!"
        );
    }
}
