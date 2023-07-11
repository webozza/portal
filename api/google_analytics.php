<?php
require get_template_directory() . '/vendor/autoload.php';

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

$json_path = get_template_directory() . '/GA4_credentials.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $json_path);

$property_id = array(
    'diabetes_qualified' => '362597853',
    'langley_group_institute' => '382578471'
);
$client = new BetaAnalyticsDataClient();
$week_to_date = date('Y-m-d', strtotime("this week"));
$last_week_start = date('Y-m-d', strtotime("monday last week"));
$last_week_end = date('Y-m-d', strtotime("sunday last week"));
$month_to_date = date('Y-m-d', strtotime("first day of this month"));
$last_month_start = date('Y-m-d', strtotime("first day of last month"));
$last_month_end = date('Y-m-d', strtotime("last day of last month"));
$today = date('Y-m-d', strtotime("today"));

?>
    <script>
        let dates = {
            // WTD
            wtd_first_day: '<?= date('jS M', strtotime("this week")) ?>',
            today : '<?= date('jS M', strtotime("today")) ?>',
            // MTD
            mtd_first_day: '<?= date('jS M', strtotime("first day of this month")) ?>',
        }
    </script>
<?php

if(isset($_POST['custom_date_selector']) == "1") {
    $cds_start = $_POST['start_date'];
    $cds_end = $_POST['end_date'];
    ?>
        <script>
            dates['cds_start'] = "<?= $cds_start ?>";
            dates['cds_end'] = "<?= $cds_end ?>";
        </script>
    <?php
}

/* GOOGLE ADS COST - LGI
================================================================================*/
$LGI_GA_COST_WTD = $client->runReport([
    'property' => 'properties/' . $property_id['langley_group_institute'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $week_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);

$LGI_GA_COST_MTD = $client->runReport([
    'property' => 'properties/' . $property_id['langley_group_institute'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $month_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);

$LGI_GA_COST_LW = $client->runReport([
    'property' => 'properties/' . $property_id['langley_group_institute'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_week_start,
            'end_date' => $last_week_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);

$LGI_GA_COST_LM = $client->runReport([
    'property' => 'properties/' . $property_id['langley_group_institute'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_month_start,
            'end_date' => $last_month_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);

$lgi_ga_cost_wtd = array();
foreach ($LGI_GA_COST_WTD->getRows() as $row) {
    array_push($lgi_ga_cost_wtd, $row->getMetricValues()[0]->getValue() );
}
$lgi_ga_cost_wtd = array_sum($lgi_ga_cost_wtd);

$lgi_ga_cost_mtd = array();
foreach ($LGI_GA_COST_MTD->getRows() as $row) {
    array_push($lgi_ga_cost_mtd, $row->getMetricValues()[0]->getValue() );
}
$lgi_ga_cost_mtd = array_sum($lgi_ga_cost_mtd);

$lgi_ga_cost_lw = array();
foreach ($LGI_GA_COST_LW->getRows() as $row) {
    array_push($lgi_ga_cost_lw, $row->getMetricValues()[0]->getValue() );
}
$lgi_ga_cost_lw = array_sum($lgi_ga_cost_lw);

$lgi_ga_cost_lm = array();
foreach ($LGI_GA_COST_LM->getRows() as $row) {
    array_push($lgi_ga_cost_lm, $row->getMetricValues()[0]->getValue() );
}
$lgi_ga_cost_lm = array_sum($lgi_ga_cost_lm);

/* GOOGLE ADS COST - DQ
================================================================================*/
$DQ_GA_COST_WTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $week_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);
$DQ_GA_COST_MTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $month_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);
$DQ_GA_COST_LW = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_week_start,
            'end_date' => $last_week_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);
$DQ_GA_COST_LM = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_month_start,
            'end_date' => $last_month_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionGoogleAdsAccountName',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'advertiserAdCost'
        ]
    )
    ]
]);

$dq_ga_cost_wtd = array();
foreach ($DQ_GA_COST_WTD->getRows() as $row) {
    array_push($dq_ga_cost_wtd, $row->getMetricValues()[0]->getValue() );
}
$dq_ga_cost_wtd = array_sum($dq_ga_cost_wtd);

