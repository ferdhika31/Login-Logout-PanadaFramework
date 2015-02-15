<?php
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2015-02-15 18:19:31
	**/
namespace Controllers;
use Resources, Models, Library;

class Dashboard extends Resources\Controller
{    
	public function __construct(){
		parent::__construct();
		 // Load model masuk dan library session
		$this->masuk = new Models\M_masuk; //M_masuk adalah nama file di folder Models
		$this->session = new Resources\Session();
	}

    public function index(){    
    	//jika session belum di set maka di direk ke halaman masuk
    	if(!$this->session->getValue('isLogin')){ 
    		$this->redirect('dashboard/masuk');	
    	}

        $data = array(
        	'judul' => 'Test Login',
        	'nama' => $this->session->getValue('nama'),
        	'url'	=> $this->uri->baseUri
        );
        $this->output('dashboard', $data); //load view
    }

    public function masuk(){
    	//jika session login sudah di set maka di direk ke halaman dashboard
    	if($this->session->getValue('isLogin')){
    		$this->redirect('dashboard');	
    	}
    	//variabel error pada halaman form login
    	$views['error'] = '';

    	//buat tombol masuk di tekan
		if (isset($_POST['A_masuk'])){
			$username = $_POST['A_user'];
			$password = md5($_POST['A_pass']);

			$user = $this->masuk->query_masuk($username,$password);
			if($user){
				// Username dan password sudah benar, simpan nilai ke dalam session
				$data = array(
					'isLogin' => true,
					'nama'	=> $user->nama,
					'username' => $user->username
					);
				$this->session->setValue($data);

				// Redirect ke halaman utama.
				$this->redirect('dashboard');
			}else{
				$views['error'] = 'Username atau password yang Anda input salah.';

			}
		}
    	$views['judul'] = 'Test Login';
        
        $this->output('masuk', $views); //load view
    }

    public function keluar(){
    	// Hapus session dan redirect ke halaman login.
		$this->session->destroy();
		$this->redirect('dashboard/masuk');
    }
}