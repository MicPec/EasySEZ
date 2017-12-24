<?php

namespace app\controllers\utils;

/**
 * Calendar class
 * based on https://github.com/alrik11es/calendar.
 */
class Calendar
{
    private $startDate;
    private $endDate;
    private $year;
    private $month;
    private $events;

    public function __construct(int $year = null, int $month = null)
    {
        $this->year = $year ?? date('Y');
        $this->month = $month ?? date('m');
        $this->startDate = new \Datetime($this->year.'-'.$this->month.'-'.'01');
        $this->startDate->modify('monday this week');
        $this->endDate = clone $this->startDate;
        $this->endDate->add(new \DateInterval('P1M'));
        $this->endDate->modify('monday next week');
        $this->events = new CalendarEvents($this->startDate, $this->endDate);
    }

    public function year()
    {
        return $this->year;
    }

    public function month()
    {
        return $this->month;
    }

    /**
     * get previous month.
     *
     * @return array previous month & year
     */
    public function previous()
    {
        $month = $this->month - 1;
        $year = $this->year;
        if ($month < 1) {
            $month = 12;
            $year = $this->year - 1;
        }

        return ['m' => $month, 'y' => $year];
    }

    public function next()
    {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month > 12) {
            $month = 1;
            $year = $this->year + 1;
        }

        return ['m' => $month, 'y' => $year];
    }
    public function today()
    {

        return ['m' => date('m'), 'y' => date('Y')];
    }

    public function setDataInElement($date, $element)
    {
        $result = null;
        if (isset($this->$element)) {
            $result = $this->$element($date);
        }

        return $result;
    }

    /**
     * get calendar structure.
     *
     * @return array calendar structure
     */
    public function get()
    {
        $period = new \DatePeriod($this->startDate, new \DateInterval('P1D'), $this->endDate);

        $cal = array();
        foreach ($period as $date) {
            $year = $date->format('Y');
            $month = $date->format('n');
            $day = $date->format('j');
            $week = (int) $date->format('W');
            $week_day = (int) $date->format('w');
            if (1 == $month && $week > 50) {
                $week = 0;
            }

            if (!array_key_exists($year, $cal)) {
                $cal[$year] = array(
                    'type' => 'year',
                    'value' => $year,
                    'months' => array(),
                );
            }
            if (!array_key_exists($month, $cal[$year]['months'])) {
                $cal[$year]['months'][$month] = array(
                    'type' => 'month',
                    'value' => $month,
                    'weeks' => array(),
                );
            }
            if (!array_key_exists($week, $cal[$year]['months'][$month]['weeks'])) {
                $cal[$year]['months'][$month]['weeks'][$week] = array(
                    'type' => 'week',
                    'value' => $week,
                    'days' => array(),
                );
            }
            if (!array_key_exists($day, $cal[$year]['months'][$month]['weeks'][$week]['days'])) {
                $cal[$year]['months'][$month]['weeks'][$week]['days'][$day] = array(
                    'type' => 'day',
                    'value' => $day,
                    'events' => $this->getEvents($date),
                    'weekday' => $week_day,
                );
            }
        }

        return $cal;
    }

    private function getEvents($date)
    {
        return $this->events->get($date->format('Y-m-d'));
    }
}
