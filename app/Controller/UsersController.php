<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

  public function beforeFilter() {
    $this->Auth->allow('login', 'logout', 'register');
    $this->Auth->loginRedirect  = ['controller' => 'users', 'action' => 'mypage'];
    $this->Auth->logoutRedirect = ['controller' => 'users', 'action' => 'login'];
  }

	public function mypage() {
    $this->set('user', $this->User->findById($this->Auth->user()));
	}

	public function register() {
		if ($this->request->is('post')) {
      $this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('You have successfully signed up.', 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-success']);
				return $this->redirect(array('action' => 'login'));
			} else {
				$this->Session->setFlash('Your signup failed.', 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-danger']);
			}
		}
	}

  public function login() {
    if ($this->request->is('post')) {
      $user = $this->User->auth($this->request->data);
      if ($user !== false &&  $this->Auth->login($user['User'])) {
        return $this->redirect($this->Auth->redirect());
      } else {
        $this->Session->setFlash('Please verify that your username and password are correct.',
          'alert', ['plugin' => 'BoostCake', 'class' => 'alert-danger']);
      }
    }
  }

  public function logout() {
    $this->redirect($this->Auth->logout());
  }

	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
