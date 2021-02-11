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
 * fetch_data class for local_datafetcher
 *
 * @package    local_datafetcher
 * @author     Eric Bjella <eric.bjella@remote-learner.net>
 * @copyright  2018 onwards Remote Learner Inc http://www.remote-learner.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

namespace local_datafetcher\task;
use core\task\scheduled_task;

/**
 * A scheduled task for local_datafetcher cron.
 *
 */
class fetch_data extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('datafetchercron', 'local_datafetcher');
    }

    /**
     * Run Datafetcher cron.
     */
    public function execute() {
        global $CFG;
        require_once($CFG->dirroot.'/local/datafetcher/lib.php');
        local_datafetcher_cron_scheduledtask();
    }

}