$dq_ga_cost_mtd = array();
foreach ($DQ_GA_COST_MTD->getRows() as $row) {
    array_push($dq_ga_cost_mtd, $row->getMetricValues()[0]->getValue() );
}
$dq_ga_cost_mtd = array_sum($dq_ga_cost_mtd);

$dq_ga_cost_lw = array();
foreach ($DQ_GA_COST_LW->getRows() as $row) {
    array_push($dq_ga_cost_lw, $row->getMetricValues()[0]->getValue() );
}
$dq_ga_cost_lw = array_sum($dq_ga_cost_lw);

$dq_ga_cost_lm = array();
foreach ($DQ_GA_COST_LM->getRows() as $row) {
    array_push($dq_ga_cost_lm, $row->getMetricValues()[0]->getValue() );
}
$dq_ga_cost_lm = array_sum($dq_ga_cost_lm);

/* CUSTOM DATE RANGE - DQ
---------------------------------------------------------------------------------*/
if(isset($_POST['custom_date_selector']) == "1") {

    // Ad COST for custom date range
    $DQ_GA_COST_CDS = $client->runReport([
        'property' => 'properties/' . $property_id['diabetes_qualified'],
        'dateRanges' => [
            new DateRange([
                'start_date' => $cds_start,
                'end_date' => $cds_end,
            ]),
        ],
        'dimensions' => [new Dimension(
            [
                'name' => 'sessionGoogleAdsAccountName',
            ]
        ),
        ],
        'metrics' => [new Metric(
            [
                'name' => 'advertiserAdCost'
            ]
        )
        ]
    ]);
    $dq_ga_cost_cds = array();
    foreach ($DQ_GA_COST_CDS->getRows() as $row) {
        array_push($dq_ga_cost_cds, $row->getMetricValues()[0]->getValue() );
    }
    $dq_ga_cost_cds = array_sum($dq_ga_cost_cds);

    if($cds_start != $cds_end) {
        // Budget consumption
        $DQ_GA_COST_CDS_BUDGET = $client->runReport([
            'property' => 'properties/' . $property_id['diabetes_qualified'],
            'dateRanges' => [
                new DateRange([
                    'start_date' => $cds_start,
                    'end_date' => date("Y-m-d", strtotime($cds_end . ' -1 day')),
                ]),
            ],
            'dimensions' => [new Dimension(
                [
                    'name' => 'sessionGoogleAdsAccountName',
                ]
            ),
            ],
            'metrics' => [new Metric(
                [
                    'name' => 'advertiserAdCost'
                ]
            )
            ]
        ]);
        $dq_ga_cost_cds_budget = array();
        foreach ($DQ_GA_COST_CDS_BUDGET->getRows() as $row) {
            array_push($dq_ga_cost_cds_budget, $row->getMetricValues()[0]->getValue() );
        }
        $dq_ga_cost_cds_budget = array_sum($dq_ga_cost_cds_budget);

        $cds_end_less_1;
        if($cds_end == $today) {
            $cds_end_less_1 = date("Y-m-d", strtotime($cds_end . ' -1 day'));
        } else {
            $cds_end_less_1 = $cds_end;
        }

        $start_timestamp = strtotime($cds_start);
        $end_timestamp = strtotime($cds_end_less_1);
        $days_difference = ($end_timestamp - $start_timestamp) / (60 * 60 * 24) + 1;
        $target_spend = $days_difference * 500;
        $target_spend_achieved_cds = ($dq_ga_cost_cds_budget / $target_spend) * 100;
    }

    // New Users for custom date range
    $DQ_VISITORS_CDS = $client->runReport([
        'property' => 'properties/' . $property_id['diabetes_qualified'],
        'dateRanges' => [
            new DateRange([
                'start_date' => $cds_start,
                'end_date' => $cds_end,
            ]),
        ],
        'dimensions' => [new Dimension(
            [
                'name' => 'sessionDefaultChannelGroup',
            ]
        ),
        ],
        'metrics' => [new Metric(
            [
                'name' => 'newUsers'
            ]
        )
        ]
    ]);
    $dq_visitors_cds = array();
    foreach ($DQ_VISITORS_CDS->getRows() as $row) {
        array_push($dq_visitors_cds, $row->getMetricValues()[0]->getValue() );
    }
    $dq_visitors_cds = array_sum($dq_visitors_cds);

    // Conversions for custom date range
    $DQ_CONVERSIONS_CDS = $client->runReport([
        'property' => 'properties/' . $property_id['diabetes_qualified'],
        'dateRanges' => [
            new DateRange([
                'start_date' => $cds_start,
                'end_date' => $cds_end,
            ]),
        ],
        'dimensions' => [new Dimension(
            [
                'name' => 'sessionDefaultChannelGroup',
            ]
        ),
        ],
        'metrics' => [new Metric(
            [
                'name' => 'ecommercePurchases'
            ]
        )
        ]
    ]);
    $dq_conversions_cds = array();
    foreach ($DQ_CONVERSIONS_CDS->getRows() as $row) {
        array_push($dq_conversions_cds, $row->getMetricValues()[0]->getValue() );
    }
    $dq_conversions_cds = array_sum($dq_conversions_cds);

    // Sales for custom date range
    $DQ_SALES_CDS = $client->runReport([
        'property' => 'properties/' . $property_id['diabetes_qualified'],
        'dateRanges' => [
            new DateRange([
                'start_date' => $cds_start,
                'end_date' => $cds_end,
            ]),
        ],
        'dimensions' => [new Dimension(
            [
                'name' => 'sessionDefaultChannelGroup',
            ]
        ),
        ],
        'metrics' => [new Metric(
            [
                'name' => 'purchaseRevenue'
            ]
        )
        ]
    ]);
    
    $dq_sales_cds = array();
    foreach ($DQ_SALES_CDS->getRows() as $row) {
        array_push($dq_sales_cds, $row->getMetricValues()[0]->getValue() );
    }
    $dq_sales_cds = array_sum($dq_sales_cds);

    // PDF Downloads for custom date range
    $DQ_PDF_DOWNLOADS_CDS = $client->runReport([
        'property' => 'properties/' . $property_id['diabetes_qualified'],
        'dateRanges' => [
            new DateRange([
                'start_date' => $cds_start,
                'end_date' => $cds_end,
            ]),
        ],
        'dimensions' => [new Dimension(
            [
                'name' => 'sessionDefaultChannelGroup',
            ]
        ),
        ],
        'metrics' => [new Metric(
            [
                'name' => 'conversions:Downloads'
            ]
        )
        ]
    ]);
    $dq_pdf_downloads_cds = array();
    foreach ($DQ_PDF_DOWNLOADS_CDS->getRows() as $row) {
        array_push($dq_pdf_downloads_cds, $row->getMetricValues()[0]->getValue() );
    }
    $dq_pdf_downloads_cds = array_sum($dq_pdf_downloads_cds);
}

