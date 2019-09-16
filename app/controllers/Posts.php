<?php 
	/**
	 * 
	 */
	class Posts extends Controller
	{
		
		function __construct()
		{
			$this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');

			if (!isLoggedIn()) {
				redirect('users/login');
			}
		}

		public function index(){
			$posts = $this->postModel->getPosts();
			$data = [
				'posts' => $posts
			];
			
			$this->view('posts/index', $data);
		}

		public function add(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
						'title' => trim($_POST['title']),
						'body' => trim($_POST['body']),
						'user_id' => $_SESSION['user_id'],
						'title_err' => '',
						'body_err' => ''
						];
				// Validation
				if (empty($data['title'])) {
					$data['title_err'] = 'Please add title of the post.';
				}
				if (empty($data['body'])) {
					$data['body_err'] = 'Please insert body of the post.';
				}

				if (empty($data['title_err']) && empty($data['body_err'])) {
					if ($this->postModel->addPost($data)) {
						flash('post_message', 'Post added');
						redirect('posts');
					}
					else {
						die('Something go wrong');
					}
				} else {
					$this->view('posts/add', $data);
				}
			} else {
				$data = [
						'title' => '',
						'body' => ''
						];

			$this->view('posts/add', $data);
			}
			
		}

		public function show($id) {

			$post = $this->postModel->getPostById($id);
			$user = $this->userModel->getUserById($post->user_id);

			$data = [
				'post' => $post,
				'user' => $user
			];

			$this->view('posts/show', $data);
		}

		public function edit($id){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
						'id' => $id,
						'title' => trim($_POST['title']),
						'body' => trim($_POST['body']),
						'user_id' => $_SESSION['user_id'],
						'title_err' => '',
						'body_err' => ''
						];
				// Validation
				if (empty($data['title'])) {
					$data['title_err'] = 'Please add title of the post.';
				}
				if (empty($data['body'])) {
					$data['body_err'] = 'Please insert body of the post.';
				}

				if (empty($data['title_err']) && empty($data['body_err'])) {
					if ($this->postModel->updatePost($data)) {
						flash('post_message', 'Post Updated');
						redirect('posts');
					}
					else {
						die('Something go wrong');
					}
				} else {
					$this->view('posts/edit', $data);
				}
			} else {
				//Check for owner
				$post = $this->postModel->getPostById($id);
				if($post->user_id == $_SESSION['user_id']){

				$data = [
						'id' => $id,
						'title' => $post->title,
						'body' => $post->body
						];

				$this->view('posts/edit', $data);
				} else{
					redirect('posts');
				}
			}
			
		}

		public function delete($id){
			if ($_SERVER[REQUEST_METHOD] == 'POST') {
				//Check for owner
				$post = $this->postModel->getPostById($id);
				if($post->user_id != $_SESSION['user_id']){
					redirect('posts');
				}
				
				if ($this->postModel->deletePost($id)) {
					flash('post_message', 'Post Deleted');
					redirect('posts');
				}
			} else {
				redirect('posts');
			}
		}
	}