<?php
/**
 * Project1 for CT310
 */
use Model\Attractions;
use Model\Comments;
use Model\Users;

/**
 * The Idaho Controller.
 *
 * basic MVC example using the classic view/addEdit/delete pattern used for idaho project
 */
class Controller_idaho extends Controller
{
	/**
	 * Shows a list of all demo items
	 */
	public function action_index()
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/index');

		// FuelPHP always returns the default session if no session name is given
		// So there is always a session if you run Session::instance()
		// instance() will only return false if you are trying to retrieve a named session
		// that doesn't exist, like if you tried Session::instance('foo'), it would return false
		$session = Session::instance();
		$sessionUsername = $session->get('username');

		// no user session, so create a guest session
		if (strcmp($sessionUsername, '') == 0) {
			$session->set('username', 'guest');
			// GUESTS ARE DESIGNATED AN ID OF 76
			$session->set('id', 76);
		}

		$login = $this->constructLogin();
		
		$layout->login = Response::forge($login);

		// construct the attractions view
		$attrs = $this->constructAttrs();

		// set the attractions inside the home page
		$content->set_safe('attrs', $attrs);

		$layout->content = Response::forge($content);

		return $layout;
	}

	public function constructAttrs()
	{
		$attrQuery = Attractions::get_attrs();
		$attrQuerySize = sizeof($attrQuery);

		$attrs = '<div class="attr-container">' .
			'<h2><u>Attractions</u></h2>';
		
		if ($this->isAdmin()) {
			$attrs .= '<p><a href="' . Uri::create('idaho/createAttr') . '">' . "\n" .
            'Create a new attraction' . "\n" .
			'</a></p>' . "\n";
		}
		
		// start of the left column of attractions
		$attrs .= '<div class="attr-group">' . "\n";

		for ($i = 0; $i < round($attrQuerySize / 2); $i++)
		{
			$attrRow = $attrQuery[$i];
			$attr_id = $attrRow['id'];
			$attr_name = $attrRow['name'];
			$attr_descrip = $attrRow['descrip'];
			$attr_img = $attrRow['img_file'];

			$attrs .= '<div class="attr" id="' . $attr_id . '">' . "\n" .
				'<div class="pic">' . "\n" .
				'<a href="' . Uri::create('idaho/attr/'.$attr_id) . '">' . "\n" .
				'<img src="' . $attr_img . '" alt="' . $attr_name . '">' . "\n" .
				'</a>' . "\n" .
				'<figcaption>' . "\n" .
                '<a href="'. $attr_img . '">Source</a>' . "\n" .
				'</figcaption>' . "\n" .
				'</div>' . "\n" .
				'<div class="learnMore">' . "\n" .
				'<a href="' . Uri::create('idaho/attr/'.$attr_id) . '"> Learn more about the ' . 
					$attr_name . '</a>' . "\n" .
				'</div>' . "\n" .
				'</div>' . "\n";
		}

		$attrs .= '</div>' . "\n" .
			// start of the right column of attractions
			'<div class="attr-group">' . "\n";

		for ($i = round($attrQuerySize / 2); $i < $attrQuerySize; $i++)
		{
			$attrRow = $attrQuery[$i];
			$attr_id = $attrRow['id'];
			$attr_name = $attrRow['name'];
			$attr_descrip = $attrRow['descrip'];
			$attr_img = $attrRow['img_file'];

			$attrs .= '<div class="attr" id="' . $attr_id . '">' . "\n" .
				'<div class="pic">' . "\n" .
				'<a href="' . Uri::create('idaho/attr/'.$attr_id) . '">' . "\n" .
				'<img src="' . $attr_img . '" alt="' . $attr_name . '">' . "\n" .
				'</a>' . "\n" .
				'<figcaption>' . "\n" .
                '<a href="'. $attr_img . '">Source</a>' . "\n" .
				'</figcaption>' . "\n" .
				'</div>' . "\n" .
				'<div class="learnMore">' . "\n" .
				'<a href="' . Uri::create('idaho/attr/'.$attr_id) . '"> Learn more about the ' . 
					$attr_name . '</a>' . "\n" .
				'</div>' . "\n" .
				'</div>' . "\n";
		}

		$attrs .= '</div>' . "\n" .
			'</div>' . "\n";

		return $attrs;
	}

	public function constructLogin()
	{
		$login = View::forge('idaho/login');

		$session = Session::instance();
		$sessionID = $session->get('id');

		// User is logged in
		if ($sessionID != 76)
		{
			$session = Session::instance();
			$username = $session->get('username');

			$login->set_safe('username', $username);
			$login->set_safe('id', $sessionID);
		}
		// User not logged in, guest
		else
		{
			$login->set_safe('username', 'guest');
			$login->set_safe('id', 76);
		}

		return $login;
	}
	
	public function action_checkLogin()
	{
		$username = Input::post('username');
		$password = Input::post('password');

		$userQuery = Users::get_users_where('username', $username);
		$userRow = $userQuery[0];

		$dbUsername = $userRow['username'];
		$dbPassword = $userRow['password'];
		$dbID = $userRow['id'];

		if ($username === $dbUsername && md5($password) === $dbPassword)
		{
			$session = Session::instance();

			$session->set('username', $username);
			$session->set('id', $dbID);
			
			Response::redirect('/idaho');
		}
		else
		{
			Session::set('status', 'error');
			Response::redirect('/idaho/loginForm');
		}
	}
	
	public function action_logout()
    {   
		$session = Session::instance(); 
		$session->destroy();

		// Create a new session so the number of brochures ordered does not carry over
		Session::create();
		Session::set('username', 'guest');
		Session::set('id', 76);

		Response::redirect('/idaho');
	}

	public function get_createAttr()
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/createAttr');

		$login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$layout->content = Response::forge($content);

		return $layout;
	}

	public function post_createAttr()
	{
		$attr_name = $_POST['attr_name'];
		$attr_descrip = $_POST['attr_descrip'];

		$config = array(
			'path' => 'assets/img',
			'randomize' => true,
			'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
		);

		Upload::process($config);

		if (Upload::is_valid()) {
			Upload::save();

			Attractions::save_attr($attr_name, $attr_descrip, '/~lvreed/ct310/assets/img/' . Upload::get_files()[0]['saved_as']);
		}

		Response::redirect('idaho/index');
	}
	
	public function get_aboutUs()
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/aboutUs');

		$login = View::forge('idaho/login');

        $login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$layout->content = Response::forge($content);

		return $layout;
	}
	
	public function get_login()
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/login');

		$layout->content = Response::forge($content);

		return $layout;
	}

	public function get_loginForm()
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/loginForm');

		// TODO: NEVER SHOWS ERROR MESSAGE IF USER ENTERS USERNAME/PASSWORD WRONG
		// Could probably add loginFailed GET param to url on redirect in checkLogin()
		// Check if that GET param isset and if it is loginFailed, indicating failed login
		$content->set_safe('status', null);

		// Dont show the login link on the login page
		$layout->set_safe('login', null);

		$layout->content = Response::forge($content);

		return $layout;
	}

	// Returns the id of the user if logged in, otherwise returns null
	public function isLoggedIn()
	{
		$session = Session::instance();
		$id = $session->get('id');
		
		// User is logged in
		if ($id != 76)
		{
			return $id;
		}
		return null;
	}

	public function isAdmin()
	{
		$session = Session::instance();
		$sessionID = $session->get('id');

		// can check if user is admin if logged in
		if ($sessionID != 76)
		{
			$session = Session::instance();

			$sessionUsername = $session->get('username');

			// get username from the db
			$adminQuery = Users::get_users_where('username', $sessionUsername);
			$isAdmin = $adminQuery[0]['admin'];

			// boolean indicating whether the user is an admin or not
			return $isAdmin;
		}
		// not an admin if not logged in or user is not listed as an admin
		return null;
	}

	public function get_forgotPassword($status=null)
	{
		$layout = View::forge('idaho/layoutfull');
		$content = View::forge('idaho/forgotPassword');

		$content->set_safe('status', $status);

		$login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$layout->content = Response::forge($content);

		return $layout;
	}

	public function post_forgotPassword()
	{
		// Generate a random string of characters for the token
		$token = openssl_random_pseudo_bytes(100);
		$token = base64_encode($token);
		$token = md5($token);
		$email = $_POST['forgotEmail'];
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);

		$getUser = Users::get_users_where('email', $email);

		if (sizeof($getUser) > 0) {
			Users::update_user('reset_token', $token, 'email', $email);
		} else {
			Response::redirect('idaho/forgotPassword/failure');
		}

		$header = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		$resetMsg = 'Hello, you have requested a password reset for your account on Logan and Max\'s travel site' . "\r\n";
		$resetMsg .= 'Here is your password ';
		$resetMsg .= '<a href="' . Uri::create('idaho/resetPassword/?token=') . $token . '">reset link</a>';
		
		if (mail($email, 'Account Password Reset', $resetMsg, $header)) {
			Response::redirect('idaho/forgotPassword/success');
		} else {
			Response::redirect('idaho/forgotPassword/failure');
		}
	}

	public function get_resetPassword()
	{
		$layout = View::forge('idaho/layoutfull');
		$content = View::forge('idaho/resetPassword');

		$token = isset($_GET['token']) ? $_GET['token'] : null;

		// Set token to null if there is no record of it in the DB
		// This ensures the user cannot reset a password unless they have a valid token
		$getToken = Users::get_users_where('reset_token', $token);
		if (sizeof($getToken) == 0) {
			$token = null;
		}

		$content->set_safe('token', $token);

		$login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$layout->content = Response::forge($content);

		return $layout;
	}

	public function post_resetPassword()
	{
		$newPassword = filter_var($_POST['newPassword'], FILTER_SANITIZE_STRING);

		if ($newPassword != '') {
			Users::update_user('password', md5($newPassword), 'reset_token', $_GET['token']);
			Users::update_user('reset_token', null, 'reset_token', $_GET['token']);
		}

		Response::redirect('idaho/index');
	}

	public function insert_comment_db($attr_id) {
		$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

		$attrQuery = Attractions::get_attrs_where('id', $attr_id);

		// there will be an entry for this attraction by the time we get here
		// b/c you can only add a comment to an attraction that has a page,
		// so there will be no index out of bounds error. ever.
		$attrRow = $attrQuery[0];

		$attr_name = $attrRow['name'];
		$attr_id = $attrRow['id'];

		if ($comment != '') {
			$session = Session::instance();
			$username = $session->get('username');
			Comments::save_comment($attr_name, $username, $comment, $attr_id);
		}
	}

	public function display_comments($attr_id)
	{
		$commentContainer = View::forge('idaho/commentContainer');

		// array of comments
		$commentQuery = Comments::get_comments_where('attr_id', $attr_id);

		// Create a string of comments all on their own lines (<br>)
		$comments = '';
		foreach ($commentQuery as $commentRow) {
			$comment_id = $commentRow['id'];
			$username = $commentRow['username'];
			$comment = $commentRow['comment'];

			$session = Session::instance();
			$sessionUsername = $session->get('username');

			$adminQuery = Users::get_users_where('username', $sessionUsername);
			$isAdmin = $adminQuery[0]['admin'];

			// if logged in and you are an admin
			// allow admin to edit/delete comments
			if (Session::instance() && $isAdmin) {
				$comments = '<p id="'.$comment_id.'">' . "\n" .
					$comments . $username . ': ' . $comment . ' ' .
					'<a href="' . Uri::create('idaho/editComment/'.$comment_id.'/'.$attr_id) . '">edit</a> ' .
					'<a href="' . Uri::create('idaho/deleteComment/'.$comment_id.'/'.$attr_id) . '">delete</a>' . '</p>';
			} else { // user/customer
				$comments = '<p>' . $comments . $username . ': ' . $comment . '</p>';
			}
		}

		$commentContainer->set_safe('comments', $comments);
		
		$id = $this->isLoggedIn();

		$commentContainer->set_safe('id', $id);

		return $commentContainer;
	}

	public function action_deleteComment($comment_id, $attr_id) {
		Comments::delete_comment($comment_id);
		Response::redirect('idaho/attr/'.$attr_id);
	}

	public function action_attr($attr_id)
	{
		$attrQuery = Attractions::get_attrs_where('id', $attr_id);

		$attrRow = $attrQuery[0];

		$attr_name = $attrRow['name'];
		$attr_img = $attrRow['img_file'];
		$attr_descrip = $attrRow['descrip'];
		$commentContainer = $this->display_comments($attr_id);

		$layout = View::forge('idaho/layoutfull');

		// Include the login prompt in this page
		$login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$addToCart = Uri::create('idaho/addToCart/'.$attr_id);

		// set the appropriate view objects in the attr page under the idaho directory
		$layout->content = View::forge('idaho/attr',
			array(
				'attr_name' => $attr_name,
				'attr_img' => $attr_img,
				'attr_descrip' => $attr_descrip,
				'addToCart' => $addToCart,
				'commentContainer' => $commentContainer,
			)
		);

		return $layout;
	}

	// when form is submitted, insert comment into db and redirect to the attraction page
	public function post_attr($attr_id)
	{
		$this->insert_comment_db($attr_id);
		Response::redirect('idaho/attr/'.$attr_id);
	}

	public function get_editComment($comment_id, $attr_id)
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/editComment');

		$commentQuery = Comments::get_comments_where('id', $comment_id);
		
		$content->set_safe('oldComment', $commentQuery[0]['comment']);

		$login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$layout->content = Response::forge($content);

		return $layout;
	}

	public function post_editComment($comment_id, $attr_id)
	{
		$newComment = filter_var($_POST['newComment'], FILTER_SANITIZE_STRING);

		if ($newComment != '') {
			Comments::update_comment('comment', $newComment, 'id', $comment_id);
		}

		Response::redirect('idaho/attr/'.$attr_id);
	}

	// add brocure for an attraction to the cart
	public function action_addToCart($attr_id)
	{
		$session = Session::instance();
		$brochuresOrdered = $session->get($attr_id);
		if (!isset($brochuresOrdered)) {
			$session->set($attr_id, 1);
		} else {
			$session->set($attr_id, $brochuresOrdered + 1);
		}

		Response::redirect('idaho/addToCartStatus');
	}

	public function get_addToCartStatus()
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/addToCartStatus');

		$login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$layout->content = Response::forge($content);

		return $layout;
	}	

	// render shopping cart page
	public function get_shoppingCart()
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/shoppingCart');

		// will hold the list of quantity selectors for each attraction
		$attrQuantities = '';

		// create and append a quantity selector for each attraction
		$attrQuery = Attractions::get_attrs();
		foreach($attrQuery as $attrRow) {
			$attrQuantity = View::forge('idaho/attrQuantity');
			$attrQuantity->set_safe('attr_name', $attrRow['name']);
			$attrQuantity->set_safe('attr_id', $attrRow['id']);

			// Get the session instance, so that we can retrieve the number of brochures
			// for each attraction that the user has added to their cart
			$session = Session::instance();
			// The session stores the number of brochures ordered per attraction via
			// the attraction id, so use the attr_id to index into the session to get the
			// number of brochures the user has order for a specific attraction
			$brochuresOrdered = $session->get($attrRow['id']);
			if (!isset($brochuresOrdered)) {
				$attrQuantity->set_safe('init_val', 0);
			} else {
				$attrQuantity->set_safe('init_val', $brochuresOrdered);
			}

			$attrQuantities .= $attrQuantity;
		}

		$content->set_safe('attrQuantities', $attrQuantities);

		$login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$layout->content = Response::forge($content);

		return $layout;
	}

	public function post_shoppingCart()
	{
		if (isset($_POST['mail'])) {
			$session = Session::instance();

			$attrQuery = Attractions::get_attrs();
			$orderMsg = 'Your order of:' . "\n";
			foreach($attrQuery as $attrRow) {
				$attr_name = $attrRow['name'];
				$attr_id = $attrRow['id'];
				$orderMsg .= $attr_name . ', quantity: ' . $_POST[$attr_id] . "\n";

				// clear the brochure quantities since we already used them and no longer need them
				$session->set($attr_id, 0);
			}
			$orderMsg .= 'has been sent';

			error_reporting(0);

			// send the order summary to the admins as well
			$userQuery = Users::get_users_where('admin', true);
			foreach ($userQuery as $userRow) {
				$adminEmail = $userRow['email'];
				mail($adminEmail, 'Customer placed order', $orderMsg);
			}

			// send the order summary to the specified email address
			$customerEmail = $_POST['email'];
			if (mail($customerEmail, 'Order from Max and Logan\'s travel site', $orderMsg)) {
				Response::redirect('idaho/orderStatus/success');
			} else {
				Response::redirect('idaho/orderStatus/failure');
			}
		}
	}

	public function get_orderStatus($orderStatus)
	{
		$layout = View::forge('idaho/layoutfull');

		$content = View::forge('idaho/orderStatus');

		$orderStatusMsg = null;
		if ($orderStatus === 'success') {
			$orderStatusMsg = 'Order placed successfully';
		} else {
			$orderStatusMsg = 'There was an error placing your order, check the email address.';
		}
		$content->set_safe('orderStatusMsg', $orderStatusMsg);

		$login = $this->constructLogin();

		$layout->login = Response::forge($login);

		$layout->content = Response::forge($content);

		return $layout;
	}

	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}
}
