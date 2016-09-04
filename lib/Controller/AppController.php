<?php
/**
 * @copyright Copyright (c) 2016 Julius Härtl <jus@bitgrid.net>
 *
 * @author Julius Härtl <jus@bitgrid.net>
 *
 * @license GNU AGPL version 3 or any later version
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\AppOrder\Controller;

use \OCP\AppFramework\Controller;
use OCP\AppFramework\Http\RedirectResponse;
use \OCP\IRequest;
use \OCP\INavigationManager;
use \OCA\AppOrder\Service\ConfigService;
use OCA\AppOrder\Util;
use OCP\IURLGenerator;

class AppController extends Controller {

    private $userId;
    private $appConfig;
    private $urlGenerator;
	private $util;

    public function __construct($appName, IRequest $request, ConfigService $appConfig, IURLGenerator $urlGenerator, Util $util, $userId) {
        parent::__construct($appName, $request);
        $this->userId = $userId;
        $this->appConfig = $appConfig;
        $this->urlGenerator = $urlGenerator;
		$this->util = $util;
    }

	/**
	 * @NoCSRFRequired
	 * @return RedirectResponse
	 */
    public function index() {
    	$order = json_decode($this->util->getAppOrder());
		if($order !== null && sizeof($order)>0) {
			$firstPage = $order[0];
		} else {
			return new  RedirectResponse($this->urlGenerator->linkTo('files',''));
		}
        return new RedirectResponse($firstPage);
    }

}
