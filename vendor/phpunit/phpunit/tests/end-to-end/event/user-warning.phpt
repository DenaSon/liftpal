--TEST--
The right events are emitted in the right order for a test that runs code which triggers E_USER_WARNING
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--debug';
$_SERVER['argv'][] = __DIR__ . '/_files/UserWarningTest.php';

require __DIR__ . '/../../bootstrap.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
--EXPECTF--
PHPUnit Started (PHPUnit %s using %s)
Test Runner Configured
Test Suite Loaded (2 tests)
Event Facade Sealed
Test Runner Started
Test Suite Sorted
Test Runner Execution Started (2 tests)
Test Suite Started (PHPUnit\TestFixture\Event\UserWarningTest, 2 tests)
Test Preparation Started (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarning)
Test Prepared (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarning)
Assertion Succeeded (Constraint: is true, Value: true)
Test Triggered Warning (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarning)
message
Test Passed (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarning)
Test Finished (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarning)
Test Preparation Started (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarningErrorGetLast)
Test Prepared (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarningErrorGetLast)
Assertion Succeeded (Constraint: is null, Value: null)
Test Triggered Warning (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarningErrorGetLast)
message
Assertion Succeeded (Constraint: is of type array, Value: Array &0 [
    'type' => 512,
    'message' => 'message',
    'file' => '%s%e_files%eUserWarningTest.php',
    'line' => %d,
])
Test Passed (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarningErrorGetLast)
Test Finished (PHPUnit\TestFixture\Event\UserWarningTest::testUserWarningErrorGetLast)
Test Suite Finished (PHPUnit\TestFixture\Event\UserWarningTest, 2 tests)
Test Runner Execution Finished
Test Runner Finished
PHPUnit Finished (Shell Exit Code: 0)
