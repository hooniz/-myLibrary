<?php
return [
	'/' => [
		'controller' => 'main',
		'action' => 'index',
		'notAuthAccess' => true
	],
	'/auth/' => [
		'controller' => 'auth',
		'action' => 'index',
		'notAuthAccess' => true
	],
	'/auth/do/' => [
		'controller' => 'auth',
		'action' => 'do',
		'notAuthAccess' => true
	],
	'/auth/logout/' => [
		'controller' => 'auth',
		'action' => 'logout',
		'notAuthAccess' => true
	],
	'/reg/' => [
		'controller' => 'reg',
		'action' => 'index',
		'notAuthAccess' => true
	],
	'/reg/do/' => [
		'controller' => 'reg',
		'action' => 'do',
		'notAuthAccess' => true
	],
	'/filter/' => [
		'controller' => 'main',
		'action' => 'filter',
		'notAuthAccess' => true
	],
	'/book/get/' => [
		'controller' => 'main',
		'action' => 'getBook',
		'notAuthAccess' => true
	],
	'/books/' => [
		'controller' => 'books',
		'action' => 'index',
		'notAuthAccess' => false
	],
	'/books/edit/' => [
		'controller' => 'books',
		'action' => 'edit',
		'notAuthAccess' => false
	],
	'/books/edit/do/' => [
		'controller' => 'books',
		'action' => 'editBook',
		'notAuthAccess' => false
	],
	'/users/' => [
		'controller' => 'users',
		'action' => 'index',
		'notAuthAccess' => false
	],
	'/users/edit/' => [
		'controller' => 'users',
		'action' => 'edit',
		'notAuthAccess' => false
	],
	'/users/edit/do/' => [
		'controller' => 'users',
		'action' => 'editUser',
		'notAuthAccess' => false
	],
	'/books/myBooks/' => [
		'controller' => 'books',
		'action' => 'getMyBooks',
		'notAuthAccess' => false
	],
	'/publishers/' => [
		'controller' => 'publishers',
		'action' => 'index',
		'notAuthAccess' => true
	],
	'/contacts/' => [
		'controller' => 'main',
		'action' => 'contacts',
		'notAuthAccess' => true
	],
];