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
 * Data fetcher - Settings page
 *
 * @package    local_datafetcher
 * @author     Eric Bjella <eric.bjella@remote-learner.net>
 * @copyright  2018 onwards Remote Learner Inc http://www.remote-learner.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$plugin = 'local_datafetcher';

if ($hassiteconfig) {
    $settings = new \admin_settingpage($plugin, get_string('pluginname', $plugin));

    $settings->add(new admin_setting_configtext($plugin.'/urltofetch', get_string('urltofetch', $plugin),
                   get_string('urltofetchdesc', $plugin), ''));

    $settings->add(new admin_setting_configpasswordunmask($plugin.'/authcredentials', get_string('authcredentials', $plugin),
                   get_string('authcredentialsdesc', $plugin), ''));

    $settings->add(new admin_setting_configtext($plugin.'/datafile', get_string('datafile', $plugin),
                   get_string('datafiledesc', $plugin), ''));

    $ADMIN->add('localplugins', $settings);

}