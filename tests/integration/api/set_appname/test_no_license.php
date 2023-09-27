<?php
/*
 * Copyright 2020 New Relic Corporation. All rights reserved.
 * SPDX-License-Identifier: Apache-2.0
 */

/*DESCRIPTION
Test that newrelic_set_appname works with one parameter.
*/

/*EXPECT
ok - newrelic_set_appname just appname
*/

/*EXPECT_METRICS
[
  "?? agent run id",
  "?? timeframe start",
  "?? timeframe stop",
  [
    [{"name":"DurationByCaller/Unknown/Unknown/Unknown/Unknown/all"}, [1, "??", "??", "??", "??", "??"]],
    [{"name":"DurationByCaller/Unknown/Unknown/Unknown/Unknown/allOther"}, [1, "??", "??", "??", "??", "??"]],
    [{"name":"OtherTransaction/all"},                    [1, "??", "??", "??", "??", "??"]],
    [{"name":"OtherTransaction/php__FILE__"},            [1, "??", "??", "??", "??", "??"]],
    [{"name":"OtherTransactionTotalTime"},               [1, "??", "??", "??", "??", "??"]],
    [{"name":"OtherTransactionTotalTime/php__FILE__"},   [1, "??", "??", "??", "??", "??"]],
    [{"name":"see_me"},                                  [1, 1, 1, 1, 1, 1]],
    [{"name":"Supportability/api/custom_metric"},        [1, 0, 0, 0, 0, 0]],
    [{"name":"Supportability/api/set_appname/after"},    [1, 0, 0, 0, 0, 0]],
    [{"name":"Supportability/Logging/Forwarding/PHP/enabled"}, [1, "??", "??", "??", "??", "??"]],
    [{"name":"Supportability/Logging/Metrics/PHP/enabled"}, [1, "??", "??", "??", "??", "??"]],
    [{"name":"Supportability/Logging/LocalDecorating/PHP/disabled"}, [1, "??", "??", "??", "??", "??"]]
  ]
]
*/


require_once(realpath(dirname(__FILE__)) . '/../../../include/tap.php');

$appname = ini_get("newrelic.appname");

newrelic_custom_metric('ignore_me', 1e+3);
$result = newrelic_set_appname($appname);
tap_assert($result, 'newrelic_set_appname just appname');

newrelic_custom_metric('see_me', 1e+3);
