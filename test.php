<?php

require __DIR__ . '/vendor/autoload.php';

use Ray\Aop\Pointcut;
use Ray\Aop\Matcher;
use Ray\Aop\Bind;
use Ray\Aop\Compiler;

$pointcut = new Pointcut(
    (new Matcher)->any(),
    (new Matcher)->annotatedWith(BlockEveryDay::class),
    [new EverydayBlocker()]
);

$bind = (new Bind)->bind(NotRelatedService::class, [$pointcut]);

$tmpDir = __DIR__ . '/tmp';
$compiler = (new Compiler($tmpDir));
$billing = $compiler->newInstance(RealBillingService::class, [], $bind);

try {
    echo $billing->chargeOrder()  . "\n";
} catch (RuntimeException $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
