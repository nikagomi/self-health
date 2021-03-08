<?php

namespace Utility\Model;


/**
 * Calendar
 * @package sarms
 * @author rneptune
 */
class Calendar {

    
    protected $url = "/class/group/attendance/calendar/show/";
    
    protected $gaWeekTitles;
    private $weekEnds;
    private $shortDays;
    private $calendarClass;

    public function __construct($shortDays = false, $weekEnds = true, $calendarClass = 'listTable') {
        $this->weekEnds = $weekEnds;
        $this->shortDays = $shortDays;
        $this->calendarClass = $calendarClass;

        //Set up the day names (week titles)
        $this->gaWeekTitles[0] = array("long" => "Sunday", "short" => "Sun");
        $this->gaWeekTitles[1] = array("long" => "Monday", "short" => "Mon");
        $this->gaWeekTitles[2] = array("long" => "Tuesday", "short" => "Tue");
        $this->gaWeekTitles[3] = array("long" => "Wednesday", "short" => "Wed");
        $this->gaWeekTitles[4] = array("long" => "Thursday", "short" => "Thu");
        $this->gaWeekTitles[5] = array("long" => "Friday", "short" => "Fri");
        $this->gaWeekTitles[6] = array("long" => "Saturday", "short" => "Sat");
    }

    public function getUrl() {
        return $this->url;
    }
    
    public function setUrl($url){
        $this->url = $url;
    }

    /**
     * Generates the calendar graphic.
     * @param integer $intYear
     * @param integer $intMonth
     * @param integer $applicationId
     * @return string 
     */
    public function intShowCalendar($date) {
        $fecha = explode("-", $date);
        $calendar = '';

        /* if month and/or year not set, change to current month and year */
        $intMonth = (empty($fecha[1])) ? strftime("%m") : $fecha[1];
        $intYear = (empty($fecha[0])) ? strftime("%Y") : $fecha[0];

        /* determine total days in month */
        $lintTotalDays = $this->days_in_month($intMonth, $intYear);
       // while (\DateTime::createFromFormat("Y-m-d", $intYear.'-'.$intMonth.'-'.$lintTotalDays + 1) !== false) {
          //  $lintTotalDays++;
       // }

        /* build table */
        $calendar .= $this->intStartTable();
        $calendar .= $this->intShowMonth($intYear, $intMonth);
        $calendar .= $this->intStartRow();

        for ($i = 0; $i < 7; $i++) {
            $calendar .= $this->intDisplayWeekTitle($i);
        }
        $calendar .= $this->intFinishRow();
        $calendar .= $this->intStartRow();

        /* ensure that enough blanks are put in so that the first day of the month
          lines up with the proper day of the week */
        $offset = \date("w", mktime(0, 0, 0, $intMonth, 1, $intYear));
        $lintOffset = (!$this->weekEnds && $offset > 0) ? $offset - 1 : $offset;

        if (!$this->weekEnds && $offset > 5) {
            $lintOffset = 0;
        }

        for ($i = 0; $i < $lintOffset; $i++) { // weekend no - offset-1
            $calendar .= $this->intDisplayDay('', $intMonth, $intYear);
        }

        /* start filling in the days of the month */
        for ($lintDay = 1; $lintDay <= $lintTotalDays; $lintDay++) {
            //if weekends are hidden
            $dowNum = \date("w", mktime(0, 0, 0, $intMonth, $lintDay, $intYear));
            
            if (!$this->weekEnds && ($dowNum == 0 || $dowNum == 6)) {
                
            } else {
                $calendar .= $this->intDisplayDay($lintDay, $intMonth, $intYear);
            }
            //--------------------


            /* terminate row if we're at on the last day of the week */
            $lintOffset++;
            if ($lintOffset > 6) {
                $lintOffset = 0;
                $calendar .= $this->intFinishRow();

                //PUT IN TO TRY SOMETHING.
                if ($lintDay < $lintTotalDays) {
                    $calendar .= $this->intStartRow();
                }
            }
        }

        /* fill in the remainder of the row with spaces */
        $limit = (!$this->weekEnds && $offset <= 5) ? 5 : 7;
        if ($lintOffset > 0) {
            $lintOffset = $limit - $lintOffset;
        }

        for ($i = 0; $i < $lintOffset; $i++) {
            $calendar .= $this->intDisplayDay('', $intMonth, $intYear);
        }
        //An extra addition for months that start on a Sunday
        if ($offset == 0 && !$this->weekEnds) {
           $calendar .= $this->intDisplayDay('', $intMonth, $intYear);
        }
        $calendar .= $this->intFinishRow();
        $calendar .= $this->intFinishTable();
        return $calendar;
    }

