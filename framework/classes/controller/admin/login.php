<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

namespace Nos;

use Str;

class Controller_Admin_Login extends Controller_Template_Extendable {

	public $template = 'nos::templates/html5';

    public function before($response = null) {
        parent::before($response);

        // If user is already logged in, proceed
		if (\Nos\Auth::check()) {
			\Response::redirect(urldecode(\Input::get('redirect', '/admin/')));
			exit();
		}
    }

    public function action_index() {

        $error = (\Input::method() == 'POST') ? $this->post_login() : '';

		\Asset::add_path('static/novius-os/admin/novius-os/');
		\Asset::css('login.css', array(), 'css');

        $this->template->body = \View::forge('misc/login', array(
			'error' => $error,
		));
        return $this->template;
    }

    public function action_reset() {

        $this->template->body = \View::forge('misc/login_reset');
        return $this->template;
    }

	public function after($response) {

		foreach (array(
			         'title' => 'Administration',
			         'base' => \Uri::base(false),
			         'require'  => 'static/novius-os/admin/vendor/requirejs/require.js',
		         ) as $var => $default) {
			if (empty($this->template->$var)) {
				$this->template->$var = $default;
			}
		}
		$ret = parent::after($response);
		$this->template->set(array(
			'css' => \Asset::render('css'),
			'js'  => \Asset::render('js'),
		), false, false);
		return $ret;
	}

	protected function post_login() {

		if (\Nos\Auth::login($_POST['email'], $_POST['password'])) {
			\Event::trigger('user_login');
			\Response::redirect(urldecode(\Input::get('redirect', '/admin/')));
			exit();
		}
		return 'Access denied';
	}
}