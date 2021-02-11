<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Data fetcher - Lib Functions
 *
 * @package    local_datafetcher
 * @author     Eric Bjella <eric.bjella@remote-learner.net>
 * @copyright  2018 onwards Remote Learner Inc http://www.remote-learner.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function local_datafetcher_cron_scheduledtask() {
    global $CFG;
    $plugin = 'local_datafetcher';

    $ch = curl_init();

    $url = get_config($plugin, 'urltofetch');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set authentication if defined.
    $authcredentials = get_config($plugin, 'authcredentials');
    if (!empty($authcredentials)) {
        curl_setopt($ch, CURLOPT_USERPWD, $authcredentials);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    }
    $output = curl_exec($ch);
    $datafile = get_config($plugin, 'datafile');
    // Strip use of ../ in datafile setting.
    $datafile = str_replace('../', '', $datafile);
    $datafilepath = $CFG->dataroot.'/'.$datafile;
    $saved = @file_put_contents($datafilepath, $output);
    if ($saved) {
        echo 'Datafetcher data saved successfully to file '.$datafilepath.'.';
    } else {
        echo 'Error saving datafetcher data in file '.$datafilepath.'.';
    }
    curl_close($ch);
}