/* CUSTOM DATE RANGE - LGI
---------------------------------------------------------------------------------*/
if(isset($_POST['custom_date_selector']) == "1") {

    // Ad COST for custom date range
    $LGI_GA_COST_CDS = $client->runReport([
        'property' => 'properties/' . $property_id['langley_group_institute'],
        'dateRanges' => [
            new DateRange([
                'start_date' => $cds_start,
                'end_date' => $cds_end,
            ]),
        ],
        'dimensions' => [new Dimension(
            [
                'name' => 'sessionGoogleAdsAccountName',
            ]
        ),
        ],
        'metrics' => [new Metric(
            [
                'name' => 'advertiserAdCost'
            ]
        )
        ]
    ]);
    $lgi_ga_cost_cds = array();
    foreach ($LGI_GA_COST_CDS->getRows() as $row) {
        array_push($lgi_ga_cost_cds, $row->getMetricValues()[0]->getValue() );
    }
    $lgi_ga_cost_cds = array_sum($lgi_ga_cost_cds);

    // New Users for custom date range
    $LGI_VISITORS_CDS = $client->runReport([
        'property' => 'properties/' . $property_id['langley_group_institute'],
        'dateRanges' => [
            new DateRange([
                'start_date' => $cds_start,
                'end_date' => $cds_end,
            ]),
        ],
        'dimensions' => [new Dimension(
            [
                'name' => 'sessionDefaultChannelGroup',
            ]
        ),
        ],
        'metrics' => [new Metric(
            [
                'name' => 'newUsers'
            ]
        )
        ]
    ]);
    $lgi_visitors_cds = array();
    foreach ($LGI_VISITORS_CDS->getRows() as $row) {
        array_push($lgi_visitors_cds, $row->getMetricValues()[0]->getValue() );
    }
    $lgi_visitors_cds = array_sum($lgi_visitors_cds);

    // Conversions for custom date range
    $LGI_CONVERSIONS_CDS = $client->runReport([
        'property' => 'properties/' . $property_id['langley_group_institute'],
        'dateRanges' => [
            new DateRange([
                'start_date' => $cds_start,
                'end_date' => $cds_end,
            ]),
        ],
        'dimensions' => [new Dimension(
            [
                'name' => 'sessionDefaultChannelGroup',
            ]
        ),
        ],
        'metrics' => [new Metric(
            [
                'name' => 'ecommercePurchases'
            ]
        )
        ]
    ]);
    $lgi_conversions_cds = array();
    foreach ($LGI_CONVERSIONS_CDS->getRows() as $row) {
        array_push($lgi_conversions_cds, $row->getMetricValues()[0]->getValue() );
    }
    $lgi_conversions_cds = array_sum($lgi_conversions_cds);

}

