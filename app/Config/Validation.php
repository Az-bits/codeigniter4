<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];
	public $movies = [
		'title'=>'required|min_length[3]|max_length[255]',
		'description'=>'min_length[3]|max_length[5000]'
	];
	public $categories = [
		'title'=>'required|min_length[3]|max_length[255]'
	];
	public $users = [
		'username'=>'required|min_length[3]|max_length[20]|is_unique[users.username]',
		'email'=>'required|min_length[3]|max_length[20]|is_unique[users.email]',
		'password'=>'required|min_length[5]|max_length[15]'
	];
	public $users_update = [
		'password'=>'required|min_length[5]|max_length[15]'
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		//'list'   => 'CodeIgniter\Validation\Views\list',
		'list'   => 'App\Views\Validations\list_bootstrap',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
