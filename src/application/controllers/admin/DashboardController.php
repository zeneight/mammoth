<?php
use src\application\controllers\AdminMainController;

/**
*  Dashboard
*/
class DashboardController extends AdminMainController
{
	public function index() {
		$this->model("member");
		$query = $this->member->selectAll();
		$jmlmember = $this->member->getRows($query);

		$this->model("kategori");
		$query = $this->kategori->selectAll();
		$jmlkategori = $this->kategori->getRows($query);

		$this->model("produk");
		$query = $this->produk->selectAll();
		$jmlproduk = $this->produk->getRows($query);

		// mendapatkan jumlah transaksi terbaru
		$this->model("transaksi");
		$query = $this->transaksi->selectWhere(array('status' => "Baru"));
		$jmltransaksi = $this->transaksi->getRows($query);

		// mendapatkam jumlah pesan terbaru
		$this->model("pesan");
		$query = $this->pesan->selectWhere(array('dibaca' => "N"));
		$jmlpesan = $this->pesan->getRows($query);

		// mendapatkan data untuk ditampilkan pada chart
		$nama_bulan = array(1=>"Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");

		$arr_bulan 	= array();
		$arr_data 	= array();

		// mendapatkan data bulan dari 11 bulan yang lalu hingga bulan ini
		for ($i=11; $i >= 0; $i--) { 
			$bulan = date('n') - $i;
			$tahun = date('y');

			if ($bulan < 1) {
				$bulan += 12;
				$tahun -= 1;
			}

			$arr_bulan[] = $nama_bulan[(int) $bulan];

			// mendapatkan data transaksi pada bulan tertentu
			$query = $this->transaksi->selectWhere(array('month(tanggal)' => $bulan, 'year(tanggal)' => $tahun));
			$datatrans = $this->transaksi->getResult($query);

			// mendapatkan jumlah penjualan dari transaksi
			if (isset($datatrans[0])) { 
				$idtrans 	= $datatrans[0]['id_transaksi'];
				$query		= $this->transaksi->query("SELECT * sum(jumlah) as total FROM transaksi_detail WHERE id_transaksi='$idtrans'");
				$hasil 		= $this->transaksi->getResult($query);
				$arr_data[]	= $hasil[0]['total'];
			} else {
				$arr_data[] = 0;
			}
		}

		// menggabungkan semua data yang akan dikirim ke view pada variabel data
		$data = array(
			'jmlkategori' => $jmlkategori,
			'jmlmember' => $jmlmember,
			'jmlproduk' => $jmlproduk,
			'jmltransaksi' => $jmltransaksi,
			'jmlpesan' => $jmlpesan,
			'namabulan' => $arr_bulan,
			'data' => $arr_data
		);

		$this->template("admin/dashboard", "dashboard", $data);
	}
}
?>