/* NEW USERS - DQ
================================================================================*/
$DQ_VISITORS_WTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $week_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$DQ_VISITORS_MTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $month_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$DQ_VISITORS_LW = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_week_start,
            'end_date' => $last_week_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$DQ_VISITORS_LM = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_month_start,
            'end_date' => $last_month_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);

$dq_visitors_wtd = array();
foreach ($DQ_VISITORS_WTD->getRows() as $row) {
    array_push($dq_visitors_wtd, $row->getMetricValues()[0]->getValue() );
}
$dq_visitors_wtd = array_sum($dq_visitors_wtd);

$dq_visitors_mtd = array();
foreach ($DQ_VISITORS_MTD->getRows() as $row) {
    array_push($dq_visitors_mtd, $row->getMetricValues()[0]->getValue() );
}
$dq_visitors_mtd = array_sum($dq_visitors_mtd);

$dq_visitors_lw = array();
foreach ($DQ_VISITORS_LW->getRows() as $row) {
    array_push($dq_visitors_lw, $row->getMetricValues()[0]->getValue() );
}
$dq_visitors_lw = array_sum($dq_visitors_lw);

$dq_visitors_lm = array();
foreach ($DQ_VISITORS_LM->getRows() as $row) {
    array_push($dq_visitors_lm, $row->getMetricValues()[0]->getValue() );
}
$dq_visitors_lm = array_sum($dq_visitors_lm);

