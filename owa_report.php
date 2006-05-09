<?php

//
// Open Web Analytics - An Open Source Web Analytics Framework
//
// Copyright 2006 Peter Adams. All rights reserved.
//
// Licensed under GPL v2.0 http://www.gnu.org/copyleft/gpl.html
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//
// $Id$
//

require_once 'owa_env.php';
require_once 'template_class.php';
require_once 'owa_settings_class.php';
require_once 'owa_api.php';

/**
 * Web Analytics Report  
 * 
 * @author      Peter Adams <peter@openwebanalytics.com>
 * @copyright   Copyright &copy; 2006 Peter Adams <peter@openwebanalytics.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GPL v2.0
 * @category    owa
 * @package     owa
 * @version		$Revision$	      
 * @since		owa 1.0.0
 */
class owa_report {
	
	/**
	 * Template
	 *
	 * @var object
	 */
	var $tpl;
	
	/**
	 * Metrics
	 *
	 * @var array
	 */
	var $metrics;
	
	/**
	 * Reporting Period
	 *
	 * @var string
	 */
	var $period;
	
	/**
	 * Display Label for Reporting Period
	 *
	 * @var string
	 */
	var $period_label;
	
	/**
	 * Configuration
	 *
	 * @var array
	 */
	var $config;
	
	/**
	 * Constructor
	 *
	 * @access 	public
	 * @return 	owa_report
	 */
	function owa_report() {
		
		$this->config = &owa_settings::get_settings();
		$this->tpl = & new Template;
		$this->tpl->set_template($this->config['report_wrapper']);
		$this->metrics = owa_api::get_instance('metric');
	
		return;
	}
	
	/**
	 * Set report period
	 *
	 * @access public
	 * @param string $period
	 */
	function set_period($period) {
		
		$this->period = $period;
		$this->period_label = $this->get_period_label($period);
		
		return;
	}

	/**
	 * Lookup report period label
	 *
	 * @param string $period
	 * @access private
	 * @return string $label
	 */
	function get_period_label($period) {
	
		switch ($period) {
		
			case "this_month";
				$label = "This Month";
				break;
			case "this_week";
				$label = "This Week";
				break;
			case "this_year";
				$label = "This Year";
				break;
			case "today";
				$label = "Today";
				break;
			case "last_seven_days";
				$label = "The Last Seven Days";
				break;
			case "yesterday";
				$label = "Yesterday";
				break;
			default:
				$label = "Unknown Period";
		}
		
		return $label;
	}
	
}

?>