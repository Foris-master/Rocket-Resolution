<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/autoload.php';
use Stichoza\GoogleTranslate\TranslateClient;

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$tr = new TranslateClient(null, 'en');
		var_dump($tr->translate(['j aime ', 'pas les kala kal', 'des jours et des nuits']));

		$this->load->view('welcome_message');
		/*$this->load->model('proxies/CategoryModel');

		$cm =new RocketModel();
		//$c->add_categorie();

		//$c =$cm->get_categorie(1);
		$c =new Category();
		$c->setDescription("tout les foum fom truc de tinjou");
		$c->setName("cat2");
		$res= $cm->save_category($c);
        //$res=$cm->filter_categorie();
        var_dump($res);*/
		//new Doctrine();




	}
}