/* NEW USERS - LGI
================================================================================*/
$LGI_VISITORS_WTD = $client->runReport([
    'property' => 'properties/' . $property_id['langley_group_institute'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $week_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$LGI_VISITORS_MTD = $client->runReport([
    'property' => 'properties/' . $property_id['langley_group_institute'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $month_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$LGI_VISITORS_LW = $client->runReport([
    'property' => 'properties/' . $property_id['langley_group_institute'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_week_start,
            'end_date' => $last_week_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);
$LGI_VISITORS_LM = $client->runReport([
    'property' => 'properties/' . $property_id['langley_group_institute'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_month_start,
            'end_date' => $last_month_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'newUsers'
        ]
    )
    ]
]);

$lgi_visitors_wtd = array();
foreach ($LGI_VISITORS_WTD->getRows() as $row) {
    array_push($lgi_visitors_wtd, $row->getMetricValues()[0]->getValue() );
}
$lgi_visitors_wtd = array_sum($lgi_visitors_wtd);

$lgi_visitors_mtd = array();
foreach ($LGI_VISITORS_MTD->getRows() as $row) {
    array_push($lgi_visitors_mtd, $row->getMetricValues()[0]->getValue() );
}
$lgi_visitors_mtd = array_sum($lgi_visitors_mtd);

$lgi_visitors_lw = array();
foreach ($LGI_VISITORS_LW->getRows() as $row) {
    array_push($lgi_visitors_lw, $row->getMetricValues()[0]->getValue() );
}
$lgi_visitors_lw = array_sum($lgi_visitors_lw);

$lgi_visitors_lm = array();
foreach ($LGI_VISITORS_LM->getRows() as $row) {
    array_push($lgi_visitors_lm, $row->getMetricValues()[0]->getValue() );
}
$lgi_visitors_lm = array_sum($lgi_visitors_lm);

/* ENROLLMENTS - DQ (LAST WEEK)
================================================================================*/
$DQ_ENROLLMENTS_LW = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_week_start,
            'end_date' => $last_week_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'ecommercePurchases'
        ]
    )
    ]
]);

$dq_enrollments_lw = array();
foreach ($DQ_ENROLLMENTS_LW->getRows() as $row) {
    array_push($dq_enrollments_lw, $row->getMetricValues()[0]->getValue() );
}
$dq_enrollments_lw = array_sum($dq_enrollments_lw);

/* ENROLLMENTS - DQ (LAST MONTH)
================================================================================*/
$DQ_ENROLLMENTS_LM = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_month_start,
            'end_date' => $last_month_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'ecommercePurchases'
        ]
    )
    ]
]);

$dq_enrollments_lm = array();
foreach ($DQ_ENROLLMENTS_LM->getRows() as $row) {
    array_push($dq_enrollments_lm, $row->getMetricValues()[0]->getValue() );
}
$dq_enrollments_lm = array_sum($dq_enrollments_lm);

/* ENROLLMENTS - DQ (WTD)
================================================================================*/
$DQ_ENROLLMENTS_WTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $week_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'ecommercePurchases'
        ]
    )
    ]
]);

$dq_enrollments_wtd = array();
foreach ($DQ_ENROLLMENTS_WTD->getRows() as $row) {
    array_push($dq_enrollments_wtd, $row->getMetricValues()[0]->getValue() );
}
$dq_enrollments_wtd = array_sum($dq_enrollments_wtd);

/* ENROLLMENTS - DQ (MTD)
================================================================================*/
$DQ_ENROLLMENTS_MTD = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $month_to_date,
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'ecommercePurchases'
        ]
    )
    ]
]);

$dq_enrollments_mtd = array();
foreach ($DQ_ENROLLMENTS_MTD->getRows() as $row) {
    array_push($dq_enrollments_mtd, $row->getMetricValues()[0]->getValue() );
}
$dq_enrollments_mtd = array_sum($dq_enrollments_mtd);

/* SALES - DQ (LAST WEEK)
================================================================================*/
$DQ_SALES_LW = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_week_start,
            'end_date' => $last_week_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'purchaseRevenue'
        ]
    )
    ]
]);

$dq_sales_lw = array();
foreach ($DQ_SALES_LW->getRows() as $row) {
    array_push($dq_sales_lw, $row->getMetricValues()[0]->getValue() );
}
$dq_sales_lw = array_sum($dq_sales_lw);

/* SALES - DQ (LAST MONTH)
================================================================================*/
$DQ_SALES_LM = $client->runReport([
    'property' => 'properties/' . $property_id['diabetes_qualified'],
    'dateRanges' => [
        new DateRange([
            'start_date' => $last_month_start,
            'end_date' => $last_month_end,
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionDefaultChannelGroup',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'purchaseRevenue'
        ]
    )
    ]
]);

$dq_sales_lm = array();
foreach ($DQ_SALES_LM->getRows() as $row) {
    array_push($dq_sales_lm, $row->getMetricValues()[0]->getValue() );
}
$dq_sales_lm = array_sum($dq_sales_lm);

?>

<!-- <script>
    disablePreloader();
</script> -->