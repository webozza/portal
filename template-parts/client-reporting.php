<?php
/**
* Template Name: Client Reporting
*/

get_header();
$user_id = get_current_user_id();
$user_first_name = get_user_meta( $user_id, 'first_name', true ); ?>

<div class="main">
    <div class="greetings">
        <h2><?= get_the_title() ?></h2>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            Last updated Sat Apr 8, 2023 9:17PM
        </div>
        <div class="filters">
            <div class="filter">
                <a href="javascript:void(0)">Weekly</a>
            </div>
            <div class="filter">
                <a href="javascript:void(0)">Monthly</a>
            </div>
            <div class="filter">
                <a href="javascript:void(0)">Custom</a>
            </div>
            <div class="filter">
                <a href="javascript:void(0)">Sort Client</a>
            </div>
        </div>
    </div>
    <div class="cr-table">
        <table>
            <tr>
                <th>Client</th>
                <th>Ad Spend</th>
                <th>Conversions</th>
                <th>CPA</th>
            </tr>
            <tbody>
                <tr>
                    <td>Vyro</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php get_footer();