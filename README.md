# phpstan-crash
Repository for reproducing issue reported in https://github.com/phpstan/phpstan/discussions/9098

To reproduce the issue, `cd` in the project directory and run the command

`phpstan.phar analyse ./phpstan_crash.php`

It should result in an error stating:

```
Internal error: Internal error: Call to protected method AGEws_Loader_ClassMap::load() from scope PHPStan\Reflection\BetterReflection\SourceLocator\AutoloadSourceLocator in file /root/phpstan_crash.php
```

The full stack trace should look like this:

```
Uncaught Error: Call to protected method AGEws_Loader_ClassMap::load() from scope PHPStan\Reflection\BetterReflection\SourceLocator\AutoloadSourceLocator in phar:///full/path/omitted/phpstan.phar/src/Reflection/BetterReflection/SourceLocator/AutoloadSourceLocator.php:277
#0 phar:///full/path/omitted/phpstan.phar/src/Reflection/BetterReflection/SourceLocator/FileReadTrapStreamWrapper.php(62): PHPStan\Reflection\BetterReflection\SourceLocator\AutoloadSourceLocator::PHPStan\Reflection\BetterReflection\SourceLocator\{closure}()
#1 phar:///full/path/omitted/phpstan.phar/src/Reflection/BetterReflection/SourceLocator/AutoloadSourceLocator.php(271): PHPStan\Reflection\BetterReflection\SourceLocator\FileReadTrapStreamWrapper::withStreamWrapperOverride(Object(Closure))
#2 phar:///full/path/omitted/phpstan.phar/src/Reflection/BetterReflection/SourceLocator/AutoloadSourceLocator.php(119): PHPStan\Reflection\BetterReflection\SourceLocator\AutoloadSourceLocator->locateClassByName('Autoloaded_Clas...')
#3 phar:///full/path/omitted/phpstan.phar/vendor/ondrejmirtes/better-reflection/src/SourceLocator/Type/AggregateSourceLocator.php(26): PHPStan\Reflection\BetterReflection\SourceLocator\AutoloadSourceLocator->locateIdentifier(Object(PHPStan\BetterReflection\Reflector\DefaultReflector), Object(PHPStan\BetterReflection\Identifier\Identifier))
#4 phar:///full/path/omitted/phpstan.phar/vendor/ondrejmirtes/better-reflection/src/SourceLocator/Type/MemoizingSourceLocator.php(33): PHPStan\BetterReflection\SourceLocator\Type\AggregateSourceLocator->locateIdentifier(Object(PHPStan\BetterReflection\Reflector\DefaultReflector), Object(PHPStan\BetterReflection\Identifier\Identifier))
#5 phar:///full/path/omitted/phpstan.phar/vendor/ondrejmirtes/better-reflection/src/Reflector/DefaultReflector.php(32): PHPStan\BetterReflection\SourceLocator\Type\MemoizingSourceLocator->locateIdentifier(Object(PHPStan\BetterReflection\Reflector\DefaultReflector), Object(PHPStan\BetterReflection\Identifier\Identifier))
#6 phar:///full/path/omitted/phpstan.phar/src/Reflection/BetterReflection/Reflector/MemoizingReflector.php(45): PHPStan\BetterReflection\Reflector\DefaultReflector->reflectClass('Autoloaded_Clas...')
#7 phar:///full/path/omitted/phpstan.phar/src/Reflection/BetterReflection/BetterReflectionProvider.php(149): PHPStan\Reflection\BetterReflection\Reflector\MemoizingReflector->reflectClass('Autoloaded_Clas...')
#8 phar:///full/path/omitted/phpstan.phar/src/Reflection/ReflectionProvider/MemoizingReflectionProvider.php(35): PHPStan\Reflection\BetterReflection\BetterReflectionProvider->hasClass('Autoloaded_Clas...')
#9 phar:///full/path/omitted/phpstan.phar/src/Analyser/MutatingScope.php(3202): PHPStan\Reflection\ReflectionProvider\MemoizingReflectionProvider->hasClass('Autoloaded_Clas...')
#10 phar:///full/path/omitted/phpstan.phar/src/Analyser/MutatingScope.php(1083): PHPStan\Analyser\MutatingScope->exactInstantiation(Object(PhpParser\Node\Expr\New_), 'Autoloaded_Clas...')
#11 phar:///full/path/omitted/phpstan.phar/src/Analyser/MutatingScope.php(556): PHPStan\Analyser\MutatingScope->resolveType('new \\Autoloaded...', Object(PhpParser\Node\Expr\New_))
#12 phar:///full/path/omitted/phpstan.phar/src/Analyser/MutatingScope.php(742): PHPStan\Analyser\MutatingScope->getType(Object(PhpParser\Node\Expr\New_))
#13 phar:///full/path/omitted/phpstan.phar/src/Analyser/MutatingScope.php(556): PHPStan\Analyser\MutatingScope->resolveType('$ok = new \\Auto...', Object(PhpParser\Node\Expr\Assign))
#14 phar:///full/path/omitted/phpstan.phar/src/Analyser/NodeScopeResolver.php(1465): PHPStan\Analyser\MutatingScope->getType(Object(PhpParser\Node\Expr\Assign))
#15 phar:///full/path/omitted/phpstan.phar/src/Analyser/NodeScopeResolver.php(559): PHPStan\Analyser\NodeScopeResolver->findEarlyTerminatingExpr(Object(PhpParser\Node\Expr\Assign), Object(PHPStan\Analyser\MutatingScope))
#16 phar:///full/path/omitted/phpstan.phar/src/Analyser/NodeScopeResolver.php(331): PHPStan\Analyser\NodeScopeResolver->processStmtNode(Object(PhpParser\Node\Stmt\Expression), Object(PHPStan\Analyser\MutatingScope), Object(Closure), Object(PHPStan\Analyser\StatementContext))
#17 phar:///full/path/omitted/phpstan.phar/src/Analyser/FileAnalyser.php(175): PHPStan\Analyser\NodeScopeResolver->processNodes(Array, Object(PHPStan\Analyser\MutatingScope), Object(Closure))
#18 phar:///full/path/omitted/phpstan.phar/src/Analyser/Analyser.php(72): PHPStan\Analyser\FileAnalyser->analyseFile('/mnt/c/Users/mt...', Array, Object(PHPStan\Rules\LazyRegistry), Object(PHPStan\Collectors\Registry), NULL)
#19 phar:///full/path/omitted/phpstan.phar/src/Command/AnalyserRunner.php(62): PHPStan\Analyser\Analyser->analyse(Array, Object(Closure), Object(Closure), true, Array)
#20 phar:///full/path/omitted/phpstan.phar/src/Command/AnalyseApplication.php(209): PHPStan\Command\AnalyserRunner->runAnalyser(Array, Array, Object(Closure), Object(Closure), true, true, NULL, Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Input\ArgvInput))
#21 phar:///full/path/omitted/phpstan.phar/src/Command/AnalyseApplication.php(102): PHPStan\Command\AnalyseApplication->runAnalyser(Array, Array, true, NULL, Object(PHPStan\Command\Symfony\SymfonyOutput), Object(PHPStan\Command\Symfony\SymfonyOutput), Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Input\ArgvInput))
#22 phar:///full/path/omitted/phpstan.phar/src/Command/AnalyseCommand.php(190): PHPStan\Command\AnalyseApplication->analyse(Array, true, Object(PHPStan\Command\Symfony\SymfonyOutput), Object(PHPStan\Command\Symfony\SymfonyOutput), true, true, NULL, NULL, Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Input\ArgvInput))
#23 phar:///full/path/omitted/phpstan.phar/vendor/symfony/console/Command/Command.php(259): PHPStan\Command\AnalyseCommand->execute(Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Input\ArgvInput), Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Output\ConsoleOutput))
#24 phar:///full/path/omitted/phpstan.phar/vendor/symfony/console/Application.php(870): _PHPStan_cbfb23d84\Symfony\Component\Console\Command\Command->run(Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Input\ArgvInput), Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Output\ConsoleOutput))
#25 phar:///full/path/omitted/phpstan.phar/vendor/symfony/console/Application.php(261): _PHPStan_cbfb23d84\Symfony\Component\Console\Application->doRunCommand(Object(PHPStan\Command\AnalyseCommand), Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Input\ArgvInput), Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Output\ConsoleOutput))
#26 phar:///full/path/omitted/phpstan.phar/vendor/symfony/console/Application.php(157): _PHPStan_cbfb23d84\Symfony\Component\Console\Application->doRun(Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Input\ArgvInput), Object(_PHPStan_cbfb23d84\Symfony\Component\Console\Output\ConsoleOutput))
#27 phar:///full/path/omitted/phpstan.phar/bin/phpstan(124): _PHPStan_cbfb23d84\Symfony\Component\Console\Application->run()
#28 phar:///full/path/omitted/phpstan.phar/bin/phpstan(125): _PHPStan_cbfb23d84\{closure}()
#29 /full/path/omitted/phpstan.phar(6): require('phar:///root/sc...')
#30 {main}
```