    protected function intStartTable() {
        return '<table id="calendar" class="" align="center" cellspacing="0" cellpadding="0">';
    }

    protected function intFinishTable() {
        return '</table>';
    }

    protected function intStartRow() {
        return '<tr>';
    }

    protected function intFinishRow() {
        return '</tr>';
    }

    protected function intDisplayWeekTitle($intWeekDay) {
        $length = ($this->shortDays) ? "short" : "long";
        if (!$this->weekEnds) {
            if ($intWeekDay != 0 && $intWeekDay != 6) {
                return '<th>' . $this->gaWeekTitles[$intWeekDay][$length] . '</th>';
            }
        } else {
            return '<th>' . $this->gaWeekTitles[$intWeekDay][$length] . '</th>';
        }
    }

    /**
     * Responsible for the display of the particular days of the month.
     * @param integer $intDay
     * @return string 
     */
    protected function intDisplayDay($intDay, $intMonth, $intYear) {
        $today = \date("Y-m-d");
        $isToday = (is_numeric($intDay) && \strtotime($today) == \strtotime($intYear . "-" . $intMonth . "-" . $intDay)) ? 'today' : '';
        return "<td class='" . $isToday . " cal-day '><div class='cal-day-date'>" . $intDay . "</div></td>";
    }

    /**
     * Determines the month that should be displayed in the calendar.
     * @param integer $intYear
     * @param integer $intMonth
     * @param integer $applicationId
     * @return string 
     */
    protected function intShowMonth($intYear, $intMonth) {
        $colspan = (!$this->weekEnds) ? 5 : 7;
        $monthDisplay .= "<tr id='mnth'><td colspan='" . $colspan . "'><div class='cal-nav-container'>";
        $prevMnth = $intMonth - 1;
        $prevYear = $intYear - 1;
        $nextMnth = $intMonth + 1;
        $nextYear = $intYear + 1;

        if ($intMonth == 12) {
            $prevMnth = 12 - 1;
            $nextMnth = 1;
            $nextYear = $intYear + 1;
        }
        if ($intMonth == 1) {
            $prevMnth = 12;
            $prevYear = $intYear - 1;
        }

        $monthDisplay .= "<div class='cal-nav-prev'>";
       // $monthDisplay .= "<a  title='Previous Year' href='" . $this->getUrl() ."/". $prevYear . "-" . $this->formatMonth($intMonth) . "-01'> &#171; </a>";
        if ($intMonth == 1) {
            $backYear = $prevYear;
        } else {
            $backYear = $intYear;
        }
        $monthDisplay .="<a title='Previous Month' href='" . $this->getUrl() ."/". $backYear . "-" . $this->formatMonth($prevMnth) . "-01'> &lsaquo; </a></div>";
        $monthDisplay .= "<div class='cal-nav-month'>" . \date("M  Y", mktime(0, 0, 0, $intMonth, 1, $intYear)) . "<span id='mnth-cal'>&nbsp;<img src='/images/cal.gif'></span></div>";
        if ($intMonth == 12) {
            $newYear = $nextYear;
        } else {
            $newYear = $intYear;
        }

        $monthDisplay .= "<div class='cal-nav-next'><a title='Next Month' href='" . $this->getUrl()."/" . $newYear . "-" . $this->formatMonth($nextMnth) . "-01'> &rsaquo; </a>";
        //$monthDisplay .= "<a  title='Next Year'  href='" . $this->getUrl()."/" . $nextYear . "-" . $this->formatMonth($intMonth) . "-01'> &#187; </a></div>";
        $monthDisplay .= "</div></td></tr>";

        return $monthDisplay;
    }

    protected function formatMonth($intMonth) {
        if ($intMonth != "&nbsp;") {
            if (strlen($intMonth) < 2) {
                $intMonth = "0" . $intMonth;
            }
        }
        return $intMonth;
    }

    protected function formatDay($intDay) {
        if ($intDay != "&nbsp;") {
            if (strlen($intDay) < 2) {
                $intDay = "0" . $intDay;
            }
        }
        return $intDay;
    }

    protected function changeDateFormat($date) {
        $fecha = @explode("-", $date);
        return @date("d/m/Y", mktime(0, 0, 0, $fecha[1], $fecha[2], $fecha[0]));
    }

    /**
     *
     * @param type $date
     * @param type $applicationId
     * @return type 
     */
    public function display($date) {
        return $this->intShowCalendar($date);
    }
    
    protected function days_in_month($month, $year) {
        // calculate number of days in a month
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    } 

}


