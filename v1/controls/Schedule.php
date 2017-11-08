<?php
/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/27/2015
 * Time: 10:38 PM
 */

class Schedule {

    public function reminder() {
        $dow = 'saturday';
        $step = 2; //every 2;
        $unit = 'W'; //weeks

        $start = new DateTime('2012-06-02'); //start date
        $end = clone $start;

        $start->modify($dow); // Move to first occurence
        $end->add(new DateInterval('P1Y')); // Move to 1 year from start
        // need to get total number of days in date range for event P{$total}D


        $interval = new DateInterval("P{$step}{$unit}");
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $date) {
            echo $date->format('D, d M Y'), PHP_EOL;
        }
    }
}
