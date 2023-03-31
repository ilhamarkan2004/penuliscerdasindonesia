<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");

use chriskacerguis\RestServer\RestController;

require_once APPPATH . 'controllers/api/Auth.php';

class Snap extends Auth
{
	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-l1_o-AknBILcvLDM7GO7k9bA', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	// public function index()
	// {
	// 	$this->load->view('checkout_snap');
	// }


	//Note : 
	// variable di post :
	// - Stringify uuid buku"
	public function token_post()
	{
		$this->load->model('M_Book, m_book');
		$this->load->model('M_Auth, m_auth');
		$param = $this->post();
		if (!$this->session->has_userdata('id_user')) {
			$result = [
				'success' => false,
				'message' => [
					'text' => 'Perlu login untuk akses data'
				],
				'data' => []
			];
			$this->response($result, RestController::HTTP_UNAUTHORIZED);
			die;
		} else {
			$uuid = $this->session->userdata('id_user');
			$id_user = $this->m_auth->getIdUserFromUUID($uuid);
			if ($id_user == []) {
				$result = [
					'success' => false,
					'message' => [
						'text' => 'Identitas tidak ditemukan'
					],
					'data' => []
				];
				$this->response($result, RestController::HTTP_BAD_REQUEST);
				die;
			} else {
				$id_user = $id_user['id'];
				$buyer = $this->m_auth->getCurrentUser();
				$listBuku = json_decode($param['arrId'], true); //isinya uuid dari tabel book_sell

				//itung total biaya
				$total = $this->m_book->getPriceListBookOrder($listBuku)['sell_price'];
				$param['total'] = $total;
				$param['jenis'] = 'Midtrans';

				//setting id order
				$id_order = time() + rand(4, 7);
				if ($this->m_book->getPurchase($id_order)->num_rows() != 0) {
					$id_order = $id_order + rand(2, 10);
				}

				// Required
				$transaction_details = array(
					'order_id' => $id_order,
					'gross_amount' => (int) $total, // no decimal allowed for creditcard
				);
				$item_details = array();
				$listBookId = array();
				foreach ($listBuku as $lb) {
					$details = $this->m_book->getBookSell($lb);
					$item_details[] = [
						'id' => $details['book_id'],
						'name' => $details['title'],
						'price' => $details['sell_price'],
						'quantity' => 1,
					];
					$listBookId[] = $param['book_id'];
				}

				// Optional
				$billing_address = array(
					'first_name'    => $buyer['name'],
					// 'last_name'     => "Litani",
					// 'address'       => "Mangga 20",
					// 'city'          => "Jakarta",
					// 'postal_code'   => "16602",
					'phone'         => $buyer['phone'],
					// 'country_code'  => 'IDN'
				);

				// Optional
				// $shipping_address = array(
				// 	'first_name'    => "Obet",
				// 	'last_name'     => "Supriadi",
				// 	'address'       => "Manggis 90",
				// 	'city'          => "Jakarta",
				// 	'postal_code'   => "16601",
				// 	'phone'         => "08113366345",
				// 	'country_code'  => 'IDN'
				// );

				// Optional
				$customer_details = array(
					'first_name'    => $buyer['name'],
					// 'last_name'     => "Litani",
					'email'         => $buyer['email'],
					'phone'         => $buyer['phone'],
					'billing_address'  => $billing_address,
					// 'shipping_address' => $shipping_address
				);

				// Data yang akan dikirim untuk request redirect_url.
				$credit_card['secure'] = true;
				//ser save_card true to enable oneclick or 2click
				//$credit_card['save_card'] = true;

				$time = time();
				$custom_expiry = array(
					'start_time' => date("Y-m-d H:i:s O", $time),
					'unit' => 'minute',
					'duration'  => 15
				);

				$transaction_data = array(
					'transaction_details' => $transaction_details,
					'item_details'       => $item_details,
					'customer_details'   => $customer_details,
					'credit_card'        => $credit_card,
					'expiry'             => $custom_expiry
				);

				error_log(json_encode($transaction_data));
				$snapToken = $this->midtrans->getSnapToken($transaction_data);
				error_log($snapToken);
				echo $snapToken;
				if ($snapToken) {

					$dataPurchase = [
						'order_id' => $id_order,
						'user_id' => $id_user,
						'gross_amount' => $total
					];

					$this->m_book->postPurchase($dataPurchase, $listBookId);
				}
			}
		}
	}

	public function finish_post()
	{
		$result = json_decode($this->post('result_data'), TRUE);

		$simpan = $this->m_book->putPurchase($result);
		if ($simpan) {
			$result = [
				'success' => true,
				'message' => [
					'text' => 'Berhasil'
				],
			];
			$this->response($result, RestController::HTTP_OK);
			die;
		} else {
			$result = [
				'success' => true,
				'message' => [
					'text' => 'Gagal'
				],
			];
			$this->response($result, RestController::HTTP_INTERNAL_ERROR);
			die;
		}
	}
}
